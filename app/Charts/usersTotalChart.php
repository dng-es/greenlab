<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Highcharts\Chart;
use Illuminate\Support\Facades\DB;

class usersTotalChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $total_data = [];
        $labels = [];
        for ($i = 0; $i < date('m'); $i++){     
            $users = DB::table("users")->select(DB::raw("(COUNT(*)) as total_users"))
            ->wheremonth('created_at', '<=', ($i + 1))
            ->whereyear('created_at', '<=', date('Y'))
            ->first();
            
            array_push($total_data, $users->total_users);
            array_push($labels, date("F", mktime(0, 0, 0, ($i + 1), 1)));
        }

        $this->dataset('Alta de usuarios', 'bar', $total_data)
        ->options(['backgroundColor' => ['#3097D1', '#8eb4cb', '#4FBF87', '#cbb956', '#bf5329']]);
        $this->labels($labels)
        ->options(['legend' => ['display' => true]]);
    }
}