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
    $start = \Carbon\Carbon::parse($report->start_date)->startOfDay();
    $end = \Carbon\Carbon::parse($report->end_date)->endOfDay();

    $logCount = \App\Models\VehicleLog::whereBetween('created_at', [$start, $end])->count();

    // Entries per hour
    $entries = \App\Models\Plate::whereBetween('entry_time', [$start, $end])
        ->select(DB::raw("HOUR(entry_time) as hour"), DB::raw("COUNT(*) as count"))
        ->groupBy(DB::raw("HOUR(entry_time)"))
        ->orderBy(DB::raw("HOUR(entry_time)"))
        ->pluck('count', 'hour');

    // Exits per hour
    $exits = \App\Models\Plate::whereBetween('exit_time', [$start, $end])
        ->whereNotNull('exit_time')
        ->select(DB::raw("HOUR(exit_time) as hour"), DB::raw("COUNT(*) as count"))
        ->groupBy(DB::raw("HOUR(exit_time)"))
        ->orderBy(DB::raw("HOUR(exit_time)"))
        ->pluck('count', 'hour');

    $allHours = collect(range(0, 23));
    $labels = $allHours->map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ":00");
    $entriesData = $allHours->map(fn($h) => $entries->get($h, 0));
    $exitsData = $allHours->map(fn($h) => $exits->get($h, 0));

    $barChartData = [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => 'Entries',
                'data' => $entriesData,
                'backgroundColor' => '#3FA7D6', // Blue
            ],
            [
                'label' => 'Exits',
                'data' => $exitsData,
                'backgroundColor' => '#FF8C42', // Orange
            ]
        ]
    ];

    // Pie chart for flagged vs non-flagged vehicles
    $totalCars = \App\Models\Plate::whereBetween('entry_time', [$start, $end])->count();
    $flaggedCars = \App\Models\Plate::whereBetween('entry_time', [$start, $end])->where('flagged', true)->count();
    $nonFlaggedCars = $totalCars - $flaggedCars;

    $pieChartData = [
        'labels' => ['Non-Flagged Vehicles', 'Flagged Vehicles'],
        'data' => [$nonFlaggedCars, $flaggedCars],
        'colors' => ['#4CAF50', '#F44336']
    ];

    $areaChartData = $barChartData; // You can change this if you want different data

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
