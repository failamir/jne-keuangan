<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('piutang.nama_debitur') ? 'invalid' : '' }}">
        <label class="form-label" for="nama_debitur">{{ trans('cruds.piutang.fields.nama_debitur') }}</label>
        <input class="form-control" type="text" name="nama_debitur" id="nama_debitur" wire:model.defer="piutang.nama_debitur">
        <div class="validation-message">
            {{ $errors->first('piutang.nama_debitur') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.piutang.fields.nama_debitur_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('piutang.nomor_telepon') ? 'invalid' : '' }}">
        <label class="form-label" for="nomor_telepon">{{ trans('cruds.piutang.fields.nomor_telepon') }}</label>
        <input class="form-control" type="text" name="nomor_telepon" id="nomor_telepon" wire:model.defer="piutang.nomor_telepon">
        <div class="validation-message">
            {{ $errors->first('piutang.nomor_telepon') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.piutang.fields.nomor_telepon_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('piutang.alamat_debitur') ? 'invalid' : '' }}">
        <label class="form-label" for="alamat_debitur">{{ trans('cruds.piutang.fields.alamat_debitur') }}</label>
        <input class="form-control" type="text" name="alamat_debitur" id="alamat_debitur" wire:model.defer="piutang.alamat_debitur">
        <div class="validation-message">
            {{ $errors->first('piutang.alamat_debitur') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.piutang.fields.alamat_debitur_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('piutang.jumlah') ? 'invalid' : '' }}">
        <label class="form-label" for="jumlah">{{ trans('cruds.piutang.fields.jumlah') }}</label>
        <input class="form-control" type="number" name="jumlah" id="jumlah" wire:model.defer="piutang.jumlah" step="0.01">
        <div class="validation-message">
            {{ $errors->first('piutang.jumlah') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.piutang.fields.jumlah_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('piutang.jatuh_tempo') ? 'invalid' : '' }}">
        <label class="form-label" for="jatuh_tempo">{{ trans('cruds.piutang.fields.jatuh_tempo') }}</label>
        <x-date-picker class="form-control" wire:model="piutang.jatuh_tempo" id="jatuh_tempo" name="jatuh_tempo" picker="date" />
        <div class="validation-message">
            {{ $errors->first('piutang.jatuh_tempo') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.piutang.fields.jatuh_tempo_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('piutang.status_piutang') ? 'invalid' : '' }}">
        <label class="form-label" for="status_piutang">{{ trans('cruds.piutang.fields.status_piutang') }}</label>
        <input class="form-control" type="text" name="status_piutang" id="status_piutang" wire:model.defer="piutang.status_piutang">
        <div class="validation-message">
            {{ $errors->first('piutang.status_piutang') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.piutang.fields.status_piutang_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('piutang.catatan_piutang') ? 'invalid' : '' }}">
        <label class="form-label" for="catatan_piutang">{{ trans('cruds.piutang.fields.catatan_piutang') }}</label>
        <textarea class="form-control" name="catatan_piutang" id="catatan_piutang" wire:model.defer="piutang.catatan_piutang" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('piutang.catatan_piutang') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.piutang.fields.catatan_piutang_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.piutangs.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>