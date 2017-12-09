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
            ])
            ->assertStatus(200)
            ->assertJson([
                'success'=>true
            ]);
        
        $result = json_decode($response->getContent());
        
        $this->assertDatabaseHas('documents', [
            'id'=>$result->data->idInvoice,
            'uuid'=>$result->data->uuid
        ], 'billing');
        
        return $result->data;
    }
    
}
