<?php

namespace App\Billing\tests\Customers;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Generator as Faker;
use Melisa\Laravel\Database\InstallUser;
use Melisa\Laravel\Tests\ResponseTrait;
use App\Billing\tests\TestCase;
use App\Billing\Models\Waytopay;
use App\Billing\Models\Repositories;

class CreateTest extends TestCase
{
    use DatabaseTransactions,
        InstallUser,
        ResponseTrait;
    
    protected $connectionsToTransact = [
        'core', 
        'billing'
    ];
    
    protected $endpoint = 'customers';
    protected $faker;
    protected $user;
            
    function setUp()
    {
        parent::setUp();
        $this->faker = app(Faker::class);
        $this->user = $this->findUser();
    }
    
    /**
     * @group customers
     * @group completed
     * @test
     */
    function good_input()
    {
        $repository = factory(Repositories::class)->create();
        $wayToPay = factory(Waytopay::class)->create();
        $input = [
            'idRepository'=>$repository->id,
            'idWaytopay'=>$wayToPay->id,
            'name'=>$this->faker->name,
            'rfc'=>$this->faker->bothify('????####?##'),
            'email'=>$this->faker->email,
            'active'=>$this->faker->boolean,
        ];
        
        $response = $this->actingAs($this->user)
            ->json('post', $this->endpoint, $input);
        
        $this->responseCreatedSuccess($response);
        $result = json_decode($response->getContent())->data;
        $this->assertDatabaseHas('customers', [
            'id'=>$result->id,
        ], 'billing');        
        $this->assertDatabaseHas('contributors', [
            'id'=>$result->idContributor,
        ], 'billing');        
    }
    
    /**
     * @group customers
     * @group completed
     * @test
     */
    function bad_input()
    {
        $repository = factory(Repositories::class)->create();
        $wayToPay = factory(Waytopay::class)->create();
        $idInvalid = mt_rand(999, 9999);
        $string = uniqid();
        $casesInput = [
            [
                'idRepository'=>$idInvalid,
            ],
            [
                'idRepository'=>$repository->id,
                'idWaytopay'=>$wayToPay->id,
            ],
            [
                'idRepository'=>$repository->id,
                'idWaytopay'=>$wayToPay->id,
                'name'=>$string,
            ],
            [
                'idRepository'=>$repository->id,
                'idWaytopay'=>$wayToPay->id,
                'name'=>$string,
                'rfc'=>$string,
            ],
            [
                'idRepository'=>$repository->id,
                'idWaytopay'=>$wayToPay->id,
                'name'=>$string,
                'rfc'=>$string,
                'email'=>$string,
            ],
            [
                'idRepository'=>$repository->id,
                'idWaytopay'=>$wayToPay->id,
                'name'=>$string,
                'rfc'=>$string,
                'email'=>$string,
                'active'=>false,
            ],
        ];
        foreach($casesInput as $input) {
            $response = $this->actingAs($this->user)
                ->json('post', $this->endpoint, $input);
            $this->responseWithErrors($response, 422);
        }        
    }

    /**
     * 
     * @group customers
     * @group completed
     * @test
     */
    function unauthenticated_user()
    {
        $response = $this->post($this->endpoint);
        $this->responseRedirect($response);
        
        $responseAjax = $this
            ->withHeaders([
                'X-Requested-With'=>'XMLHttpRequest'
            ])
            ->post($this->endpoint);
        
        $this->responseWithErrors($responseAjax, 401);
    }
    
}
