<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
       $validated = request()->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'location_metadata' => 'nullable|string',
            'current_latitude' => 'nullable|numeric',
            'current_longitude' => 'nullable|numeric',
            'image' => 'nullable|image|max:2048',
            'user_id' => 'nullable|exists:users,id',
       ]);

       try {
            $locationMetadata = $validated['location_metadata'] ?? null;

            if (! $locationMetadata && ! empty($validated['current_latitude']) && ! empty($validated['current_longitude'])) {
                $locationMetadata = json_encode([
                    'source' => 'browser_geolocation',
                    'latitude' => (float) $validated['current_latitude'],
                    'longitude' => (float) $validated['current_longitude'],
                ]);
            }

            Report::create([
                'title' => $validated['title'],
                'status' => 'pending',
                'description' => $validated['description'],
                'category' => $validated['category'] ?? null,
                'location' => $validated['location'] ?? null,
                'location_metadata' => $locationMetadata,
                'image' => ! empty($validated['image']) ? $validated['image']->store('reports', 'public') : null,
                'user_id' => auth()->id(),
            ]);  
            
            return redirect('/report')->with('success', 'Report submitted successfully.');
        } catch (\Throwable $th) {
            return back()
                ->withInput()
                ->withErrors(['report' => 'Failed to submit report: '.$th->getMessage()]);
       }

    }
}
