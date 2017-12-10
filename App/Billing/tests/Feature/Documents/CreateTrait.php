<?php

namespace App\Billing\tests\Feature\Documents;

use App\Billing\Models\DocumentsConcepts;
use App\Billing\Models\Taxes;
use App\Billing\Logics\Fake\Documents\InvoiceLogic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
trait CreateTrait
{
    
    public function createInvoice()
    {
        $user = $this->findUser();
        $data = app(InvoiceLogic::class)->getData();
        
        $response = $this->actingAs($user)
            ->json('post', 'documents', $data);
        
        $this->responseCreatedSuccess($response);
        $result = json_decode($response->getContent());
        
        $this->assertDatabaseHas('documents', [
            'id'=>$result->data->id
        ], 'billing');
        
        foreach(json_decode($data['concepts'], true) as $concept) {
            $this->assertDatabaseHas('documentsConcepts', [
                'idDocument'=>$result->data->id,
                'idConcept'=>$concept['id'],
                'amount'=>$concept['quantity'] * $concept['unitValue'],
            ], 'billing');
            
            $recordConcept = DocumentsConcepts::where([
                'idDocument'=>$result->data->id,
                'idConcept'=>$concept['id'],
            ])->first();
            
            foreach($concept['taxes'] as $tax) {
                $recordTax = Taxes::where('name', $tax['tax'])->first();
                
                $this->assertDatabaseHas('documentsConceptsTaxes', [
                    'idDocumentConcept'=>$recordConcept->id,
                    'idTax'=>$recordTax->id,
                    'amount'=>round($tax['base'] * $tax['rateOrFee'], 2),
                ], 'billing');
            }
        }
        
        return $result->data->id;
    }
    
}
