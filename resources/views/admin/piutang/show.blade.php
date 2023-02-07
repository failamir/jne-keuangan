@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.piutang.title_singular') }}:
                    {{ trans('cruds.piutang.fields.id') }}
                    {{ $piutang->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.piutang.fields.id') }}
                            </th>
                            <td>
                                {{ $piutang->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.piutang.fields.nama_debitur') }}
                            </th>
                            <td>
                                {{ $piutang->nama_debitur }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.piutang.fields.nomor_telepon') }}
                            </th>
                            <td>
                                {{ $piutang->nomor_telepon }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.piutang.fields.alamat_debitur') }}
                            </th>
                            <td>
                                {{ $piutang->alamat_debitur }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.piutang.fields.jumlah') }}
                            </th>
                            <td>
                                {{ $piutang->jumlah }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.piutang.fields.jatuh_tempo') }}
                            </th>
                            <td>
                                {{ $piutang->jatuh_tempo }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.piutang.fields.status_piutang') }}
                            </th>
                            <td>
                                {{ $piutang->status_piutang }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.piutang.fields.catatan_piutang') }}
                            </th>
                            <td>
                                {{ $piutang->catatan_piutang }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('piutang_edit')
                    <a href="{{ route('admin.piutangs.edit', $piutang) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.piutangs.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection