<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->tag) {
            return view('listings', [
                'listings' => Listing::where('tags', 'LIKE', "%$request->tag%")->paginate(8)
            ]);
        } elseif ($request->search) {
            return view('listings', [
                'listings' => Listing::where('title', 'LIKE', "%$request->search%")
                    ->orWhere('tags', 'LIKE', "%$request->search%")
                    ->orWhere('company', 'LIKE', "%$request->search%")
                    ->orWhere('description', 'LIKE', "%$request->search%")
                    ->paginate(8)
            ]);
        };
        return view('listings', [
            'listings' => Listing::latest()->simplePaginate(8)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $formFields = $request->validate([
            'title' => ['required', 'max:40'],
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => ['required'],
            'website' => ['required'],
            'tags' => ['required'],
            'email' => ['required', 'email'],
            'description' => 'required',
        ]);

        $formFields['user_id'] = Auth::user()->id;


        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
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
    public function edit(Listing $listing)
    {
        return view('edit', [
            'listing' => $listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        if ($listing->user_id != Auth::user()->id) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => ['required', 'max:40'],
            'company' => ['required'],
            'location' => ['required'],
            'website' => ['required'],
            'tags' => ['required'],
            'email' => ['required', 'email'],
            'description' => 'required',
        ]);

        $formFields['user_id'] = Auth::user()->id;

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($request->former_image);
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return to_route('listings.index')->with('message', 'Listing updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        if ($listing->user_id != Auth::user()->id) {
            abort(403, 'Unauthorized Action');
        }
        Storage::disk('public')->delete($listing->logo);
        $listing->delete();
        return to_route('listings.index')->with('message', 'Listing deleted successfully');
    }

    public function manage()
    {
        return view('manage', [
            'listings' => Listing::where('user_id', Auth::user()->id)->get()
        ]);
    }
}
