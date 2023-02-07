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
    use HasAdvancedFilter;
    use SoftDeletes;
    use HasFactory;

    public const SUMBER_SELECT = [
        [
            'label' => 'Setoran',
            'value' => 'Setoran',
        ],
        [
            'label' => 'Penarikan',
            'value' => 'Penarikan',
        ],
        [
            'label' => 'Transfer',
            'value' => 'Transfer',
        ],
    ];

    public const KATEGORI_CASHFLOW_SELECT = [
        [
            'label' => 'Pemasukan',
            'value' => 'Pemasukan',
        ],
        [
            'label' => 'Pengeluaran',
            'value' => 'Pengeluaran',
        ],
        [
            'label' => 'Transfer',
            'value' => 'Transfer',
        ],
    ];

    public const STATUS_SELECT = [
        [
            'label' => 'Lunas',
            'value' => 'Lunas',
        ],
        [
            'label' => 'Menunggu Pembayaran',
            'value' => 'Menunggu Pembayaran',
        ],
        [
            'label' => 'Belum dibayar',
            'value' => 'Belum dibayar',
        ],
    ];

    public $table = 'cashflows';

    protected $dates = [
        'tanggal',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'kategori_cashflow_label',
        'sumber_label',
        'status_label',
    ];

    protected $orderable = [
        'id',
        'kategori_cashflow',
        'jumlah',
        'tanggal',
        'sumber',
        'status',
    ];

    protected $filterable = [
        'id',
        'kategori_cashflow',
        'jumlah',
        'tanggal',
        'sumber',
        'status',
    ];

    protected $fillable = [
        'kategori_cashflow',
        'deskripsi',
        'jumlah',
        'tanggal',
        'sumber',
        'status',
        'catatan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getKategoriCashflowLabelAttribute()
    {
        return collect(static::KATEGORI_CASHFLOW_SELECT)->firstWhere('value', $this->kategori_cashflow)['label'] ?? '';
    }

    public function getTanggalAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.date_format')) : null;
    }

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSumberLabelAttribute()
    {
        return collect(static::SUMBER_SELECT)->firstWhere('value', $this->sumber)['label'] ?? '';
    }

    public function getStatusLabelAttribute()
    {
        return collect(static::STATUS_SELECT)->firstWhere('value', $this->status)['label'] ?? '';
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
