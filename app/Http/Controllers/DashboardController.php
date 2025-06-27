<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Total vehicles this week
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();
        $weekCount = Plate::whereBetween('entry_time', [$weekStart, $weekEnd])->count();

        // Total vehicles entered today
        $totalCount = Plate::whereDate('entry_time', $today)->count();

        // Vehicles exited today
        $vehiclesOut = Plate::whereDate('exit_time', $today)->count();

        // Currently in campus: any vehicle with no exit_time (regardless of entry date)
        $currentInCampus = Plate::whereNull('exit_time')->count();

        // Total flagged vehicles today
        $flaggedCount = Plate::whereDate('entry_time', $today)
                            ->where('flagged', true)
                            ->count();

        // Pie chart data (unchanged, still for "vehicles entered" per hour)
        $hourlyCounts = Plate::whereDate('entry_time', $today)
            ->select(DB::raw("DATE_FORMAT(entry_time, '%h:00%p') as hour"))
            ->groupBy('hour')
            ->orderBy('hour')
            ->selectRaw('count(*) as count')
            ->pluck('count', 'hour');

        // Entries and Exits for Bar/Area Charts
        $entries = Plate::whereDate('entry_time', $today)
            ->select(DB::raw("HOUR(entry_time) as hour"), DB::raw("COUNT(*) as count"))
            ->groupBy(DB::raw("HOUR(entry_time)"))
            ->orderBy(DB::raw("HOUR(entry_time)"))
            ->pluck('count', 'hour');

        $exits = Plate::whereDate('exit_time', $today)
            ->whereNotNull('exit_time')
            ->select(DB::raw("HOUR(exit_time) as hour"), DB::raw("COUNT(*) as count"))
            ->groupBy(DB::raw("HOUR(exit_time)"))
            ->orderBy(DB::raw("HOUR(exit_time)"))
            ->pluck('count', 'hour');

        $allHours = collect(range(0, 23));
        $labels = $allHours->map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ":00");
        $entriesData = $allHours->map(fn($h) => $entries->get($h, 0));
        $exitsData   = $allHours->map(fn($h) => $exits->get($h, 0));

        $barChartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Entries',
                    'data' => $entriesData,
                    'backgroundColor' => '#3FA7D6',
                ],
                [
                    'label' => 'Exits',
                    'data' => $exitsData,
                    'backgroundColor' => '#FF8C42',
                ]
            ]
        ];

        return view('dashboard', compact(
            'totalCount',
            'flaggedCount',
            'weekCount',
            'hourlyCounts',
            'barChartData',
            'currentInCampus',
            'vehiclesOut'
        ));
    }
}


