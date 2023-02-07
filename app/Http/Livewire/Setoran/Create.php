<?php

namespace App\Http\Livewire\Setoran;

use App\Models\Piutang;
use App\Models\Setoran;
use Livewire\Component;

class Create extends Component
{
    public Setoran $setoran;

    public array $listsForFields = [];

    public function mount(Setoran $setoran)
    {
        $this->setoran                 = $setoran;
        $this->setoran->jumlah_setoran = '0';
        $this->setoran->metode_setoran = 'Cash';
        $this->setoran->status_setoran = 'Belum Dibayar';
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.setoran.create');
    }

    public function submit()
    {
        $this->validate();

        $this->setoran->save();

        return redirect()->route('admin.setorans.index');
    }

    protected function rules(): array
    {
        return [
            'setoran.jumlah_setoran' => [
                'numeric',
                'nullable',
            ],
            'setoran.tanggal_setoran' => [
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
            'setoran.metode_setoran' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['metode_setoran'])),
            ],
            'setoran.status_setoran' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['status_setoran'])),
            ],
            'setoran.catatan_setoran' => [
                'string',
                'nullable',
            ],
            'setoran.piutang_id' => [
                'integer',
                'exists:piutangs,id',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['metode_setoran'] = $this->setoran::METODE_SETORAN_SELECT;
        $this->listsForFields['status_setoran'] = $this->setoran::STATUS_SETORAN_SELECT;
        $this->listsForFields['piutang']        = Piutang::pluck('nama_debitur', 'id')->toArray();
    }
}
