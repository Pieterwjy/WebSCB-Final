<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebToken;

class WebTokenController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $existingToken = WebToken::where('web_token', $request->token)->first();
    
        if ($existingToken) {
            return response()->json(['error' => 'Token already exists'], 400);
        }
    
        $webtoken = new WebToken();
        $webtoken->web_token = $request->token;
        $webtoken->save();
    
        return response()->json([], 201);
    }
}
