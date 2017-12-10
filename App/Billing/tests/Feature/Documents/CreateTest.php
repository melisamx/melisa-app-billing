<?php

namespace App\Billing\tests\Feature\Documents;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Melisa\Laravel\Database\InstallUser;
use Melisa\Laravel\Tests\ResponseTrait;
use App\Billing\tests\TestCase;
use App\Billing\tests\Feature\Documents\CreateTrait;

class CreateTest extends TestCase
{
    use DatabaseTransactions,
        InstallUser,
        CreateTrait,
        ResponseTrait;
    
    protected $connectionsToTransact = [
        'core', 
        'billing'
    ];
    
    protected $endpoint = 'documents';
    
    /**
     * 
     * @group documents
     * @group feature
     * @group completed
     * @test
     */
    public function create_invoice()
    {
        return $this->createInvoice($this->endpoint);
    }
    
    /**
     * 
     * @group documents
     * @group feature
     * @group completed
     * @test
     */
    function unauthenticated_user()
    {
        $this->responseUnauthenticated($this->endpoint);
    }
    
}
