<?php

namespace App\Http\Requests;

use App\Models\Piutang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePiutangRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('piutang_edit'),
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
            'jumlah' => [
                'numeric',
                'nullable',
            ],
            'jatuh_tempo' => [
                'nullable',
                'date_format:' . config('project.date_format'),
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
