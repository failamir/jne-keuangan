<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePiutangRequest;
use App\Http\Requests\UpdatePiutangRequest;
use App\Http\Resources\Admin\PiutangResource;
use App\Models\Piutang;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PiutangApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('piutang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PiutangResource(Piutang::all());
    }

    public function store(StorePiutangRequest $request)
    {
        $piutang = Piutang::create($request->validated());

        return (new PiutangResource($piutang))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Piutang $piutang)
    {
        abort_if(Gate::denies('piutang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PiutangResource($piutang);
    }

    public function update(UpdatePiutangRequest $request, Piutang $piutang)
    {
        $piutang->update($request->validated());

        return (new PiutangResource($piutang))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Piutang $piutang)
    {
        abort_if(Gate::denies('piutang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $piutang->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
