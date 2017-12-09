<?php

namespace App\Billing\tests\Documents;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Melisa\Laravel\Database\InstallUser;
use App\Billing\tests\TestCase;

class CreateTest extends TestCase
{
    use DatabaseTransactions,
        InstallUser,
        CreateTrait;
    
    protected $connectionsToTransact = [
        'core', 
        'billing'
    ];
    
    /**
     * 
     * @group completed
     * @group documents
     */
    public function testCreate()
    {
        return $this->createInvoice();
    }
    
}
