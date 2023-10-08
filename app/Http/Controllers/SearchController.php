<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function liveSearch(Request $request)
    {
        $query = $request->input('query');

        // Perform your search logic here and get the results
        $results = Articles::where('title', 'like', '%' . $query . '%')->orWhere('description', 'like', '%' . $query . '%')->get();

        return response()->json($results);
    }

}
