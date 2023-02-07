<?php

namespace App\Http\Requests;

use App\Models\Cashflow;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class StoreCashflowRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cashflow_create');
    }

    public function rules()
    {
        return [
            'kategori_cashflow' => [
                'nullable',
                'in:' . implode(',', Arr::pluck(Cashflow::KATEGORI_CASHFLOW_SELECT, 'value')),
            ],
            'deskripsi' => [
                'string',
                'nullable',
            ],
            'jumlah' => [
                'numeric',
                'nullable',
            ],
            'tanggal' => [
                'date_format:' . config('project.date_format'),
                'nullable',
            ],
            'sumber' => [
                'nullable',
                'in:' . implode(',', Arr::pluck(Cashflow::SUMBER_SELECT, 'value')),
            ],
            'status' => [
                'nullable',
                'in:' . implode(',', Arr::pluck(Cashflow::STATUS_SELECT, 'value')),
            ],
            'catatan' => [
                'string',
                'nullable',
            ],
        ];
    }
}
