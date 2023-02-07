<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Piutang;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PiutangController extends Controller
{
    use WithCSVImport;

    public function __construct()
    {
        $this->csvImportModel = Piutang::class;
    }

    public function index()
    {
        abort_if(Gate::denies('piutang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.piutang.index');
    }

    public function create()
    {
        abort_if(Gate::denies('piutang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.piutang.create');
    }

    public function edit(Piutang $piutang)
    {
        abort_if(Gate::denies('piutang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.piutang.edit', compact('piutang'));
    }

    public function show(Piutang $piutang)
    {
        abort_if(Gate::denies('piutang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.piutang.show', compact('piutang'));
    }
}
