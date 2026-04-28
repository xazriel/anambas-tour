<?php

namespace App\Livewire\Admin;

use App\Models\Culinary; // <--- GANTI SESUAI MODEL (Culture / Event)
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CulinaryManager extends Component // <--- GANTI NAMA CLASS
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $showModal = false;
    public $isEditMode = false;
    public $selected_id;

    // Common Form Properties
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
        $record = Culinary::findOrFail($id); // <--- GANTI MODEL
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
            Culinary::find($this->selected_id)->update($data); // <--- GANTI MODEL
        } else {
            Culinary::create($data); // <--- GANTI MODEL
        }

        $this->showModal = false;
        $this->resetInput();
        session()->flash('message', 'Data berhasil disimpan!');
    }

    public function delete($id) {
        $record = Culinary::find($id); // <--- GANTI MODEL
        if ($record->thumbnail) { Storage::disk('public')->delete($record->thumbnail); }
        $record->delete();
    }

    public function render() {
        return view('livewire.admin.culinary-manager', [ // <--- SESUAIKAN NAMA VIEW
            'items' => Culinary::where('name', 'like', '%' . $this->search . '%') // <--- GANTI MODEL
                ->latest()->paginate(10)
        ]);
    }
}