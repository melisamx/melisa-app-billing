<?php

namespace App\Billing\Logics\Fake;

use Melisa\Laravel\Database\InstallSeeder;
use App\People\Models\Countries;
use App\People\Models\States;
use App\People\Models\Municipalities;
use App\Billing\Database\Seeds\Traits\InstallConcept;
use App\Billing\Models\Contributors;
use App\Billing\Models\ContributorsAddresses;
use App\Billing\Models\Coins;
use App\Billing\Models\Waytopay;
use App\Billing\Models\Customers;
use App\Billing\Models\UseCfdi;
use App\Billing\Models\FiscalRegime;
use App\Billing\Models\Repositories;

/**
 * Fake documents
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceLogic extends InstallSeeder
{
    use InstallConcept;
    
    public function getData()
    {
        $concept = $this->installConcept(
            '1', 
            'Servicios profesionales correspondientes a la semana en curso', 
            '81111504',
            'Servicios de programación de aplicaciones'
        );
        $conceptUnit = $this->installConceptUnit('ACT', 'Actividad');
        $idIdentity = $this->findIdentity()->id;
        
        $coin = Coins::updateOrCreate([
            'name'=>'Peso Mexicano',
            'shortName'=>'MXN'
        ]);
        $fiscalRegimeEmitter = $this->createFiscalRegime([
            'key'=>'612',
            'name'=>'Personas Físicas con Actividades Empresariales y Profesionales'
        ]);        
        $waytopay = Waytopay::updateOrCreate([
            'name'=>'Transferencia electrónica de fondos',
            'key'=>'03'
        ]);
        $repository = Repositories::updateOrCreate([
            'name'=>'Test'
        ], [
            'idIdentityCreated'=>$idIdentity,
        ]);        
        $useCfdi = UseCfdi::updateOrCreate([
            'key'=>'P01'
        ], [
            'name'=>'Por definir'
        ]);
        
        $transmitter = Contributors::updateOrCreate([
            'rfc'=>'HECL831114N48',
            'name'=>'Luis Josafat Heredia Contreras'
        ], [
            'idIdentityCreated'=>$idIdentity,
            'idFiscalRegime'=>$fiscalRegimeEmitter->id,
        ]);
        $transmitterAddress = ContributorsAddresses::updateOrCreate([
            'idContributor'=>$transmitter->id,
            'idCountry'=>Countries::where('code', 'MEX')->first()->id,
            'idState'=>States::where('name', 'Colima')->first()->id,
            'idMunicipality'=>Municipalities::where('name', 'Manzanillo')->first()->id,
        ], [
            'idIdentityCreated'=>$idIdentity,
            'address'=>'And. Playa la boquita',
            'colony'=>'Las brisas',
            'postalCode'=>28210,
            'exteriorNumber'=>158,
        ]);
        
        $contributorReceiver = Contributors::updateOrCreate([
            'rfc'=>'DSI011030TD5',
            'name'=>'DESARROLLO DE SOFTWARE PARA INTERNET SA DE CV'
        ], [
            'idIdentityCreated'=>$idIdentity,
            'idFiscalRegime'=>$fiscalRegimeEmitter->id,
        ]);
        $contributorAddress = ContributorsAddresses::updateOrCreate([
            'idContributor'=>$contributorReceiver->id,
            'idCountry'=>Countries::where('code', 'MEX')->first()->id,
            'idState'=>States::where('name', 'Colima')->first()->id,
            'idMunicipality'=>Municipalities::where('name', 'Manzanillo')->first()->id,
        ], [
            'idIdentityCreated'=>$idIdentity,
            'address'=>'And. Playa la boquita',
            'colony'=>'Las brisas',
            'postalCode'=>28210,
            'exteriorNumber'=>158,
        ]);
        
        $customer = Customers::updateOrCreate([
            'idRepository'=>$repository->id,
            'idContributor'=>$contributorReceiver->id,
        ], [
            'idIdentityCreated'=>$idIdentity,
            'idWaytopay'=>$waytopay->id,
            'active'=>0
        ]);
        
        return [
            'idTransmitter'=>$transmitter->id,
            'idTransmitterAddress'=>$transmitterAddress->id,
            'idCoin'=>$coin->id,
            'idWaytopay'=>$waytopay->id,
            'idCustomer'=>$customer->id,
            'idCustomerAddress'=>$contributorAddress->id,
            'idUseCfdi'=>$useCfdi->id,
            'subTotal'=>4195.80,
            'total'=>4000,
            'totalTaxRetention'=>867.13,
            'totalTaxTransfer'=>671.33,
            'concepts'=>json_encode([
                [
                    'id'=>$concept->id,
                    'idConceptKey'=>$concept->idConceptKey,
                    'idConceptUnit'=>$conceptUnit->id,
                    'description'=>$concept->name,
                    'unitValue'=>4195.80,
                    'quantity'=>1,
                    'taxes'=>[
                        [
                            'tax'=>'IVA',
                            'action'=>'t',
                            'typeFactor'=>'Tasa',
                            'base'=>4195.80,
                            'rateOrFee'=>0.16,
                        ],
                        [
                            'tax'=>'IVA',
                            'action'=>'r',
                            'typeFactor'=>'Tasa',
                            'base'=>4195.80,
                            'rateOrFee'=>0.106667,
                        ],
                        [
                            'tax'=>'ISR',
                            'action'=>'r',
                            'typeFactor'=>'Tasa',
                            'base'=>4195.80,
                            'rateOrFee'=>0.1,
                        ]
                    ],
                ]
            ])
        ];
    }
    
    public function createFiscalRegime($input)
    {
        return FiscalRegime::updateOrCreate($input);
    }
    
}
