<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->tag) {
            return view('listings', [
                'listings' => Listing::where('tags', 'LIKE', "%$request->tag%")->get()
            ]);
        } elseif ($request->search) {
            return view('listings', [
                'listings' => Listing::where('title', 'LIKE', "%$request->search%")
                    ->orWhere('tags', 'LIKE', "%$request->search%")
                    ->orWhere('company', 'LIKE', "%$request->search%")
                    ->orWhere('description', 'LIKE', "%$request->search%")
                    ->orWhere('location', 'LIKE', "%$request->search%")
                    ->get()
            ]);
        };
        return view('listings', [
            'listings' => Listing::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return view('listing', [
            'listing' => $listing
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
