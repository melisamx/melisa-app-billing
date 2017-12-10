<?php

namespace App\Billing\tests\Feature\AccountsReceivable;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Generator as Faker;
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
    
    protected $endpoint = 'accountsReceivable';
    protected $endpointCfdi = 'cfdi';
    protected $endpointDocuments = 'documents';
    
    function setUp()
    {
        parent::setUp();
        $this->faker = app(Faker::class);
        $this->user = $this->findUser();
    }
    
    /**
     * 
     * @group accountReceivable
     * @group feature
     * @group completed
     * @test
     */
    public function good_input()
    {
        $cfdi = $this->createCfdi($this->endpointCfdi, $this->endpointDocuments);
        
        $user = $this->findUser();
        $response = $this->actingAs($user)
            ->json('post', $this->endpoint, [
                'idDocument'=>$cfdi->idDocument
            ]);
        
        $this->responseCreatedSuccess($response);        
        $result = json_decode($response->getContent());
        
        $this->assertDatabaseHas('documents', [
            'id'=>$result->data->idDocument,
        ], 'billing');
        
        $this->assertDatabaseHas('accountsReceivable', [
            'id'=>$result->data->id,
            'idDocument'=>$result->data->idDocument,
        ], 'billing');
    }
    
    /**
     * @group accountReceivable
     * @group feacture
     * @group completed
     * @test
     */
    function bad_input()
    {
        $casesInput = [
            [
                'idDocument'=>$this->faker->name,
            ],
            [
                'idDocument'=>$this->faker->numberBetween(999, 999999),
            ],
            [
                'idDocument'=>$this->faker->uuid,
            ],
        ];
        
        $this->runPostBadInput($casesInput);       
    }
    
    /**
     * 
     * @group accountReceivable
     * @group feacture
     * @group completed
     * @test
     */
    function unauthenticated_user()
    {
        $this->responseUnauthenticated($this->endpoint);
    }
    
}
