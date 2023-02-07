<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Setoran;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SetoranController extends Controller
{
    use WithCSVImport;

    public function __construct()
    {
        $this->csvImportModel = Setoran::class;
    }

    public function index()
    {
        abort_if(Gate::denies('setoran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.setoran.index');
    }

    public function create()
    {
        abort_if(Gate::denies('setoran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.setoran.create');
    }

    public function edit(Setoran $setoran)
    {
        abort_if(Gate::denies('setoran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.setoran.edit', compact('setoran'));
    }

    public function show(Setoran $setoran)
    {
        abort_if(Gate::denies('setoran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setoran->load('piutang');

        return view('admin.setoran.show', compact('setoran'));
    }
}
