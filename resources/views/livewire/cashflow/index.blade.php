<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('cashflow_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Cashflow" format="csv" />
                <livewire:excel-export model="Cashflow" format="xlsx" />
                <livewire:excel-export model="Cashflow" format="pdf" />
            @endif


            @can('cashflow_create')
                <x-csv-import route="{{ route('admin.cashflows.csv.store') }}" />
            @endcan

        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.cashflow.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.cashflow.fields.kategori_cashflow') }}
                            @include('components.table.sort', ['field' => 'kategori_cashflow'])
                        </th>
                        <th>
                            {{ trans('cruds.cashflow.fields.deskripsi') }}
                            @include('components.table.sort', ['field' => 'deskripsi'])
                        </th>
                        <th>
                            {{ trans('cruds.cashflow.fields.jumlah') }}
                            @include('components.table.sort', ['field' => 'jumlah'])
                        </th>
                        <th>
                            {{ trans('cruds.cashflow.fields.tanggal') }}
                            @include('components.table.sort', ['field' => 'tanggal'])
                        </th>
                        <th>
                            {{ trans('cruds.cashflow.fields.sumber') }}
                            @include('components.table.sort', ['field' => 'sumber'])
                        </th>
                        <th>
                            {{ trans('cruds.cashflow.fields.status') }}
                            @include('components.table.sort', ['field' => 'status'])
                        </th>
                        <th>
                            {{ trans('cruds.cashflow.fields.catatan') }}
                            @include('components.table.sort', ['field' => 'catatan'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cashflows as $cashflow)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $cashflow->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $cashflow->id }}
                            </td>
                            <td>
                                {{ $cashflow->kategori_cashflow_label }}
                            </td>
                            <td>
                                {{ $cashflow->deskripsi }}
                            </td>
                            <td>
                                {{ $cashflow->jumlah }}
                            </td>
                            <td>
                                {{ $cashflow->tanggal }}
                            </td>
                            <td>
                                {{ $cashflow->sumber_label }}
                            </td>
                            <td>
                                {{ $cashflow->status_label }}
                            </td>
                            <td>
                                {{ $cashflow->catatan }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('cashflow_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.cashflows.show', $cashflow) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('cashflow_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.cashflows.edit', $cashflow) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('cashflow_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $cashflow->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $cashflows->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush