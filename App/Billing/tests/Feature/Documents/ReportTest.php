<?php

namespace App\Billing\tests\Feature\Documents;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Melisa\Laravel\Database\InstallUser;
use App\Billing\tests\TestCase;
use App\Billing\Models\Documents;

class ReportTest extends TestCase
{
    use DatabaseTransactions,
        InstallUser;
    
    protected $connectionsToTransact = [
        'core', 
        'billing'
    ];
    
    /**
     * @group documents
     * @group incomplete
     * @group feature
     * @test
     */
    public function create_success()
    {
        $user = $this->findUser();
        $documents = Documents::inRandomOrder()->first();
        $response = $this->actingAs($user)
            ->json('get', "documents/report/$documents->id/json/")
            ->assertStatus(200)
            ->assertJson([
                'success'=>true
            ]);
        
        $result = json_decode($response->getContent());
        
        $this->assertDatabaseHas('documents', [
            'id'=>$result->data->id
        ], 'billing');
    }
    
}
