<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ReviewController extends Controller
{
    
    /**
     * Remove the specified resource from storage.
     */
    #[OA\Delete(
    path: "/api/reviews/delete/{id}",
    summary: "Supprimer un Critère",
    tags: ["Reviews"],
    parameters: [
        new OA\Parameter(
            name: "id",
            in: "path",
            required: true,
            description: "Identifiant du Critère à supprimer",
            schema: new OA\Schema(type: "integer", example: 1)
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Critère supprimé avec succès"
        ),
        new OA\Response(
            response: 404,
            description: "Critère introuvable"
        ),
             new OA\Response(
                response: 500,
                description: "Erreur Serveur"
            )
    ]
)]
    public function destroy(string $id)
    {
        //

        $review=Review::find($id);
        if(!$review){
             return response()->json([
                'message' => 'Critère non trouvé'
            ], 404);
        }

        $review->destroy();

        return response()->json([
                'message' => 'Critère supprimé'
            ], 204);
    }
}
