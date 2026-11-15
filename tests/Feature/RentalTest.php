<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RentalTest extends TestCase
{

    use RefreshDatabase;

    public function test_get_location_par_utilisateur()
    {

        $this->seed();

        $response = $this->getJson('/api/rental/2');

        // Vérifier le code HTTP
        $response->assertStatus(200);
    }

    // suppression
    public function test_delete_review()
    {
        $this->seed();


        $response = $this->deleteJson("/api/reviews/delete/4");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('reviews', [
            'id' => 4,
        ]);
    }

    //pour les erreurs
    public function test_delete_review_not_found()
{
    $this->seed();

    $response = $this->deleteJson('/api/reviews/delete/55');

    $response->assertStatus(404);
}

public function test_get_location_par_utilisateur_not_found()
    {

        $this->seed();

        $response = $this->getJson('/api/rental/80');

        // Vérifier le code HTTP
        $response->assertStatus(404);
    }
}
