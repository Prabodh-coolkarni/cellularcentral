<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\review;

class reviewController extends Controller
{
    public function store(Request $request)
    {
        // Save data to the database
        review::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ]);
    
        // Redirect to the previous page
        return redirect($request->input('previous_url'))->with('message', 'Your message has been sent successfully!');
    }
    
}
