<?php

namespace App\Http\Controllers;

use App\Http\Requests\Person\StoreRequest;
use App\Http\Requests\Person\UpdateRequest;
use App\Http\Resources\Person\PersonResource;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = Person::all();
        return PersonResource::collection($people);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $person = Person::create($data);
        return response([]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        return new PersonResource($person);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Person $person)
    {
        $data = $request->validated();
        $person->update($data);
        return response([]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Person $person)
    {
        $person->delete();
        return response([]);
    }
}
