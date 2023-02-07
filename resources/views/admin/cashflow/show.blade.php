@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.cashflow.title_singular') }}:
                    {{ trans('cruds.cashflow.fields.id') }}
                    {{ $cashflow->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.cashflow.fields.id') }}
                            </th>
                            <td>
                                {{ $cashflow->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.cashflow.fields.kategori_cashflow') }}
                            </th>
                            <td>
                                {{ $cashflow->kategori_cashflow_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.cashflow.fields.deskripsi') }}
                            </th>
                            <td>
                                {{ $cashflow->deskripsi }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.cashflow.fields.jumlah') }}
                            </th>
                            <td>
                                {{ $cashflow->jumlah }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.cashflow.fields.tanggal') }}
                            </th>
                            <td>
                                {{ $cashflow->tanggal }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.cashflow.fields.sumber') }}
                            </th>
                            <td>
                                {{ $cashflow->sumber_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.cashflow.fields.status') }}
                            </th>
                            <td>
                                {{ $cashflow->status_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.cashflow.fields.catatan') }}
                            </th>
                            <td>
                                {{ $cashflow->catatan }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('cashflow_edit')
                    <a href="{{ route('admin.cashflows.edit', $cashflow) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.cashflows.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection