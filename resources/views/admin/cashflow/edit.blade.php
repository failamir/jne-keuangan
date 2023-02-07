@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.cashflow.title_singular') }}:
                    {{ trans('cruds.cashflow.fields.id') }}
                    {{ $cashflow->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('cashflow.edit', [$cashflow])
        </div>
    </div>
</div>
@endsection