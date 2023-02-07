<?php

namespace App\Http\Requests;

use App\Models\Cashflow;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCashflowRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('cashflow_create'),
            response()->json(
                ['message' => 'This action is unauthorized.'],
                Response::HTTP_FORBIDDEN
            ),
        );

        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_cashflow' => [
                'nullable',
                'in:' . implode(',', array_keys(Cashflow::KATEGORI_CASHFLOW_SELECT)),
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
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
            'sumber' => [
                'nullable',
                'in:' . implode(',', array_keys(Cashflow::SUMBER_SELECT)),
            ],
            'status' => [
                'nullable',
                'in:' . implode(',', array_keys(Cashflow::STATUS_SELECT)),
            ],
            'catatan' => [
                'string',
                'nullable',
            ],
        ];
    }
}
