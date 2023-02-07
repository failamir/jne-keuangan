<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSetoranRequest;
use App\Http\Requests\UpdateSetoranRequest;
use App\Http\Resources\Admin\SetoranResource;
use App\Models\Pouting;
use App\Models\Setoran;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SetoranApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('setoran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SetoranResource(Setoran::with(['user', 'piutang'])->advancedFilter());
    }

    public function store(StoreSetoranRequest $request)
    {
        $setoran = Setoran::create($request->validated());

        return (new SetoranResource($setoran))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create()
    {
        abort_if(Gate::denies('setoran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [
                'user'           => User::get(['id', 'name']),
                'piutang'        => Pouting::get(['id', 'nama_debitur']),
                'metode_setoran' => Setoran::METODE_SETORAN_SELECT,
                'status_setoran' => Setoran::STATUS_SETORAN_SELECT,
            ],
        ]);
    }

    public function show(Setoran $setoran)
    {
        abort_if(Gate::denies('setoran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SetoranResource($setoran->load(['user', 'piutang']));
    }

    public function update(UpdateSetoranRequest $request, Setoran $setoran)
    {
        $setoran->update($request->validated());

        return (new SetoranResource($setoran))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(Setoran $setoran)
    {
        abort_if(Gate::denies('setoran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new SetoranResource($setoran->load(['user', 'piutang'])),
            'meta' => [
                'user'           => User::get(['id', 'name']),
                'piutang'        => Pouting::get(['id', 'nama_debitur']),
                'metode_setoran' => Setoran::METODE_SETORAN_SELECT,
                'status_setoran' => Setoran::STATUS_SETORAN_SELECT,
            ],
        ]);
    }

    public function destroy(Setoran $setoran)
    {
        abort_if(Gate::denies('setoran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setoran->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
