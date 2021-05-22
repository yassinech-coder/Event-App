<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\Event;
use App\Models\User;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $event = Event::all();

        $data = array_replace(array_fill_keys(range(0, 11), 0), $event->groupBy('created_at.month')
            ->map(function ($event) {
                return count($event);
            })->toArray());
        array_shift($data);
        $user = User::all();

        $data2 = array_replace(array_fill_keys(range(0, 11), 0), $user->groupBy('created_at.month')
            ->map(function ($user) {
                return count($user);
            })->toArray());
        array_shift($data2);
        return Chartisan::build()
            ->labels(['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'])
            ->dataset('Event created', $data)
            ->dataset('Active Users ', $data2 );
    }
}
