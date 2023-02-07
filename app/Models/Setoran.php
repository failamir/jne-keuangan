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
    use HasAdvancedFilter;
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SETORAN_SELECT = [
        [
            'label' => 'Lunas',
            'value' => 'Lunas',
        ],
        [
            'label' => 'Menunggu Pembayaran',
            'value' => 'Menunggu Pembayaran',
        ],
        [
            'label' => 'Belum Dibayar',
            'value' => 'Belum Dibayar',
        ],
    ];

    public const METODE_SETORAN_SELECT = [
        [
            'label' => 'Transfer Bank',
            'value' => 'Transfer Bank',
        ],
        [
            'label' => 'QRIS',
            'value' => 'QRIS',
        ],
        [
            'label' => 'CASH',
            'value' => 'CASH',
        ],
        [
            'label' => 'Shopee Pay',
            'value' => 'Shopee Pay',
        ],
    ];

    public $table = 'setorans';

    protected $appends = [
        'metode_setoran_label',
        'status_setoran_label',
    ];

    protected $dates = [
        'tanggal_setoran',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'user.name',
        'jumlah_setoran',
        'tanggal_setoran',
        'metode_setoran',
        'status_setoran',
        'piutang.nama_debitur',
    ];

    protected $filterable = [
        'id',
        'user.name',
        'jumlah_setoran',
        'tanggal_setoran',
        'metode_setoran',
        'status_setoran',
        'piutang.nama_debitur',
    ];

    protected $fillable = [
        'user_id',
        'jumlah_setoran',
        'tanggal_setoran',
        'metode_setoran',
        'status_setoran',
        'catatan_setoran',
        'piutang_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTanggalSetoranAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.date_format')) : null;
    }

    public function setTanggalSetoranAttribute($value)
    {
        $this->attributes['tanggal_setoran'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getMetodeSetoranLabelAttribute()
    {
        return collect(static::METODE_SETORAN_SELECT)->firstWhere('value', $this->metode_setoran)['label'] ?? '';
    }

    public function getStatusSetoranLabelAttribute()
    {
        return collect(static::STATUS_SETORAN_SELECT)->firstWhere('value', $this->status_setoran)['label'] ?? '';
    }

    public function piutang()
    {
        return $this->belongsTo(Pouting::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
