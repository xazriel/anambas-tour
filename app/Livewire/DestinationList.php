<?php

namespace App\Livewire;

use App\Models\Destination;
use Livewire\Component;
use Livewire\WithPagination;

class DestinationList extends Component
{
    use WithPagination;

    public $search = '';
    public $district = '';
    public $grade = '';
    public $showTopOnly = false;

    public function render()
    {
        $query = Destination::query();

        if ($this->search) $query->where('name', 'like', '%'.$this->search.'%');
        if ($this->district) $query->where('district', $this->district);
        if ($this->grade) $query->where('overall_grade', $this->grade);
        
        // Logika sortir Top Destination
        if ($this->showTopOnly) {
            $query->where('is_top_destination', true)->limit(10);
        }

        return view('livewire.destination-list', [
            'destinations' => $query->latest()->paginate(9)
        ]);
    }
}