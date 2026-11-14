<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategorieRessource;
use App\Http\Resources\EquipmentRessource;
use App\Models\Categorie;
use App\Models\Equipment;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($equipment_id)
    {
        //
        $equipments = Equipment::with('categorie')->paginate(20);
        try {
            return EquipmentRessource::collection($equipments)->setStatusCode(200);
        } catch (Exception $ex) {
            abort(500, 'Erreur serveur: ' . $ex->getMessage());
        }
    }


    //Reponse optenu en utilisant chatgpt
    public function averageRentalPrice(Request $request, $equipment_id)
    {
        // Validation des paramètres GET
        $validated = $request->validate([
            'minDate' => 'sometimes|nullable|date_format:Y-m-d',

            'maxDate' => [
                'sometimes',
                'nullable',
                'date_format:Y-m-d',
                'after:minDate'
            ]
        ]);

        // Vérifier l'existence de l'équipement
        $equipment = Equipment::findOrFail($equipment_id);

        // Récupérer les locations de cet équipement
        $query = $equipment->rentals();

        // Filtre date minimale
        if (!empty($validated['minDate'])) {
            $query->whereDate('startDate', '>=', $validated['minDate']);
        }

        // Filtre date maximale
        if (!empty($validated['maxDate'])) {
            $query->whereDate('startDate', '<=', $validated['maxDate']);
        }

        // Calculer la moyenne
        $average = $query->avg('totalPrice');

        return response()->json([
            'equipment_id' => $equipment->id,
            'averageTotalPrice' => $average !== null
                ? round((float) $average, 2)
                : null
        ], 200);
    }


    //calcul de popurarite
    //Reponse optenu en utilisant chatgpt
    public function popularite(string $id)
    {
        // Récupérer l'équipement
        $equipment = Equipment::withCount('rentals')
            ->findOrFail($id);

        // Nombre total de locations
        $numberOfRentals = $equipment->rentals_count;

        // Calculer la moyenne des évaluations
        $averageRating = Review::whereHas('rental', function ($query) use ($id) {
            $query->where('equipment_id', $id);
        })->avg('rating') ?? 0;

        // Calculer la popularité
        $popularity = ($numberOfRentals * 0.6)
            + ($averageRating * 0.4);

        return response()->json([
            'equipment_id' => $equipment->id,
            'numberOfRentals' => $numberOfRentals,
            'averageRating' => round((float) $averageRating, 2),
            'popularity' => round($popularity, 2)
        ], 200);
    }
}
