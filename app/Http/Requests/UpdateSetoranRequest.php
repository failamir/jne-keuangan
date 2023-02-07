<?php

namespace App\Http\Requests;

use App\Models\Setoran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class UpdateSetoranRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('setoran_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'jumlah_setoran' => [
                'numeric',
                'nullable',
            ],
            'tanggal_setoran' => [
                'date_format:' . config('project.date_format'),
                'nullable',
            ],
            'metode_setoran' => [
                'nullable',
                'in:' . implode(',', Arr::pluck(Setoran::METODE_SETORAN_SELECT, 'value')),
            ],
            'status_setoran' => [
                'nullable',
                'in:' . implode(',', Arr::pluck(Setoran::STATUS_SETORAN_SELECT, 'value')),
            ],
            'catatan_setoran' => [
                'string',
                'nullable',
            ],
            'piutang_id' => [
                'integer',
                'exists:poutings,id',
                'nullable',
            ],
        ];
    }
}
