<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetsitterAdvertUpdateRequest;
use App\Models\AdvertResponse;
use App\Models\PetsitterAdvert;
use App\Models\PetsitterAdvertResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PetsitterAdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('petsitter-adverts.index', [
//            'userPetsitterAdvert' => PetsitterAdvert::where('user_id', Auth::id())->get(),
            'petsitterAdverts' =>
                PetsitterAdvert::where('user_id', '!=', Auth::id())
                    ->where('advert_active', true)->get(),
            'userHasAdvert' => PetsitterAdvert::where('user_id', Auth::id())->exists(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('petsitter-adverts.create', [
            'userHasAdvert' => PetsitterAdvert::where('user_id', Auth::id())->exists(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PetsitterAdvertUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validated();

        // advert_active swapped functionality bcuz it's draft functionality now
        if ($request->has('advert_active')) {
            $validated['advert_active'] = false;
        } else {
            $validated['advert_active'] = true;
        }

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('petsitter_adverts','public');
            $validated['picture'] = $path;
        }

        if ($request->hasFile('house_pictures')) {
            $pictures = [];
            foreach ($request->file('house_pictures') as $pic) {
                $pictures[] = $pic->store('house_pictures','public');
            }
            $validated['house_pictures'] = $pictures;
        }

        $user->petsitterAdvert()->create($validated);

        return redirect()->route('petsitter-adverts.index')->with('success', 'Advert created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PetsitterAdvert $petsitterAdvert): View
    {
        return view('petsitter-adverts.show', [
            'petsitterAdvert' => $petsitterAdvert,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {
        return view('petsitter-adverts.edit', [
            'userHasAdvert' => PetsitterAdvert::where('user_id', Auth::id())->exists(),
            'petsitterAdvert' => PetsitterAdvert::where('user_id', Auth::id())->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PetsitterAdvert $petsitterAdvert): RedirectResponse
    {
        $this->authorize('update', $petsitterAdvert);
        $petsitterAdvert->update($request->all());


        // actually draft functionality so logic swapped
        $petsitterAdvert->update([
            'advert_active' => !$request->has('advert_active'),
        ]);

        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('petsitter_adverts', 'public');
            $petsitterAdvert->update([
                'picture' => $path,
            ]);
        }

        if ($request->hasFile('house_pictures')) {
            $pictures = [];
            foreach ($request->file('house_pictures') as $pic) {
                $pictures[] = $pic->store('public');
            }
            $petsitterAdvert->update([
                'house_pictures' => $pictures,
            ]);
        }

        return redirect()->route('petsitter-adverts.index')->with('success', 'Advert updated successfully!');
    }

    public function review(Request $request, AdvertResponse $advertResponse): RedirectResponse
    {
        $petsitterAdvert = PetsitterAdvert::where('user_id', $advertResponse->target_user_id)->first();

        $this->authorize('review', $petsitterAdvert);

        $existingReviews = $petsitterAdvert->reviews ?? [];
        $newReview = $request->review;

        // Append the new review to the existing reviews array
        $existingReviews[] = $newReview;

        $petsitterAdvert->update([
            'reviews' => $existingReviews,
        ]);

        $advertResponse->delete();

        return redirect()->route('dashboard')->with('status', 'Review posted!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PetsitterAdvert $petsitterAdvert): RedirectResponse
    {
        $this->authorize('delete', $petsitterAdvert);
        $petsitterAdvert->delete();
        return redirect()->route('petsitter-adverts.index')->with('success', 'Advert deleted successfully :(');
    }

    public function respond(PetsitterAdvert $petsitterAdvert): View
    {
        return view('petsitter-adverts.respond', [
            'petsitterAdvert' => $petsitterAdvert,
        ]);
    }
}
