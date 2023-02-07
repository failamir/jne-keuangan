<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('setoran_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Setoran" format="csv" />
                <livewire:excel-export model="Setoran" format="xlsx" />
                <livewire:excel-export model="Setoran" format="pdf" />
            @endif


            @can('setoran_create')
                <x-csv-import route="{{ route('admin.setorans.csv.store') }}" />
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
                            {{ trans('cruds.setoran.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.setoran.fields.jumlah_setoran') }}
                            @include('components.table.sort', ['field' => 'jumlah_setoran'])
                        </th>
                        <th>
                            {{ trans('cruds.setoran.fields.tanggal_setoran') }}
                            @include('components.table.sort', ['field' => 'tanggal_setoran'])
                        </th>
                        <th>
                            {{ trans('cruds.setoran.fields.metode_setoran') }}
                            @include('components.table.sort', ['field' => 'metode_setoran'])
                        </th>
                        <th>
                            {{ trans('cruds.setoran.fields.status_setoran') }}
                            @include('components.table.sort', ['field' => 'status_setoran'])
                        </th>
                        <th>
                            {{ trans('cruds.setoran.fields.catatan_setoran') }}
                            @include('components.table.sort', ['field' => 'catatan_setoran'])
                        </th>
                        <th>
                            {{ trans('cruds.setoran.fields.piutang') }}
                            @include('components.table.sort', ['field' => 'piutang.nama_debitur'])
                        </th>
                        <th>
                            {{ trans('cruds.piutang.fields.jumlah') }}
                            @include('components.table.sort', ['field' => 'piutang.jumlah'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($setorans as $setoran)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $setoran->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $setoran->id }}
                            </td>
                            <td>
                                {{ $setoran->jumlah_setoran }}
                            </td>
                            <td>
                                {{ $setoran->tanggal_setoran }}
                            </td>
                            <td>
                                {{ $setoran->metode_setoran_label }}
                            </td>
                            <td>
                                {{ $setoran->status_setoran_label }}
                            </td>
                            <td>
                                {{ $setoran->catatan_setoran }}
                            </td>
                            <td>
                                @if($setoran->piutang)
                                    <span class="badge badge-relationship">{{ $setoran->piutang->nama_debitur ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($setoran->piutang)
                                    {{ $setoran->piutang->jumlah ?? '' }}
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('setoran_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.setorans.show', $setoran) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('setoran_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.setorans.edit', $setoran) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('setoran_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $setoran->id }})" wire:loading.attr="disabled">
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
            {{ $setorans->links() }}
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