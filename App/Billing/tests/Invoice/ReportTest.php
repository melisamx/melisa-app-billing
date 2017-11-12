<?php

namespace App\Billing\tests\Invoice;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Melisa\Laravel\Database\InstallUser;
use App\Billing\tests\TestCase;
use App\Billing\Models\Invoice;

class ReportTest extends TestCase
{
    use DatabaseTransactions,
        InstallUser;
    
    protected $connectionsToTransact = [
        'core', 
        'billing'
    ];
    
    /**
     * 
     * @group completed
     */
    public function testCreate()
    {
        $user = $this->findUser();
        $invoice = Invoice::inRandomOrder()->first();        
        $response = $this->actingAs($user)
            ->json('get', "invoice/report/$invoice->id/json/")
            ->assertStatus(200)
            ->assertJson([
                'success'=>true
            ]);
        
        $result = json_decode($response->getContent());
        
        $this->assertDatabaseHas('invoice', [
            'id'=>$result->data->id
        ], 'billing');
    }
    
}
