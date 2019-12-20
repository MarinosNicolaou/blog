<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
class FavoritesController extends Controller
{   
        
    /**
     * if the guestion is set as favorite
     * then refresh the page and show the appropriate message
     */
    public function store(Question $question)
    {
        $question->favorites()->attach(auth()->id());

       
            return response()->json(null, 204);
        
    }

    /**
     * if the guestion is unset as favorite
     * then refresh the page and show the appropriate message
     */
    public function destroy(Question $question)
    {
        $question->favorites()->detach(auth()->id());

       
            return response()->json(null, 204);
       
    }
}
