<?php

namespace App\Billing\tests;

use Melisa\Laravel\Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    
    protected $bootstrapFile = 'billing';
    
}
