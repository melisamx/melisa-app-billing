<?php

namespace App\Billing\tests\Repositories;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Generator as Faker;
use Melisa\Laravel\Database\InstallUser;
use Melisa\Laravel\Tests\ResponseTrait;
use App\Billing\tests\TestCase;

class CreateTest extends TestCase
{
    use DatabaseTransactions,
        InstallUser,
        ResponseTrait;
    
    protected $connectionsToTransact = [
        'core', 
        'billing'
    ];
    
    protected $endpoint = 'repositories';
    protected $faker;
    protected $user;
            
    function setUp()
    {
        parent::setUp();
        $this->faker = app(Faker::class);
        $this->user = $this->findUser();
    }
    
    /**
     * @group repositories
     * @group feature
     * @group completed
     * @test
     */
    function good_input()
    {
        $input = [
            'name'=>$this->faker->name,
            'active'=>$this->faker->boolean ? 1 : 0,
            'expirationDays'=>$this->faker->numberBetween(30, 90),
        ];
        
        $response = $this->actingAs($this->user)
            ->json('post', $this->endpoint, $input);
        
        $this->responseCreatedSuccess($response);
        $result = json_decode($response->getContent())->data;
        $this->assertDatabaseHas('repositories', [
            'id'=>$result->id,
            'active'=>$input['active'],
            'expirationDays'=>$input['expirationDays'],
        ], 'billing');
    }
    
    /**
     * @group repositories
     * @group feature
     * @group completed
     * @test
     */
    function bad_input()
    {
        $casesInput = [
            [
                'name'=>$this->faker->name,
            ],
            [
                'name'=>$this->faker->name,
                'active'=>$this->faker->boolean,
            ],
            [
                'name'=>$this->faker->name,
                'active'=>$this->faker->boolean,
                'expirationDays'=>$this->faker->name,
            ],
            [
                'name'=>$this->faker->name,
                'expirationDays'=>$this->faker->numberBetween(30, 90),
            ],
        ];
        
        $this->runPostBadInput($casesInput);       
    }

    /**
     * 
     * @group repositories
     * @group feature
     * @group completed
     * @test
     */
    function unauthenticated_user()
    {
        $this->responseUnauthenticated($this->endpoint);
    }
    
}
