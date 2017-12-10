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
    
    /**
     * 
     * @group completed
     * @group documents
     * @test
     */
    public function create_invoice()
    {
        return $this->createInvoice();
    }
    
}
