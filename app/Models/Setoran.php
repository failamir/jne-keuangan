<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setoran extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public const METODE_SETORAN_SELECT = [
        'Transfer Bank' => 'Transfer Bank',
        'Cash'          => 'Cash',
        'QRIS'          => 'QRIS',
    ];

    public const STATUS_SETORAN_SELECT = [
        'Lunas'               => 'Lunas',
        'Menunggu Pembayaran' => 'Menunggu Pembayaran',
        'Belum Dibayar'       => 'Belum Dibayar',
    ];

    public $table = 'setorans';

    public $orderable = [
        'id',
        'jumlah_setoran',
        'tanggal_setoran',
        'metode_setoran',
        'status_setoran',
        'catatan_setoran',
        'piutang.nama_debitur',
        'piutang.jumlah',
    ];

    public $filterable = [
        'id',
        'jumlah_setoran',
        'tanggal_setoran',
        'metode_setoran',
        'status_setoran',
        'catatan_setoran',
        'piutang.nama_debitur',
        'piutang.jumlah',
    ];

    protected $dates = [
        'tanggal_setoran',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'jumlah_setoran',
        'tanggal_setoran',
        'metode_setoran',
        'status_setoran',
        'catatan_setoran',
        'piutang_id',
    ];

    public function getTanggalSetoranAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('project.date_format')) : null;
    }

    public function setTanggalSetoranAttribute($value)
    {
        $this->attributes['tanggal_setoran'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getMetodeSetoranLabelAttribute($value)
    {
        return static::METODE_SETORAN_SELECT[$this->metode_setoran] ?? null;
    }

    public function getStatusSetoranLabelAttribute($value)
    {
        return static::STATUS_SETORAN_SELECT[$this->status_setoran] ?? null;
    }

    public function piutang()
    {
        return $this->belongsTo(Piutang::class);
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
