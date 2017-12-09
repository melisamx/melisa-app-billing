<?php

namespace App\Billing\tests\Cfdi;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
trait CreateTrait
{
    
    public function createCfdi()
    {
        $idInvoice = $this->createInvoice();
        $user = $this->findUser();
        $response = $this->actingAs($user)
            ->json('post', 'cfdi', [
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
