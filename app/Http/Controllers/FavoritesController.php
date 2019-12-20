<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
class FavoritesController extends Controller
{   
    /**
     * Constructor
     * to make sure if the user is signed in
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * if the guestion is set as favorite
     * then refresh the page and show the appropriate message
     */
    public function store(Question $question)
    {
        $question->favorites()->attach(auth()->id());

        if (request()->expectsJson()) {
            return response()->json(null, 204);
        }
        return back();
    }

    /**
     * if the guestion is unset as favorite
     * then refresh the page and show the appropriate message
     */
    public function destroy(Question $question)
    {
        $question->favorites()->detach(auth()->id());

        if (request()->expectsJson()) {
            return response()->json(null, 204);
        }
        return back();
    }
}
