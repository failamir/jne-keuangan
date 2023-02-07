<?php

namespace App\Http\Livewire\Setoran;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Setoran;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use WithConfirmation;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Setoran())->orderable;
    }

    public function render()
    {
        $query = Setoran::with(['piutang'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $setorans = $query->paginate($this->perPage);

        return view('livewire.setoran.index', compact('query', 'setorans'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('setoran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Setoran::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Setoran $setoran)
    {
        abort_if(Gate::denies('setoran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setoran->delete();
    }
}
