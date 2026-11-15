<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $review=Review::find($id);
        if(!$review){
             return response()->json([
                'message' => 'Critère non trouvé'
            ], 404);
        }

        $review->delete();

        return response()->json([
                'message' => 'Critère supprimé'
            ], 204);
    }
}
