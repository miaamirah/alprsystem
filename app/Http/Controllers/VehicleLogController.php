<?php

namespace App\Http\Controllers;

use App\Models\VehicleLog;
use App\Models\Plate;
use Illuminate\Http\Request;

class VehicleLogController extends Controller
{
    public function index(Request $request)
    {
        
        $logs = VehicleLog::with(['plate', 'user']);

        // 1. Search by plate number if search term provided
        if ($request->has('search') && $request->search) {
            $logs->whereHas('plate', function($q) use ($request) {
                $q->where('plate_text', 'like', '%' . $request->search . '%');
            });
        }

        // 2. Filter by period (yesterday, 7days, month, year, all time)
        if ($request->has('period') && $request->period) {
            if ($request->period === 'yesterday') {
                // Only logs from yesterday
                $logs->whereDate('created_at', now()->subDay()->toDateString());
            } elseif ($request->period === '7days') {
                // Logs from last 7 days (including today)
                $logs->where('created_at', '>=', now()->subDays(7)->startOfDay());
            } elseif ($request->period === 'month') {
                // Logs for current month
                $logs->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            } elseif ($request->period === 'year') {
                // Logs for current year
                $logs->whereYear('created_at', now()->year);
            }
            // If period is empty or not recognized, show all logs (no filter)
        }

        // 3. Order logs, get the result
        $logs = $logs->orderBy('created_at', 'desc')->get();

        // 4. Return view with filtered logs
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
