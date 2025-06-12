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

        // Pie and bar/area chart data (as before)
        $hourlyCounts = Plate::whereDate('entry_time', $today)
            ->select(DB::raw("DATE_FORMAT(entry_time, '%h:00%p') as hour"))
            ->groupBy('hour')
            ->orderBy('hour')
            ->selectRaw('count(*) as count')
            ->pluck('count', 'hour');

        $vehicleCounts = Plate::whereDate('entry_time', $today)
            ->select(DB::raw("HOUR(entry_time) as hour"), DB::raw("COUNT(*) as count"))
            ->groupBy('hour')
            ->orderBy('hour')
            ->pluck('count', 'hour');

        $allHours = collect(range(0, 23));
        $labels = $allHours->map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ":00");
        $data = $allHours->map(fn($h) => $vehicleCounts->get($h, 0));

        $barChartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Number of Vehicles',
                    'data' => $data,
                    'backgroundColor' => 'rgb(254, 163, 176)',
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
