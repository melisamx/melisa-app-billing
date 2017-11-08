<?php

namespace App\Billing\tests\Invoice;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Melisa\Laravel\Database\InstallUser;
use App\Billing\tests\TestCase;
use App\Billing\Models\Contributors;
use App\Billing\Models\ContributorsAddresses;
use App\Billing\Models\Coins;
use App\Billing\Models\Waytopay;
use App\Billing\Models\Customers;
use App\Billing\Models\Concepts;
use App\Billing\Models\ConceptKeys;
use App\Billing\Models\ConceptUnits;
use App\Billing\Models\InvoiceConcepts;
use App\Billing\Models\Taxes;

class InvoiceCase extends TestCase
{
    use DatabaseTransactions,
        InstallUser;
    
    protected $connectionsToTransact = [
        'core', 
        'billing'
    ];
    
    /**
     * 
     * @group dev
     */
    public function testCreate()
    {
        $user = $this->findUser();
        $transmitter = Contributors::inRandomOrder()->first();
        $transmitterAddress = ContributorsAddresses::inRandomOrder()->first();
        $coin = Coins::inRandomOrder()->first();
        $waytopay = Waytopay::inRandomOrder()->first();
        $customer = Customers::inRandomOrder()->first();
        $customerAddress = ContributorsAddresses::inRandomOrder()->first();
        $concept = Concepts::inRandomOrder()->first();
        $conceptKey = ConceptKeys::inRandomOrder()->first();
        $conceptUnit = ConceptUnits::inRandomOrder()->first();
        $concepts = [
            [
                'id'=>$concept->id,
                'idConceptKey'=>$conceptKey->id,
                'idConceptUnit'=>$conceptUnit->id,
                'description'=>'Servicios profesionales',
                'unitValue'=>4195.80,
                'quantity'=>1,
                'taxes'=>[
                    [
                        'tax'=>'IVA',
                        'action'=>'t',
                        'typeFactor'=>'Tasa',
                        'base'=>4195.80,
                        'rateOrFee'=>0.16,
                    ],
                    [
                        'tax'=>'IVA',
                        'action'=>'r',
                        'typeFactor'=>'Tasa',
                        'base'=>4195.80,
                        'rateOrFee'=>0.106667,
                    ],
                    [
                        'tax'=>'ISR',
                        'action'=>'r',
                        'typeFactor'=>'Tasa',
                        'base'=>4195.80,
                        'rateOrFee'=>0.1,
                    ]
                ],
            ]
        ];
        
        $response = $this->actingAs($user)
            ->json('post', 'invoice', [
                'idTransmitter'=>$transmitter->id,
                'idTransmitterAddress'=>$transmitterAddress->id,
                'idCoin'=>$coin->id,
                'idWaytopay'=>$waytopay->id,
                'idCustomer'=>$customer->id,
                'idCustomerAddress'=>$customerAddress->id,
                'subTotal'=>4195.80,
                'total'=>4000,
                'totalTaxRetention'=>867.13,
                'totalTaxTransfer'=>671.33,
                'concepts'=>json_encode($concepts)
            ])
            ->assertStatus(200)
            ->assertJson([
                'success'=>true
            ]);
        
        $result = json_decode($response->getContent());
        
        $this->assertDatabaseHas('invoice', [
            'id'=>$result->data->id
        ], 'billing');
        
        foreach($concepts as $concept) {
            $this->assertDatabaseHas('invoiceConcepts', [
                'idInvoice'=>$result->data->id,
                'idConcept'=>$concept['id'],
                'amount'=>$concept['quantity'] * $concept['unitValue'],
            ], 'billing');
            
            $recordConcept = InvoiceConcepts::where([
                'idInvoice'=>$result->data->id,
                'idConcept'=>$concept['id'],
            ])->first();
            
            foreach($concept['taxes'] as $tax) {
                $recordTax = Taxes::where('name', $tax['tax'])->first();
                
                $this->assertDatabaseHas('invoiceConceptsTaxes', [
                    'idInvoiceConcept'=>$recordConcept->id,
                    'idTax'=>$recordTax->id,
                    'amount'=>round($tax['base'] * $tax['rateOrFee'], 2),
                ], 'billing');
            }
        }
    }
    
}
