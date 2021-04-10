<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;
use Validator;

class MechanicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ('name' == $request->sort) {
            $mechanics = Mechanic::orderBy('name')->get();
        } else if ('surname' == $request->sort) {
            $mechanics = Mechanic::orderBy('surname')->get();
        } else {
            $mechanics = Mechanic::all();
        }
        return view('mechanic.index', ['mechanics' => $mechanics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mechanic.create');
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
                'mechanic_name' => ['required', 'min:3', 'max:64'],
                'mechanic_surname' => ['required', 'min:3', 'max:64'],
            ],

            [
                'mechanic_name.required' => 'The mechanic name must be entered.',
                'mechanic_surname.min' => 'The mechanic surname must be at least 3 characters.',
                'mechanic_name.min' => 'The mechanic name must be at least 3 characters.',
                'mechanic_surname.min' => 'The mechanic surname must be at least 3 characters.'

            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $mechanic = new Mechanic;
        $mechanic->name = $request->mechanic_name;
        $mechanic->surname = $request->mechanic_surname;
        $mechanic->save();
        return redirect()->route('mechanic.index')->with('success_message', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function show(Mechanic $mechanic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function edit(Mechanic $mechanic)
    {
        return view('mechanic.edit', ['mechanic' => $mechanic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mechanic $mechanic)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'mechanic_name' => ['required', 'min:3', 'max:64'],
                'mechanic_surname' => ['required', 'min:3', 'max:64'],
            ],

            [
                'mechanic_name.required' => 'The mechanic name must be entered.',
                'mechanic_surname.min' => 'The mechanic surname must be at least 3 characters.',
                'mechanic_name.min' => 'The mechanic name must be at least 3 characters.',
                'mechanic_surname.min' => 'The mechanic surname must be at least 3 characters.'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $mechanic->name = $request->mechanic_name;
        $mechanic->surname = $request->mechanic_surname;
        $mechanic->save();
        return redirect()->route('mechanic.index')->with('success_message', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mechanic $mechanic)
    {
        if ($mechanic->mechanicTrucks->count()) {
            return redirect()->route('mechanic.index')->with('info_message', 'Cannot delete, mechanic still has cars.');
        }

        $mechanic->delete();
        return redirect()->route('mechanic.index')->with('success_message', 'Deleted successfully.');
    }
}
