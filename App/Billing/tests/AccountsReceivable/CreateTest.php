<?php

namespace App\Billing\tests\AccountsReceivable;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Melisa\Laravel\Database\InstallUser;
use App\Billing\tests\TestCase;
use App\Billing\tests\Documents\CreateTrait as InvoiceTrait;
use App\Billing\tests\Cfdi\CreateTrait as CfdiTrait;

class CreateTest extends TestCase
{
    use DatabaseTransactions,
        InstallUser,
        InvoiceTrait,
        CfdiTrait;
    
    protected $connectionsToTransact = [
        'core', 
        'billing'
    ];
    
    /**
     * 
     * @group completed
     * @group accountReceivable
     */
    public function testCreate()
    {
        $cfdi = $this->createCfdi();
        
        $user = $this->findUser();
        $response = $this->actingAs($user)
            ->json('post', 'accountsReceivable', [
                'idInvoice'=>$cfdi->idInvoice
            ])
            ->assertStatus(200)
            ->assertJson([
                'success'=>true
            ]);
        
        $result = json_decode($response->getContent());
        
        $this->assertDatabaseHas('documents', [
            'id'=>$result->data->idInvoice,
        ], 'billing');
        
        $this->assertDatabaseHas('accountsReceivable', [
            'id'=>$result->data->idAccountReceivable,
            'idInvoice'=>$result->data->idInvoice,
        ], 'billing');
    }
    
}
