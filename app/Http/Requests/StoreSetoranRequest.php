<?php

namespace App\Http\Requests;

use App\Models\Setoran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSetoranRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('setoran_create'),
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
            'jumlah_setoran' => [
                'numeric',
                'nullable',
            ],
            'tanggal_setoran' => [
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
            'metode_setoran' => [
                'nullable',
                'in:' . implode(',', array_keys(Setoran::METODE_SETORAN_SELECT)),
            ],
            'status_setoran' => [
                'nullable',
                'in:' . implode(',', array_keys(Setoran::STATUS_SETORAN_SELECT)),
            ],
            'catatan_setoran' => [
                'string',
                'nullable',
            ],
            'piutang_id' => [
                'integer',
                'exists:piutangs,id',
                'nullable',
            ],
        ];
    }
}
