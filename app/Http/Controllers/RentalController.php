<?php

namespace App\Http\Controllers;

use App\Http\Resources\RentalRessource;
use App\Models\Rental;
use Exception;
use OpenApi\Attributes as OA;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    #[OA\Get(
        path: "/api/rental/{user_id}",
        summary: "Retourne les locations d'un utilisateur",
        tags: ["Rentals"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Identifiant de l'utilisateur",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "OK"
            ),
            new OA\Response(
                response: 404,
                description: "Rental introuvable"
            ),
            new OA\Response(
                response: 500,
                description: "Erreur Serveur"
            )
        ]
    )]
    public function locationParUtilisateur(string $user_id)
    {
        //
       
        $rentals = Rental::with([
            'user',
            'equipment.categorie'
        ])->where('user_id','=', (int) $user_id)->get();

        try {
            return RentalRessource::collection($rentals)
                ->response()
                ->setStatusCode(200);
        } catch (Exception $ex) {
            abort(500, 'Erreur serveur: ' . $ex->getMessage());
        }
    }
}
