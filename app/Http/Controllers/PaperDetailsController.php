<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pastpaper;
use Illuminate\Http\Request;

class PaperDetailsController extends Controller
{
    public function showPaperDetails(Request $request)
    {
        
        // Retrieve submitted data from the session
        $selectedValues = $request->session()->get('selectedValues');
       
        // Use the retrieved data to dynamically change values in the view
        return view('paperdetails', compact('selectedValues'));
    }
}
