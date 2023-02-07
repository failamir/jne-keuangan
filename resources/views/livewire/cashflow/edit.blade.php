<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('cashflow.kategori_cashflow') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.cashflow.fields.kategori_cashflow') }}</label>
        <select class="form-control" wire:model="cashflow.kategori_cashflow">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['kategori_cashflow'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('cashflow.kategori_cashflow') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.cashflow.fields.kategori_cashflow_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('cashflow.deskripsi') ? 'invalid' : '' }}">
        <label class="form-label" for="deskripsi">{{ trans('cruds.cashflow.fields.deskripsi') }}</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" wire:model.defer="cashflow.deskripsi" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('cashflow.deskripsi') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.cashflow.fields.deskripsi_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('cashflow.jumlah') ? 'invalid' : '' }}">
        <label class="form-label" for="jumlah">{{ trans('cruds.cashflow.fields.jumlah') }}</label>
        <input class="form-control" type="number" name="jumlah" id="jumlah" wire:model.defer="cashflow.jumlah" step="0.01">
        <div class="validation-message">
            {{ $errors->first('cashflow.jumlah') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.cashflow.fields.jumlah_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('cashflow.tanggal') ? 'invalid' : '' }}">
        <label class="form-label" for="tanggal">{{ trans('cruds.cashflow.fields.tanggal') }}</label>
        <x-date-picker class="form-control" wire:model="cashflow.tanggal" id="tanggal" name="tanggal" picker="date" />
        <div class="validation-message">
            {{ $errors->first('cashflow.tanggal') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.cashflow.fields.tanggal_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('cashflow.sumber') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.cashflow.fields.sumber') }}</label>
        <select class="form-control" wire:model="cashflow.sumber">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['sumber'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('cashflow.sumber') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.cashflow.fields.sumber_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('cashflow.status') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.cashflow.fields.status') }}</label>
        <select class="form-control" wire:model="cashflow.status">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['status'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('cashflow.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.cashflow.fields.status_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('cashflow.catatan') ? 'invalid' : '' }}">
        <label class="form-label" for="catatan">{{ trans('cruds.cashflow.fields.catatan') }}</label>
        <textarea class="form-control" name="catatan" id="catatan" wire:model.defer="cashflow.catatan" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('cashflow.catatan') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.cashflow.fields.catatan_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.cashflows.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>