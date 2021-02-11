<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Person;
use App\Http\Requests\PersonRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $people = Person::orderBy('id', 'asc')->get();

        return view('people.list', ['people' => $people]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Organization $organization
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('people.create', ['organizations' => Organization::all()]);
    }

    /**
     * Store a newly created resource in storage.
     * @param PersonRequest $request
     * @return RedirectResponse
     */
    public function store(PersonRequest $request): RedirectResponse
    {
        $person = new Person();
        $person->name = $request->get('name');
        $person->save();

        // Add new related organizations
        $person->organizations()->attach($request->get('organization_ids'));

        return redirect()->route('people.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|View
     */
    public function edit(Person $person)
    {
        $currentRelatedOrgs = (array) $person->organizations()
            ->select('organizations.id')
            ->pluck('id')
            ->toArray();

        return view('people.edit', [
            'person' => $person,
            'currentRelatedOrgs' => $currentRelatedOrgs,
            'organizations' => Organization::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return RedirectResponse
     */
    public function update(PersonRequest $request, Person $person): RedirectResponse
    {
        $person->name = $request->get('name');
        $person->save();

        // Get current related organizations
        $current_organizations = $person->organizations()
            ->select('organizations.id')
            ->pluck('id')
            ->toArray();

        // Remove current related organizations if any
        if(count($current_organizations)) {
            $person->organizations()->detach($current_organizations);
        }

        // Update related organizations from form
        $person->organizations()->attach($request->get('organization_ids'));

        return redirect()->route('people.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return RedirectResponse
     */
    public function destroy(Person $person): RedirectResponse
    {
        $person->delete();

        return redirect()->route('people.list');
    }
}
