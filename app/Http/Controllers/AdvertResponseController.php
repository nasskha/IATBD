<?php

namespace App\Http\Controllers;

use App\Models\AdvertResponse;
use App\Models\Pet;
use App\Models\PetsitterAdvertResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdvertResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = Auth::user();
        $advertResponses = AdvertResponse::where('target_user_id', $user->id)->get();
        $petsitterAdvertResponses = PetsitterAdvertResponse::where('target_user_id', $user->id)->get();

        return view('advert-responses.index', [
            'advertResponses' => $advertResponses,
            'petsitterAdvertResponses' => $petsitterAdvertResponses,
        ]);
    }

    public function dashboard(): View
    {
        $user = Auth::user();
        $advertResponsesInbox = AdvertResponse::where('target_user_id', $user->id)->get();
        $petsitterAdvertResponsesInbox = PetsitterAdvertResponse::where('target_user_id', $user->id)->get();

        $advertResponsesOutbox = AdvertResponse::where('user_id', $user->id)->get();
        $petsitterAdvertResponsesOutbox = PetsitterAdvertResponse::where('user_id', $user->id)->get();

        return view('dashboard', [
            'advertResponsesInbox' => $advertResponsesInbox,
            'petsitterAdvertResponsesInbox' => $petsitterAdvertResponsesInbox,
            'advertResponsesOutbox' => $advertResponsesOutbox,
            'petsitterAdvertResponsesOutbox' => $petsitterAdvertResponsesOutbox,
        ]);
    }

    public function outbox(): View
    {
        $user = Auth::user();
        $advertResponses = AdvertResponse::where('user_id', $user->id)->get();
        $petsitterAdvertResponses = PetsitterAdvertResponse::where('user_id', $user->id)->get();

        return view('advert-responses.index', [
            'advertResponses' => $advertResponses,
            'petsitterAdvertResponses' => $petsitterAdvertResponses,
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
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $target_pet = Pet::where('id', $request->pet_id)->first();


        $user->advertResponses()->create([
            'message' => $request->message,
            'pet_id' => $request->pet_id,
            'target_user_id' => $target_pet->user_id,
            'status' => 'pending',
        ]);

        return redirect()->route('pets.index')->with('status', 'Your response has been sent!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdvertResponse $advertResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdvertResponse $advertResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdvertResponse $advertResponse)
    {
        //
    }

    public function accept(AdvertResponse $advertResponse): RedirectResponse
    {
        $this->authorize('update', $advertResponse);
        $advertResponse->update([
            'status' => 'accepted',
        ]);
        return redirect()->back()->with('status', 'Response accepted!');
    }

    public function deny(AdvertResponse $advertResponse): RedirectResponse
    {
        $this->authorize('update', $advertResponse);
        $advertResponse->update([
            'status' => 'denied',
        ]);
        return redirect()->back()->with('status', 'Response declined.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdvertResponse $advertResponse): RedirectResponse
    {
        $this->authorize('destroy', $advertResponse);

        $advertResponse->delete();

        return redirect()->back()->with('status', 'Advert response deleted.');
    }
}
