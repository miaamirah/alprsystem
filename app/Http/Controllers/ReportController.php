<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Plate;
use App\Models\VehicleLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
         $reports = Report::orderBy('id', 'asc')->get();
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->endOfDay();
        $today = Carbon::today();

        $totalRange = Plate::whereBetween('entry_time', [$start, $end])->count();
        $flaggedRange = Plate::whereBetween('entry_time', [$start, $end])->where('flagged', true)->count();
        $totalToday = Plate::whereDate('entry_time', $today)->count();
        $flaggedToday = Plate::whereDate('entry_time', $today)->where('flagged', true)->count();

        $report = Report::create([
            'start_date' => $start,
            'end_date' => $end,
            'generated_by' => 1,
            'total_vehicles_range' => $totalRange,
            'flagged_vehicles_range' => $flaggedRange,
            'total_vehicles_today' => $totalToday,
            'flagged_vehicles_today' => $flaggedToday,
        ]);

        return redirect()->route('reports.show', $report->id)->with('success', 'Report created successfully.');
    }

    public function show(Report $report)
    {
        $start = Carbon::parse($report->start_date)->startOfDay();
        $end = Carbon::parse($report->end_date)->endOfDay();

        $logCount = VehicleLog::whereBetween('created_at', [$start, $end])->count();

        // Group by raw SQL HOUR function to avoid duplicate bars
        $vehicleCounts = Plate::whereBetween('entry_time', [$start, $end])
            ->select(DB::raw("HOUR(entry_time) as hour"), DB::raw("COUNT(*) as count"))
            ->groupBy(DB::raw("HOUR(entry_time)"))
            ->orderBy(DB::raw("HOUR(entry_time)"))
            ->pluck('count', 'hour');

        $allHours = collect(range(0, 23));
        $labels = $allHours->map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ":00");
        $data = $allHours->map(fn($h) => $vehicleCounts->get($h, 0));

        $barChartData = [
            'labels' => $labels,
            'datasets' => [[
                'label' => 'Number of Vehicles',
                'data' => $data,
                'backgroundColor' => '#A3C4F3',
            ]]
        ];

        // Pie chart for flagged vs non-flagged vehicles
        $totalCars = Plate::whereBetween('entry_time', [$start, $end])->count();
        $flaggedCars = Plate::whereBetween('entry_time', [$start, $end])->where('flagged', true)->count();
        $nonFlaggedCars = $totalCars - $flaggedCars;

        $pieChartData = [
            'labels' => ['Non-Flagged Vehicles', 'Flagged Vehicles'],
            'data' => [$nonFlaggedCars, $flaggedCars],
            'colors' => ['#4CAF50', '#F44336']
        ];

        $areaChartData = $barChartData;

        return view('reports.show', compact(
            'report',
            'logCount',
            'barChartData',
            'pieChartData',
            'areaChartData'
        ));
    }
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }


}
