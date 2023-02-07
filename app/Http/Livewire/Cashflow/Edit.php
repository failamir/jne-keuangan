<?php

namespace App\Http\Livewire\Cashflow;

use App\Models\Cashflow;
use Livewire\Component;

class Edit extends Component
{
    public Cashflow $cashflow;

    public array $listsForFields = [];

    public function mount(Cashflow $cashflow)
    {
        $this->cashflow = $cashflow;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.cashflow.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->cashflow->save();

        return redirect()->route('admin.cashflows.index');
    }

    protected function rules(): array
    {
        return [
            'cashflow.kategori_cashflow' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['kategori_cashflow'])),
            ],
            'cashflow.deskripsi' => [
                'string',
                'nullable',
            ],
            'cashflow.jumlah' => [
                'numeric',
                'nullable',
            ],
            'cashflow.tanggal' => [
                'nullable',
                'date_format:' . config('project.date_format'),
            ],
            'cashflow.sumber' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['sumber'])),
            ],
            'cashflow.status' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'cashflow.catatan' => [
                'string',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['kategori_cashflow'] = $this->cashflow::KATEGORI_CASHFLOW_SELECT;
        $this->listsForFields['sumber']            = $this->cashflow::SUMBER_SELECT;
        $this->listsForFields['status']            = $this->cashflow::STATUS_SELECT;
    }
}
