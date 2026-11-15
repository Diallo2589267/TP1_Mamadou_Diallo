<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserRessource;
use App\Models\User;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OA\Post(
        path: "/api/users/create",
        summary: "Ajouter un nouvel utilisateur",
        tags: ["Users"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["firstName", "lastName", "email", "phone"],
                properties: [
                    new OA\Property(property: "firstName", type: "string", example: "Mamadou"),
                    new OA\Property(property: "lastName", type: "string", example: "Diallo"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "mamadou@example.com"),
                    new OA\Property(property: "phone", type: "string", example: "+15140041144"),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Utilisateur créé avec succès"
            ),
            new OA\Response(
                response: 422,
                description: "Erreur de validation"
            ),
             new OA\Response(
                response: 500,
                description: "Erreur Serveur"
            )
        ]
    )]
    public function store(StoreUserRequest $request)
    {
        //
        $user = User::create($request->validated());
        return (new UserRessource($user)->response()->setStatusCode(201));
    }


    /**
     * Update the specified resource in storage.
     */
    #[OA\Put(
        path: "/api/users/update/{id}",
        summary: "Modifier un utilisateur",
        tags: ["Users"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Identifiant de l'utilisateur",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["firstName", "lastName", "email", "phone"],
                properties: [
                    new OA\Property(property: "firstName", type: "string", example: "Sow"),
                    new OA\Property(property: "lastName", type: "string", example: "Oumar"),
                    new OA\Property(property: "email", type: "string", format: "email", example: "oumar@example.com"),
                    new OA\Property(property: "phone", type: "string", example: "+15140042144")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Utilisateur modifié avec succès"
            ),
            new OA\Response(
                response: 404,
                description: "Utilisateur introuvable"
            ),
            new OA\Response(
                response: 422,
                description: "Erreur de validation"
            ),
             new OA\Response(
                response: 500,
                description: "Erreur Serveur"
            )
        ]
    )]
    public function update(UpdateUserRequest $request, string $id)
    {
        //
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'Utilisateur non trouvé'
            ], 404);
        }
        $user->update($request->validated());
        return (new UserRessource($user)->response()->setStatusCode(200));
    }
}
