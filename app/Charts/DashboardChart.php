<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Event;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class DashboardChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $event = Event::all()->count();
        return Chartisan::build()
            ->labels(['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])
            ->dataset('Event created', [0, 0, 2, 7, 9, 8, 2, 1, 0, 0, 0, 0])
            ->dataset('Active Users ', [0, 1, 1, 2, 5, 8, 3, 2, 3, 1, 8, 10]);
    }
}