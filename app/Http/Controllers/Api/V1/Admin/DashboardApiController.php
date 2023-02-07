<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Services\ChartsService;

class DashboardApiController extends Controller
{
    public function index()
    {
        $line0 = new ChartsService([
            'title'              => 'Cashflow Report',
            'chart_type'         => 'line',
            'model'              => 'App\Models\Cashflow',
            'group_by_field'     => 'created_at',
            'group_by_period'    => 'day',
            'column_class'       => 'col-md-4',
            'aggregate_function' => 'sum',
            'aggregate_field'    => 'jumlah',
            'filter_by_field'    => 'created_at',
            'filter_by_period'   => 7,
        ]);

        $line1 = new ChartsService([
            'title'              => 'Piutang',
            'chart_type'         => 'line',
            'model'              => 'App\Models\Pouting',
            'group_by_field'     => 'created_at',
            'group_by_period'    => 'day',
            'column_class'       => 'col-md-4',
            'aggregate_function' => 'sum',
            'aggregate_field'    => 'jumlah',
            'filter_by_field'    => 'created_at',
            'filter_by_period'   => 7,
        ]);

        $line2 = new ChartsService([
            'title'              => 'Setoran',
            'chart_type'         => 'line',
            'model'              => 'App\Models\Setoran',
            'group_by_field'     => 'created_at',
            'group_by_period'    => 'day',
            'column_class'       => 'col-md-4',
            'aggregate_function' => 'sum',
            'aggregate_field'    => 'jumlah_setoran',
            'filter_by_field'    => 'created_at',
            'filter_by_period'   => 7,
        ]);

        return response()->json(compact('line0', 'line1', 'line2'));
    }
}
