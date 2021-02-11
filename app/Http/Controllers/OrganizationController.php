<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;;
use App\Models\Person;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $organizations = Organization::orderBy('id', 'asc')->get();

        return view('organizations.list', ['organizations' => $organizations]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('organizations.create', ['people' => Person::all()]);
    }

    /**
     * Store a newly created resource in storage.
     * @param OrganizationRequest $request
     * @return RedirectResponse
     */
    public function store(OrganizationRequest $request): RedirectResponse
    {
        $organization = new Organization();
        $organization->name = $request->get('name');
        $organization->save();

        // Only add new related people if person_ids field is not empty
        if($request->has('person_ids')) {
            $organization->people()->attach($request->get('person_ids'));
        }

        return redirect()->route('organizations.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Organization $organization
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|View
     */
    public function edit(Organization $organization)
    {
        $currentRelatedPeople = (array) $organization->people()
            ->select('people.id')
            ->pluck('id')
            ->toArray();

        return view('organizations.edit', [
            'organization' => $organization,
            'currentRelatedPeople' => $currentRelatedPeople,
            'people' => Person::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrganizationRequest $request
     * @param \App\Models\Organization $organization
     * @return RedirectResponse
     */
    public function update(OrganizationRequest $request, Organization $organization): RedirectResponse
    {
        $organization->name = $request->get('name');
        $organization->save();

        // Get current related people
        $current_people = $organization->people()
            ->select('people.id')
            ->pluck('id')
            ->toArray();

        // Remove current related people if person_ids is unset by user
        if(count($current_people)) {
            $organization->people()->detach($current_people);
        }

        // Only attach related people if person_ids is not empty
        if($request->has('person_ids')) {
            $organization->people()->attach($request->get('person_ids'));
        }

        return redirect()->route('organizations.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return RedirectResponse
     */
    public function destroy(Organization $organization): RedirectResponse
    {
        $organization->delete();

        return redirect()->route('organizations.list');
    }
}
