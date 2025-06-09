<?php

namespace App\Http\Controllers;

use App\Models\Plate;
use App\Models\VehicleLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlateController extends Controller
{
    /**
     * Display a list of plates (with search, flag, and period filters).
     */
    public function index(Request $request)
    {
        $plates = Plate::query();

        // Search filter
        if ($request->has('search')) {
            $plates->where('plate_text', 'like', '%' . $request->search . '%');
        }

        // Flag filter
        if ($request->has('flag')) {
            if ($request->flag === 'yes') {
                $plates->where('flagged', 1);
            } elseif ($request->flag === 'no') {
                $plates->where('flagged', 0);
            }
        }

        // Period filter (applies regardless of flag)
        if ($request->has('period') && $request->period) {
            if ($request->period === 'yesterday') {
                $plates->whereDate('entry_time', now()->subDay()->toDateString());
            } elseif ($request->period === '7days') {
                $plates->where('entry_time', '>=', now()->subDays(7)->startOfDay());
            } elseif ($request->period === 'month') {
                $plates->whereMonth('entry_time', now()->month)
                    ->whereYear('entry_time', now()->year);
            } elseif ($request->period === 'year') {
                $plates->whereYear('entry_time', now()->year);
            }
        }

        $plates = $plates->orderBy('entry_time', 'desc')->get();

        return view('plates.index', compact('plates'));
    }

    /**
     * Show the form to edit a plate.
     */
    public function edit(Plate $plate)
    {
        return view('plates.edit', compact('plate'));
    }

    /**
     * Update the flagged status and reason of a plate,
     * and log the change if there's any.
     */
    public function update(Request $request, Plate $plate)
    {
        $request->validate([
            'flagged' => 'required|boolean',
            'reason' => 'nullable|string|max:255',
        ]);

        $oldFlag = $plate->flagged;
        $oldReason = $plate->reason;

        // Update the plate
        $plate->update([
            'flagged' => $request->flagged,
            'reason' => $request->reason,
        ]);

        // Log change only if something changed
        if ($oldFlag != $request->flagged || $oldReason != $request->reason) {
            VehicleLog::create([
                'plate_id' => $plate->id,
                'action' => 'updated',
                'message' => "Flag: $oldFlag → {$request->flagged}, Reason: '{$oldReason}' → '{$request->reason}'",
                'user_id' => Auth::id(), // To track user who made the change
            ]);
        }

        return redirect()->route('plates.index')->with('success', 'Plate updated and logged.');
    }

    /**
     * Show a single plate record.
     */
    public function show(Plate $plate)
    {
        return view('plates.show', compact('plate'));
    }

    /**
     * Delete a plate (optional).
     */
    public function destroy(Plate $plate)
    {
        $plate->delete();

        return redirect()->route('plates.index')->with('success', 'Plate deleted.');
    }
}
