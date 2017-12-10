<?php

namespace App\Billing\tests\Feature\AccountsReceivable;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Melisa\Laravel\Database\InstallUser;
use Melisa\Laravel\Tests\ResponseTrait;
use App\Billing\tests\TestCase;
use App\Billing\tests\Feature\Documents\CreateTrait as InvoiceTrait;
use App\Billing\tests\Feature\Cfdi\CreateTrait as CfdiTrait;

class CreateTest extends TestCase
{
    use DatabaseTransactions,
        InstallUser,
        ResponseTrait,
        InvoiceTrait,
        CfdiTrait;
    
    protected $connectionsToTransact = [
        'core', 
        'billing'
    ];
    
    /**
     * 
     * @group accountReceivable
     * * @group dev
     * @test
     */
    public function create_success()
    {
        $cfdi = $this->createCfdi();
        
        $user = $this->findUser();
        $response = $this->actingAs($user)
            ->json('post', 'accountsReceivable', [
                'idDocument'=>$cfdi->idDocument
            ]);
        dd($response->getContent());
        $result = json_decode($response->getContent());
        
        $this->assertDatabaseHas('documents', [
            'id'=>$result->data->idInvoice,
        ], 'billing');
        
        $this->assertDatabaseHas('accountsReceivable', [
            'id'=>$result->data->idAccountReceivable,
            'idDocument'=>$result->data->idDocument,
        ], 'billing');
    }
    
}
