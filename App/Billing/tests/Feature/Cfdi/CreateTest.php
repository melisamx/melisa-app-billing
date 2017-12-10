<?php

namespace App\Billing\tests\Feature\Documents;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Melisa\Laravel\Database\InstallUser;
use Melisa\Laravel\Tests\ResponseTrait;
use App\Billing\tests\TestCase;
use App\Billing\tests\Feature\Documents\CreateTrait as InvoiceTrait;
use App\Billing\tests\Feature\Cfdi\CreateTrait as CfdiTrait;

class CfdiTest extends TestCase
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
    
    protected $endpoint = 'cfdi';
    protected $endpointDocuments = 'documents';
    
    /**
     * 
     * @group cfdi
     * @group feature
     * @group completed
     * @test
     */
    public function create_success()
    {        
        $this->createCfdi($this->endpoint, $this->endpointDocuments);
    }
    
}
