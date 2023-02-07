<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePoutingRequest;
use App\Http\Requests\UpdatePoutingRequest;
use App\Http\Resources\Admin\PoutingResource;
use App\Models\Pouting;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PoutingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pouting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PoutingResource(Pouting::with(['user'])->advancedFilter());
    }

    public function store(StorePoutingRequest $request)
    {
        $pouting = Pouting::create($request->validated());

        return (new PoutingResource($pouting))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create()
    {
        abort_if(Gate::denies('pouting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [
                'user' => User::get(['id', 'name']),
            ],
        ]);
    }

    public function show(Pouting $pouting)
    {
        abort_if(Gate::denies('pouting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PoutingResource($pouting->load(['user']));
    }

    public function update(UpdatePoutingRequest $request, Pouting $pouting)
    {
        $pouting->update($request->validated());

        return (new PoutingResource($pouting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(Pouting $pouting)
    {
        abort_if(Gate::denies('pouting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new PoutingResource($pouting->load(['user'])),
            'meta' => [
                'user' => User::get(['id', 'name']),
            ],
        ]);
    }

    public function destroy(Pouting $pouting)
    {
        abort_if(Gate::denies('pouting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pouting->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
