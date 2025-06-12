<?php

namespace App\Http\Controllers;

use App\Models\RegisteredVehicle;
use Illuminate\Http\Request;

class RegisteredVehicleController extends Controller
{
    public function index()
    {
        $vehicles = RegisteredVehicle::all();
        return view('registered_vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('registered_vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'owner_name'    => 'required|string|max:255',
            'student_id'    => 'required|string|max:50',
            'plate_text'    => 'required|string|unique:registered_vehicles',
            'vehicle_type'  => 'required|string|max:100',
            'brand'         => 'required|string|max:100',
            'color'         => 'required|string|max:100',
        ]);

        RegisteredVehicle::create($request->all());

        return redirect()->route('registered_vehicles.index')->with('success', 'Vehicle registered successfully.');
    }

    public function show(RegisteredVehicle $registered_vehicle)
    {
        return view('registered_vehicles.show', compact('registered_vehicle'));
    }

    public function edit(RegisteredVehicle $registered_vehicle)
    {
        return view('registered_vehicles.edit', compact('registered_vehicle'));
    }

    public function update(Request $request, RegisteredVehicle $registered_vehicle)
    {
        $request->validate([
            'owner_name'    => 'required|string|max:255',
            'student_id'    => 'required|string|max:50',
            'plate_text'    => 'required|string|unique:registered_vehicles,plate_text,' . $registered_vehicle->id,
            'vehicle_type'  => 'required|string|max:100',
            'brand'         => 'required|string|max:100',
            'color'         => 'required|string|max:100',
        ]);
        // Track original values
        $hasChanges = 
        $registered_vehicle->owner_name !== $request->owner_name ||
        $registered_vehicle->student_id !== $request->student_id ||
        $registered_vehicle->plate_text !== $request->plate_text ||
        $registered_vehicle->vehicle_type !== $request->vehicle_type ||
        $registered_vehicle->brand !== $request->brand ||
        $registered_vehicle->color !== $request->color;

    if ($hasChanges) {
        $registered_vehicle->update($request->all());
        return redirect()->route('registered_vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

        return redirect()->route('registered_vehicles.index')->with('info', 'No changes were made.');
    }

    public function destroy(RegisteredVehicle $registered_vehicle)
    {
        $registered_vehicle->delete();

        return redirect()->route('registered_vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}
