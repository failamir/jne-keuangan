<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pouting extends Model
{
    use HasAdvancedFilter;
    use SoftDeletes;
    use HasFactory;

    public $table = 'poutings';

    protected $dates = [
        'jatuh_tempo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'user.name',
        'jumlah',
        'jatuh_tempo',
        'nama_debitur',
        'nomor_telepon',
        'alamat_debitur',
        'status_piutang',
    ];

    protected $filterable = [
        'id',
        'user.name',
        'jumlah',
        'jatuh_tempo',
        'nama_debitur',
        'nomor_telepon',
        'alamat_debitur',
        'status_piutang',
    ];

    protected $fillable = [
        'user_id',
        'jumlah',
        'jatuh_tempo',
        'nama_debitur',
        'nomor_telepon',
        'alamat_debitur',
        'status_piutang',
        'catatan_piutang',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getJatuhTempoAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.date_format')) : null;
    }

    public function setJatuhTempoAttribute($value)
    {
        $this->attributes['jatuh_tempo'] = $value ? Carbon::createFromFormat(config('project.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
