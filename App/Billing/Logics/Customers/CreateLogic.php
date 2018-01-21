<?php

namespace App\Billing\Logics\Customers;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\CustomersRepository;
use App\Billing\Logics\Contributors\CreateLogic as CreateContributor;
use App\Billing\Logics\Customers\ReportLogic;

/**
 * Create customer and contributor
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic
{
    use LogicBusiness;
    
    protected $customers;
    protected $contributors;
    protected $reportCustomer;
    protected $eventDisabled = false;
    protected $eventSuccess = 'billing.customers.create.success';

    public function __construct(
        CustomersRepository $customers,
        CreateContributor $contributors,
        ReportLogic $reportCustomer
    )
    {
        $this->customers = $customers;
        $this->contributors = $contributors;
        $this->reportCustomer = $reportCustomer;
    }
    
    public function init(array $input)
    {
        $this->customers->beginTransaction();
        
        $this->inyectIdentity($input);
        
        if( !$this->isValidCustomer($input)) {
            return $this->customers->rollback();
        }
        
        $idContributor = $this->createContributor($input);
        
        if( !$idContributor) {
            return $this->customers->rollback();
        }
        
        $idCustomer = $this->createCustomer($idContributor, $input);
        
        if( !$idCustomer) {
            return $this->customers->rollback();
        }
        
        $event = [
            'id'=>$idCustomer,
            'idContributor'=>$idContributor,
        ];
        
        if( $this->eventDisabled) {
            $this->customers->commit();
            return $event;
        }
        
        if ( !$this->fireEvent($event)) {
            return $this->customers->rollBack();
        }
        
        $report = $this->getRecord($idCustomer);
        
        if( !$report) {
            return $this->customers->rollBack();
        }
        
        $this->customers->commit();
        return $report;        
    }
    
    public function isValidCustomer($input)
    {
        $result = $this->customers->getModel()
            ->select('c.*')
            ->join('contributors as c', 'c.id', '=', 'customers.idContributor')
            ->where([
                'idRepository'=>$input['idRepository'],
                'rfc'=>$input['rfc'],
                'name'=>$input['name'],
            ])
            ->first();
        
        if( !$result) {
            return true;
        }
        
        return $this->error('Ya existe un cliente con el RFC {r} y el nombre {n}', [
            'r'=>$input['rfc'],
            'n'=>$input['name'],
        ]);
    }
    
    public function getRecord($id)
    {
        $result = $this->reportCustomer->init($id);
        
        if( !$result) {
            return $this->error('Imposible obtener el reporte del cliente recien creado');
        }
        
        return $result;
    }
    
    public function eventDisabled()
    {
        $this->eventDisabled = true;
        return $this;
    }
    
    public function createContributor(&$input)
    {        
        $contributor = $this->contributors->init($input);
        
        if( !$contributor) {
            return $this->error('Imposible crear contribuyente');
        }
        
        return $contributor['id'];        
    }
    
    public function createCustomer($idContributor, &$input)
    {
        $id = $this->customers->create([
            'idRepository'=>$input['idRepository'],
            'idContributor'=>$idContributor,
            'active'=>$input['active'],
            'idWaytopay'=>$input['idWaytopay'],
            'idIdentityCreated'=>$input['idIdentityCreated'],
            'expirationDays'=>$input['expirationDays'],
        ]);
        
        if( $id) {
            return $id;
        }
        
        return $this->error('Imposible crear cliente');  
    }
    
}
