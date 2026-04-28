<?php

namespace App\Http\Controllers;

use App\Models\Destination;

class DestinationController extends Controller
{
    public function show($slug)
    {
        // Cari destinasi berdasarkan slug, jika tidak ada muncul 404
        $destination = Destination::where('slug', $slug)->firstOrFail();
        
        return view('destinations.show', [
            'destination' => $destination
        ]);
    }
}
