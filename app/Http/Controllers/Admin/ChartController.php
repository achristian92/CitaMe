<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function appointments()
    {

        $monthCounts = Appointment::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(1) as value')
        )
            ->groupBy('month')
            ->get()
            ->toArray();

        $counts = array_fill(0, 12, 0);
        foreach ($monthCounts as $monthCount) {
            $index = $monthCount['month'] - 1;
            $counts[$index] = $monthCount['value'];
        }
        return view('charts.appointments', compact('counts'));
    }
}
