<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCashflowRequest;
use App\Http\Requests\UpdateCashflowRequest;
use App\Http\Resources\Admin\CashflowResource;
use App\Models\Cashflow;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CashflowApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cashflow_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CashflowResource(Cashflow::all());
    }

    public function store(StoreCashflowRequest $request)
    {
        $cashflow = Cashflow::create($request->validated());

        return (new CashflowResource($cashflow))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Cashflow $cashflow)
    {
        abort_if(Gate::denies('cashflow_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CashflowResource($cashflow);
    }

    public function update(UpdateCashflowRequest $request, Cashflow $cashflow)
    {
        $cashflow->update($request->validated());

        return (new CashflowResource($cashflow))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Cashflow $cashflow)
    {
        abort_if(Gate::denies('cashflow_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashflow->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
