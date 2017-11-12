<?php

namespace App\Billing\tests\Invoice;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Melisa\Laravel\Database\InstallUser;
use App\Billing\tests\TestCase;
use App\Billing\Logics\Fake\InvoiceLogic;

class CfdiTest extends TestCase
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
        $data = app(InvoiceLogic::class)->getData();
        
        $response = $this->actingAs($user)
            ->json('post', 'invoice', $data)
            ->assertStatus(200)
            ->assertJson([
                'success'=>true
            ]);
        
        $result = json_decode($response->getContent());
        
        $response = $this->actingAs($user)
            ->json('post', 'cfdi', [
                'id'=>$result->data->id,
            ])
            ->assertStatus(200)
            ->assertJson([
                'success'=>true
            ]);
        
        $result = json_decode($response->getContent());
        dd($result);
    }
    
}
