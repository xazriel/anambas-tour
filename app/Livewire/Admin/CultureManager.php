<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CultureManager extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $showModal = false;
    public $isEditMode = false;
    public $selected_id;

    public $name, $district, $description_id, $description_en, $thumbnail, $old_thumbnail;

    protected $rules = [
        'name' => 'required|min:5',
        'district' => 'required',
        'description_id' => 'required',
    ];

    public function openModal() {
        $this->resetInput();
        $this->isEditMode = false;
        $this->showModal = true;
    }

    public function resetInput() {
        $this->reset(['name', 'district', 'description_id', 'description_en', 'thumbnail', 'selected_id', 'old_thumbnail']);
        $this->resetErrorBag();
    }

    public function edit($id) {
        $this->isEditMode = true;
        $this->selected_id = $id;
        $record = \App\Models\Culture::findOrFail($id); // FIXED: Pakai model Culture
        $this->name = $record->name;
        $this->district = $record->district;
        $this->description_id = $record->description_id;
        $this->description_en = $record->description_en;
        $this->old_thumbnail = $record->thumbnail;
        $this->showModal = true;
    }

    public function store() {
        $this->validate();

        $imagePath = $this->old_thumbnail;
        if ($this->thumbnail) {
            if ($this->old_thumbnail) { Storage::disk('public')->delete($this->old_thumbnail); }
            $imagePath = $this->thumbnail->store('uploads', 'public');
        }

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'district' => $this->district,
            'description_id' => $this->description_id,
            'description_en' => $this->description_en,
            'thumbnail' => $imagePath,
        ];

        if ($this->isEditMode) {
            \App\Models\Culture::find($this->selected_id)->update($data); // FIXED: Culture
        } else {
            \App\Models\Culture::create($data); // FIXED: Culture
        }

        $this->showModal = false;
        $this->resetInput();
        session()->flash('message', 'Data budaya berhasil disimpan!');
    }

    public function delete($id) {
        $record = \App\Models\Culture::find($id); // FIXED: Culture
        if ($record->thumbnail) { Storage::disk('public')->delete($record->thumbnail); }
        $record->delete();
    }

    public function render() {
        return view('livewire.admin.culture-manager', [ // FIXED: Mengarah ke culture-manager blade
            'items' => \App\Models\Culture::where('name', 'like', '%' . $this->search . '%')
                ->latest()->paginate(10)
        ]);
    }
}