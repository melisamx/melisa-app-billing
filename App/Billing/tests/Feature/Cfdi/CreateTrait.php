<?php

namespace App\Billing\tests\Feature\Cfdi;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
trait CreateTrait
{
    
    public function createCfdi($endPointCfdi, $endPointDocuments)
    {
        $idInvoice = $this->createInvoice($endPointDocuments);
        $user = $this->findUser();
        $response = $this->actingAs($user)
            ->json('post', $endPointCfdi, [
                'id'=>$idInvoice
            ]);
        
        $this->responseSuccess($response);
        $result = json_decode($response->getContent());
        
        $this->assertTrue(isset($result->data));
        $this->assertTrue(isset($result->data->idDocument));
        $this->assertTrue(isset($result->data->uuid));
        
        $this->assertDatabaseHas('documents', [
            'id'=>$result->data->idDocument,
            'uuid'=>$result->data->uuid
        ], 'billing');
        
        return $result->data;
    }
    
}
