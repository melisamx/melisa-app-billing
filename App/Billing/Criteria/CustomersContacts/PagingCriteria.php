<?php

namespace App\Billing\Criteria\CustomersContacts;

use Melisa\Laravel\Criteria\FilterCriteria;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class PagingCriteria extends FilterCriteria
{
    
    public function apply($model, $repository, array $input = [])
    {        
        $builder = parent::apply($model, $repository, $input);
        $dbPeople = config('database.connections.people.database') . '.';
        
        if( isset($input['query'])) {
            $builder = $builder->where('p.name', 'like', '%' . $input['query'] . '%');
        }
        
        return $builder
            ->select([
                'customersContacts.*',
                'p.name',
                'p.lastName',
                \DB::raw(implode('', [
                    '(',
                        'select email from '. $dbPeople . 'peopleEmails ',
                        'where idPeople=p.id ',
                        'order by isPrimary ',
                        'limit 1 ',
                    ') as email'
                ])),
                \DB::raw(implode('', [
                    '(',
                        'select number from '. $dbPeople . 'peoplePhoneNumbers ',
                        'where idPeople=p.id ',
                        'order by isPrimary ',
                        'limit 1 ',
                    ') as phoneNumber'
                ]))
            ])
            ->join(
                     /* necesary relation other database */
                \DB::raw($dbPeople . 'people p'),
                \DB::raw('p.id'), '=', 'customersContacts.idPeople'
            )
            ->orderBy(\DB::raw('p.name'));        
    }
    
}
