@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.setoran.title_singular') }}:
                    {{ trans('cruds.setoran.fields.id') }}
                    {{ $setoran->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.setoran.fields.id') }}
                            </th>
                            <td>
                                {{ $setoran->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.setoran.fields.jumlah_setoran') }}
                            </th>
                            <td>
                                {{ $setoran->jumlah_setoran }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.setoran.fields.tanggal_setoran') }}
                            </th>
                            <td>
                                {{ $setoran->tanggal_setoran }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.setoran.fields.metode_setoran') }}
                            </th>
                            <td>
                                {{ $setoran->metode_setoran_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.setoran.fields.status_setoran') }}
                            </th>
                            <td>
                                {{ $setoran->status_setoran_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.setoran.fields.catatan_setoran') }}
                            </th>
                            <td>
                                {{ $setoran->catatan_setoran }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.setoran.fields.piutang') }}
                            </th>
                            <td>
                                @if($setoran->piutang)
                                    <span class="badge badge-relationship">{{ $setoran->piutang->nama_debitur ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('setoran_edit')
                    <a href="{{ route('admin.setorans.edit', $setoran) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.setorans.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection