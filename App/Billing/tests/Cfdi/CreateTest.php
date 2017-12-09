<?php

namespace App\Billing\tests\Documents;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Melisa\Laravel\Database\InstallUser;
use App\Billing\tests\TestCase;
use App\Billing\tests\Documents\CreateTrait as InvoiceTrait;
use App\Billing\tests\Cfdi\CreateTrait as CfdiTrait;

class CfdiTest extends TestCase
{
    use DatabaseTransactions,
        InstallUser,
        InvoiceTrait,
        CfdiTrait;
    
    protected $connectionsToTransact = [
        'core', 
        'billing'
    ];
    
    /**
     * 
     * @group completed
     * @group cfdi
     */
    public function testCreate()
    {        
        $this->createCfdi();
    }
    
}
