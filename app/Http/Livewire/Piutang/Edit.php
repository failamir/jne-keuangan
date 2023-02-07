<?php

namespace App\Http\Livewire\Piutang;

use App\Models\Piutang;
use Livewire\Component;

class Edit extends Component
{
    public Piutang $piutang;

    public function mount(Piutang $piutang)
    {
        $this->piutang = $piutang;
    }

    public function render()
    {
        return view('livewire.piutang.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->piutang->save();

        return redirect()->route('admin.piutangs.index');
    }

    protected function rules(): array
    {
        return [
            'piutang.nama_debitur' => [
                'string',
                'nullable',
            ],
            'piutang.nomor_telepon' => [
                'string',
                'nullable',
            ],
            'piutang.alamat_debitur' => [
                'string',
                'nullable',
            ],
            'piutang.jumlah' => [
                'numeric',
                'nullable',
            ],
            'piutang.jatuh_tempo' => [
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
            'piutang.status_piutang' => [
                'string',
                'nullable',
            ],
            'piutang.catatan_piutang' => [
                'string',
                'nullable',
            ],
        ];
    }
}
