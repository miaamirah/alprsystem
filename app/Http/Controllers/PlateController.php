<?php

namespace App\Http\Controllers;

use App\Models\Plate;
use Illuminate\Http\Request;

class PlateController extends Controller
{
    /**
     * Show all plates (Vehicle Log View) in desc order the oldest go last
   
    *public function index()
    *{
     *   $plates = Plate::orderBy('entry_time', 'desc')->get();
     *   return view('plates.index', compact('plates'));
    *}*/
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
     * Show the edit form for a plate
     */
    public function edit(Plate $plate)
    {
        return view('plates.edit', compact('plate'));
    }

    /**
     * Update the flagged status and reason
     */
    public function update(Request $request, Plate $plate)
    {
        $request->validate([
            'flagged' => 'required|boolean',
            'reason' => 'nullable|string|max:255',
        ]);

        $plate->update([
            'flagged' => $request->flagged,
            'reason' => $request->reason,
        ]);

        return redirect()->route('plates.index')->with('success', 'Plate updated successfully.');
    }

    /**
     * (Optional) Delete a plate
     */
    public function destroy(Plate $plate)
    {
        $plate->delete();
        return redirect()->route('plates.index')->with('success', 'Plate deleted.');
    }
}
