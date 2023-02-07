<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('piutang_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Piutang" format="csv" />
                <livewire:excel-export model="Piutang" format="xlsx" />
                <livewire:excel-export model="Piutang" format="pdf" />
            @endif


            @can('piutang_create')
                <x-csv-import route="{{ route('admin.piutangs.csv.store') }}" />
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
                            {{ trans('cruds.piutang.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.piutang.fields.nama_debitur') }}
                            @include('components.table.sort', ['field' => 'nama_debitur'])
                        </th>
                        <th>
                            {{ trans('cruds.piutang.fields.nomor_telepon') }}
                            @include('components.table.sort', ['field' => 'nomor_telepon'])
                        </th>
                        <th>
                            {{ trans('cruds.piutang.fields.alamat_debitur') }}
                            @include('components.table.sort', ['field' => 'alamat_debitur'])
                        </th>
                        <th>
                            {{ trans('cruds.piutang.fields.jumlah') }}
                            @include('components.table.sort', ['field' => 'jumlah'])
                        </th>
                        <th>
                            {{ trans('cruds.piutang.fields.jatuh_tempo') }}
                            @include('components.table.sort', ['field' => 'jatuh_tempo'])
                        </th>
                        <th>
                            {{ trans('cruds.piutang.fields.status_piutang') }}
                            @include('components.table.sort', ['field' => 'status_piutang'])
                        </th>
                        <th>
                            {{ trans('cruds.piutang.fields.catatan_piutang') }}
                            @include('components.table.sort', ['field' => 'catatan_piutang'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($piutangs as $piutang)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $piutang->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $piutang->id }}
                            </td>
                            <td>
                                {{ $piutang->nama_debitur }}
                            </td>
                            <td>
                                {{ $piutang->nomor_telepon }}
                            </td>
                            <td>
                                {{ $piutang->alamat_debitur }}
                            </td>
                            <td>
                                {{ $piutang->jumlah }}
                            </td>
                            <td>
                                {{ $piutang->jatuh_tempo }}
                            </td>
                            <td>
                                {{ $piutang->status_piutang }}
                            </td>
                            <td>
                                {{ $piutang->catatan_piutang }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('piutang_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.piutangs.show', $piutang) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('piutang_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.piutangs.edit', $piutang) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('piutang_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $piutang->id }})" wire:loading.attr="disabled">
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
            {{ $piutangs->links() }}
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