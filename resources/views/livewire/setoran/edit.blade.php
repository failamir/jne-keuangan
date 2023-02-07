<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('setoran.jumlah_setoran') ? 'invalid' : '' }}">
        <label class="form-label" for="jumlah_setoran">{{ trans('cruds.setoran.fields.jumlah_setoran') }}</label>
        <input class="form-control" type="number" name="jumlah_setoran" id="jumlah_setoran" wire:model.defer="setoran.jumlah_setoran" step="0.01">
        <div class="validation-message">
            {{ $errors->first('setoran.jumlah_setoran') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setoran.fields.jumlah_setoran_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setoran.tanggal_setoran') ? 'invalid' : '' }}">
        <label class="form-label" for="tanggal_setoran">{{ trans('cruds.setoran.fields.tanggal_setoran') }}</label>
        <x-date-picker class="form-control" wire:model="setoran.tanggal_setoran" id="tanggal_setoran" name="tanggal_setoran" picker="date" />
        <div class="validation-message">
            {{ $errors->first('setoran.tanggal_setoran') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setoran.fields.tanggal_setoran_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setoran.metode_setoran') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.setoran.fields.metode_setoran') }}</label>
        <select class="form-control" wire:model="setoran.metode_setoran">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['metode_setoran'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('setoran.metode_setoran') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setoran.fields.metode_setoran_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setoran.status_setoran') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.setoran.fields.status_setoran') }}</label>
        <select class="form-control" wire:model="setoran.status_setoran">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['status_setoran'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('setoran.status_setoran') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setoran.fields.status_setoran_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setoran.catatan_setoran') ? 'invalid' : '' }}">
        <label class="form-label" for="catatan_setoran">{{ trans('cruds.setoran.fields.catatan_setoran') }}</label>
        <textarea class="form-control" name="catatan_setoran" id="catatan_setoran" wire:model.defer="setoran.catatan_setoran" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('setoran.catatan_setoran') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setoran.fields.catatan_setoran_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setoran.piutang_id') ? 'invalid' : '' }}">
        <label class="form-label" for="piutang">{{ trans('cruds.setoran.fields.piutang') }}</label>
        <x-select-list class="form-control" id="piutang" name="piutang" :options="$this->listsForFields['piutang']" wire:model="setoran.piutang_id" />
        <div class="validation-message">
            {{ $errors->first('setoran.piutang_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setoran.fields.piutang_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.setorans.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>