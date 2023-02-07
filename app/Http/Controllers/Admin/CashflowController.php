<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Cashflow;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CashflowController extends Controller
{
    use WithCSVImport;

    public function __construct()
    {
        $this->csvImportModel = Cashflow::class;
    }

    public function index()
    {
        abort_if(Gate::denies('cashflow_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cashflow.index');
    }

    public function create()
    {
        abort_if(Gate::denies('cashflow_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cashflow.create');
    }

    public function edit(Cashflow $cashflow)
    {
        abort_if(Gate::denies('cashflow_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cashflow.edit', compact('cashflow'));
    }

    public function show(Cashflow $cashflow)
    {
        abort_if(Gate::denies('cashflow_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cashflow.show', compact('cashflow'));
    }
}
