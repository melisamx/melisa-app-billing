<?php

namespace App\Billing\tests\Invoice;

use App\Billing\Models\InvoiceConcepts;
use App\Billing\Models\Taxes;
use App\Billing\Logics\Fake\InvoiceLogic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
trait CreateTrait
{
    
    public function createInvoice()
    {
        $user = $this->findUser();
        $data = app(InvoiceLogic::class)->getData();
        
        $response = $this->actingAs($user)
            ->json('post', 'invoice', $data)
            ->assertStatus(200)
            ->assertJson([
                'success'=>true
            ]);
        
        $result = json_decode($response->getContent());
        
        $this->assertDatabaseHas('invoice', [
            'id'=>$result->data->id
        ], 'billing');
        
        foreach(json_decode($data['concepts'], true) as $concept) {
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
        
        return $result->data->id;
    }
    
}
