<?php

namespace App\Livewire;

use App\Models\Destination;
use Livewire\Component;

class DestinationDetail extends Component
{
    public $destination;

    public function mount($slug)
    {
        // Cari destinasi berdasarkan slug
        $this->destination = Destination::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.destination-detail')
            ->layout('layouts.app'); // Pastikan ini sesuai dengan layout utama kamu
    }
}