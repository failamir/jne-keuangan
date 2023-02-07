<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cashflow extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public const SUMBER_SELECT = [
        'Setoran'   => 'Setoran',
        'Penarikan' => 'Penarikan',
        'Transfer'  => 'Transfer',
    ];

    public const KATEGORI_CASHFLOW_SELECT = [
        'Pemasukan'   => 'Pemasukan',
        'Pengeluaran' => 'Pengeluaran',
        'Transfer'    => 'Transfer',
    ];

    public const STATUS_SELECT = [
        'Lunas'               => 'Lunas',
        'Menunggu Pembayaran' => 'Menunggu Pembayaran',
        'Belum Dibayar'       => 'Belum Dibayar',
    ];

    public $table = 'cashflows';

    public $orderable = [
        'id',
        'kategori_cashflow',
        'deskripsi',
        'jumlah',
        'tanggal',
        'sumber',
        'status',
        'catatan',
    ];

    public $filterable = [
        'id',
        'kategori_cashflow',
        'deskripsi',
        'jumlah',
        'tanggal',
        'sumber',
        'status',
        'catatan',
    ];

    protected $dates = [
        'tanggal',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'kategori_cashflow',
        'deskripsi',
        'jumlah',
        'tanggal',
        'sumber',
        'status',
        'catatan',
    ];

    public function getKategoriCashflowLabelAttribute($value)
    {
        return static::KATEGORI_CASHFLOW_SELECT[$this->kategori_cashflow] ?? null;
    }

    public function getTanggalAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('project.date_format')) : null;
    }

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSumberLabelAttribute($value)
    {
        return static::SUMBER_SELECT[$this->sumber] ?? null;
    }

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_SELECT[$this->status] ?? null;
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
