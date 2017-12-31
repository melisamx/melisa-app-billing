<?php

namespace App\Billing\Logics\Contributors;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Repositories\ContributorsRepository;
use App\Billing\Repositories\ContributorsAddressesRepository;

/**
 * Create contributor
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    protected $disableFireEvent = true;
    protected $repoAddresses;

    public function __construct(
        ContributorsRepository $repository,
        ContributorsAddressesRepository $repoAddresses
    )
    {
        $this->repository = $repository;
        $this->repoAddresses = $repoAddresses;
    }
    
    public function create(&$input)
    {
        $idContributor = parent::create($input);
        
        if( !$idContributor) {
            return false;
        }
        
        if( !isset($input['idCountry'])) {
            return $idContributor;
        }
        
        if( !$this->repoAddresses->create([
            'idContributor'=>$idContributor,
            'idIdentityCreated'=>$input['idIdentityCreated'],
            'idCountry'=>$input['idCountry'],
            'idState'=>$input['idState'],
            'idMunicipality'=>$input['idMunicipality'],
            'address'=>$input['address'],
            'colony'=>$input['colony'],
            'postalCode'=>$input['postalCode'],
            'exteriorNumber'=>$input['exteriorNumber'],
            'isDefault'=>isset($input['isDefault']) ? $input['isDefault'] : true,
            'interiorNumber'=>$input['interiorNumber']
        ])) {
            return false;
        }
        
        return $idContributor;
    }
    
}
