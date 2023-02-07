<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Piutang extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'piutangs';

    public $orderable = [
        'id',
        'jumlah',
        'jatuh_tempo',
        'nama_debitur',
        'nomor_telepon',
        'alamat_debitur',
        'status_piutang',
        'catatan_piutang',
    ];

    public $filterable = [
        'id',
        'jumlah',
        'jatuh_tempo',
        'nama_debitur',
        'nomor_telepon',
        'alamat_debitur',
        'status_piutang',
        'catatan_piutang',
    ];

    protected $dates = [
        'jatuh_tempo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'jumlah',
        'jatuh_tempo',
        'nama_debitur',
        'nomor_telepon',
        'alamat_debitur',
        'status_piutang',
        'catatan_piutang',
    ];

    public function getJatuhTempoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('project.date_format')) : null;
    }

    public function setJatuhTempoAttribute($value)
    {
        $this->attributes['jatuh_tempo'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getDeletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setDeletedAtAttribute($value)
    {
        $this->attributes['deleted_at'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
