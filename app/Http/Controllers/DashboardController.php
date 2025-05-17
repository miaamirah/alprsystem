<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plate;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCount = Plate::count();
        $flaggedCount = Plate::where('flagged', true)->count();

          // Count vehicles grouped by hour from entry_time
            $vehicleCounts = Plate::select(DB::raw("HOUR(entry_time) as hour"), DB::raw("COUNT(*) as count"))
                ->whereNotNull('entry_time')
                ->groupBy('hour')
                ->orderBy('hour')
                ->pluck('count', 'hour');

            // Build full range of hours and fill missing ones with 0
            $allHours = collect(range(0, 23)); // 0 to 23
            $labels = $allHours->map(fn($h) => str_pad($h, 2, '0', STR_PAD_LEFT) . ":00");
            $data = $allHours->map(fn($h) => $vehicleCounts->get($h, 0));

            $barChartData = [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Number of Vehicles',
                        'data' => $data,
                        'backgroundColor' => 'rgba(54, 162, 235, 0.7)'
                    ]
                ]
            ];
        // Group vehicle entries by hour (rounded to nearest hour/minute)
        $hourlyCounts = Plate::select(DB::raw("DATE_FORMAT(entry_time, '%h:%i%p') as hour"))
            ->groupBy('hour')
            ->orderBy('hour')
            ->selectRaw('count(*) as count')
            ->pluck('count', 'hour');

        return view('dashboard', compact('totalCount', 'flaggedCount', 'hourlyCounts','barChartData'));
    }

}