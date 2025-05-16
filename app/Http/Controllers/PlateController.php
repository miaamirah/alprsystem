<?php

namespace App\Http\Controllers;

use App\Models\Plate;
use App\Models\VehicleLog;
use Illuminate\Http\Request;

class PlateController extends Controller
{
    /**
     * Display a list of plates (with search).
     */
    public function index(Request $request)
    {
        $plates = Plate::query();

        if ($request->has('search')) {
            $plates->where('plate_text', 'like', '%' . $request->search . '%');
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
                'user_id' => auth()->id(), // Optional: enable if tracking user who made the change
            ]);
        }

        return redirect()->route('plates.index')->with('success', 'Plate updated and logged.');
    }


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
