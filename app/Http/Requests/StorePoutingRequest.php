<?php

namespace App\Http\Requests;

use App\Models\Pouting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePoutingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pouting_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'jumlah' => [
                'numeric',
                'nullable',
            ],
            'jatuh_tempo' => [
                'date_format:' . config('project.date_format'),
                'nullable',
            ],
            'nama_debitur' => [
                'string',
                'nullable',
            ],
            'nomor_telepon' => [
                'string',
                'nullable',
            ],
            'alamat_debitur' => [
                'string',
                'nullable',
            ],
            'status_piutang' => [
                'string',
                'nullable',
            ],
            'catatan_piutang' => [
                'string',
                'nullable',
            ],
        ];
    }
}
