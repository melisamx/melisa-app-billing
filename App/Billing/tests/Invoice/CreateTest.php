<?php

namespace App\Billing\tests\Invoice;

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
     * @group invoice
     */
    public function testCreate()
    {
        return $this->createInvoice();
    }
    
}
