<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\Mechanic;
use Illuminate\Http\Request;
use Validator;


class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mechanics = Mechanic::all();

        //FILTRAVIMAS
        if ($request->mechanic_id) {
            $trucks = Truck::where('mechanic_id', $request->mechanic_id)->get();
            $filterBy = $request->mechanic_id;
        }
        else {
            $trucks = Truck::all();
        }

        //RUSIAVIMAS
        if ($request->sort && 'asc' == $request->sort) {
            $trucks = $trucks->sortBy('maker');
            $sortBy = 'asc';
        }
        elseif ($request->sort && 'desc' == $request->sort) {
            $trucks = $trucks->sortByDesc('maker');
            $sortBy = 'desc';
        }
        
        return view('truck.index', [
            'trucks' => $trucks,
            'mechanics' => $mechanics,
            'filterBy' => $filterBy ?? 0,
            'sortBy' => $sortBy ?? ''
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mechanics = Mechanic::all();
        return view('truck.create', ['mechanics' => $mechanics]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'truck_maker' => ['required', 'min:1', 'max:64'],
                'truck_plate' => ['required', 'min:1', 'max:6'],
                'make_year' => ['required', 'integer', 'digits:4'],
                'mechanic_notices' => ['required', 'min:2', 'max:64'],
            ],

            [
                'truck_maker.required' => 'The truck maker must be entered.',
                'truck_plate.required' => 'The truck plate must be entered.',
                'make_year.required' => 'The truck make year must be entered.',
                'mechanic_notices.required' => 'The mechanic notices must be entered.',
                'truck_maker.min' => 'The truck_maker must be at least 1 characters.',
                'truck_plate.min' => 'The truck_plate must be at least 1 characters.',
                'make_year.digits' => 'The make_year must be 4 digits.',
                'make_year.integer' => 'The make_year must be an integer.',
                'mechanic_notices.min' => 'The mechanic notices must be at least 2 characters.'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $truck = new Truck;
        $truck->maker = $request->truck_maker;
        $truck->plate = $request->truck_plate;
        $truck->make_year = $request->make_year;
        $truck->mechanic_notices = $request->mechanic_notices;
        $truck->mechanic_id = $request->mechanic_id;
        $truck->save();
        return redirect()->route('truck.index')->with('success_message', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        return view('truck.show', ['truck' => $truck]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        $mechanics = mechanic::all();
        return view('truck.edit', ['truck' => $truck, 'mechanics' => $mechanics]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truck $truck)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'truck_maker' => ['required', 'min:1', 'max:64'],
                'truck_plate' => ['required', 'min:1', 'max:6'],
                'make_year' => ['required', 'integer', 'digits:4'],
                'mechanic_notices' => ['required', 'min:2', 'max:64'],
            ],

            [
                'truck_maker.required' => 'The truck maker must be entered.',
                'truck_plate.required' => 'The truck plate must be entered.',
                'make_year.required' => 'The truck make year must be entered.',
                'mechanic_notices.required' => 'The mechanic notices must be entered.',
                'truck_maker.min' => 'The truck_maker must be at least 1 characters.',
                'truck_plate.min' => 'The truck_plate must be at least 1 characters.',
                'make_year.digits' => 'The make_year must be 4 digits.',
                'make_year.integer' => 'The make_year must be an integer.',
                'mechanic_notices.min' => 'The mechanic notices must be at least 2 characters.'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $truck->maker = $request->truck_maker;
        $truck->plate = $request->truck_plate;
        $truck->make_year = $request->make_year;
        $truck->mechanic_notices = $request->mechanic_notices;
        $truck->mechanic_id = $request->mechanic_id;
        $truck->save();
        return redirect()->route('truck.index')->with('success_message', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truck $truck)
    {
        $truck->delete();
        return redirect()->route('truck.index')->with('success_message', 'Deleted successfully.');
    }
}
