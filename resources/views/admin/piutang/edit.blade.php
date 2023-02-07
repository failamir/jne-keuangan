@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.piutang.title_singular') }}:
                    {{ trans('cruds.piutang.fields.id') }}
                    {{ $piutang->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('piutang.edit', [$piutang])
        </div>
    </div>
</div>
@endsection