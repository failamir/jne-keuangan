@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.setoran.title_singular') }}:
                    {{ trans('cruds.setoran.fields.id') }}
                    {{ $setoran->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('setoran.edit', [$setoran])
        </div>
    </div>
</div>
@endsection