<?php

namespace App\Http\Controllers;

use App\Http\Resources\RentalRessource;
use App\Models\Rental;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

use const Dom\NOT_FOUND_ERR;

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
    public function locationParUtilisateur(string $user_id)
    {
        //
        $rentals = Rental::with([
            'user',
            'equipment'
        ])
            ->where('user_id', $user_id);

        try {
            return RentalRessource::collection($rentals)
                ->response()
                ->setStatusCode(200);
        } catch (Exception $ex) {
            abort(404, 'Erreur serveur: ' . $ex->getMessage());
        }
    }



}
