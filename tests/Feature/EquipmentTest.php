<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EquipmentTest extends TestCase
{
    use RefreshDatabase;

    // optension des equipements
    public function test_can_get_all_equipments()
    {
        // executer les seed
        $this->seed();

        // Envoyer une requête GET
        $response = $this->getJson('/api/equipments');

        // Vérifier le code HTTP
        $response->assertStatus(200);

        // Vérifier la présence des données
        $response->assertJsonCount(1, 'data');
    }

    //optenir la popularite
    public function test_get_equipment_populaire()
    {
        // executer les seed
        $this->seed();
        
        $response = $this->getJson('/api/equipments/1/popularity');

        $response->assertStatus(200);
    }


    //pour les erreurs
    public function test_get_equipment_populaire_not_found()
    {
        // executer les seed
        $this->seed();

        $response = $this->getJson('/api/equipments/90/popularity');

        $response->assertStatus(404);
    }


    public function test_can_get_all_equipments_not_found()
    {
        // executer les seed
        $this->seed();

        // Envoyer une requête GET
        $response = $this->getJson('/api/equipment');

        // Vérifier le code HTTP
        $response->assertStatus(404);

    }
    
}
