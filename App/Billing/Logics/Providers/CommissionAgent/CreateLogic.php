<?php

namespace App\Billing\Logics\Providers\CommissionAgent;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Repositories\ProvidersRepository;
use App\Billing\Repositories\TypesProvidersRepository;

/**
 * Create customer and contributor
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    
    protected $eventSuccess = 'billing.providers.commissionAgent.create.success';
    protected $repoTypesProviders;

    public function __construct(
        ProvidersRepository $repository,
        TypesProvidersRepository $repoTypesProviders
    )
    {
        $this->repository = $repository;
        $this->repoTypesProviders = $repoTypesProviders;
    }
    
    public function create(&$input)
    {
        $typeProvider = $this->getTypeProvider();
        
        if( !$typeProvider) {
            return false;
        }
        
        $input ['slug']= str_slug($input['name']);
        $input ['idTypeProvider']= $typeProvider->id;
        return parent::create($input);
    }
    
    public function getTypeProvider()
    {
        $result = $this->repoTypesProviders->getModel()
            ->where('slug', 'comisionista')
            ->first();
        
        if( !$result) {
            return $this->error('Imposible obtener el tipo de proveedor');
        }
        
        return $result;
    }
    
}
