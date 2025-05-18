<?php

namespace App\Http\Controllers;

use App\Models\VehicleLog;
use App\Models\Plate;
use Illuminate\Http\Request;

class VehicleLogController extends Controller
{
    public function index()
    {
        $logs = VehicleLog::with(['plate', 'user'])->orderBy('created_at', 'desc')->get();
    return view('vehicle_logs.index', compact('logs'));
    }

    public function create()
    {
        $plates = Plate::all();
        return view('vehicle_logs.create', compact('plates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate_id' => 'required|exists:plates,id',
            'action' => 'required|string',
            'message' => 'nullable|string',
        ]);

        VehicleLog::create([
            'plate_id' => $request->plate_id,
            'action' => $request->action,
            'message' => $request->message,
        ]);

        return redirect()->route('vehicle_logs.index')->with('success', 'Log created.');
    }

    public function destroy(VehicleLog $vehicleLog)
    {
        $vehicleLog->delete();
        return back()->with('success', 'Log deleted.');
    }
    public function show($id)
    {
        $log = VehicleLog::with(['plate', 'user'])->findOrFail($id);
        return view('vehicle_logs.show', compact('log'));
    }

}
