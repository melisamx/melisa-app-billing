<?php

namespace App\Billing\Logics\Providers;

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
    
    protected $eventSuccess = 'billing.providers.create.success';
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
        
        if( !isset($input ['slug'])) {
            $input ['slug']= str_slug($input['name']);
        }
        
        $input ['idTypeProvider']= $typeProvider->id;
        return parent::create($input);
    }
    
    public function getTypeProvider()
    {
        $result = $this->repoTypesProviders->getModel()
            ->where('slug', $this->getSlugTypeProvider())
            ->first();
        
        if( !$result) {
            return $this->error('Imposible obtener el tipo de proveedor');
        }
        
        return $result;
    }
    
    public function getSlugTypeProvider()
    {
        return 'others';
    }
    
}
