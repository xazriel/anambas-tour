<?php

namespace App\Livewire\Admin;

use App\Models\Destination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DestinationManager extends Component
{
    use WithPagination, WithFileUploads;

    // UI States
    public $search = '';
    public $showModal = false;
    public $isEditMode = false;
    public $selected_id;

    // Form Properties
    public $name, $district, $description_id, $description_en, $thumbnail;
    public $video_url, $map_location, $contact_person;
    public $overall_grade = 'C';
    public $score_attraction = 0;
    public $score_accessibility = 0;
    public $score_amenities = 0;
    public $is_top_destination = 0;
    
    // Simpan path lama untuk handling update foto
    public $old_thumbnail;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->resetInput();
        $this->isEditMode = false;
        $this->showModal = true;
    }

    public function resetInput()
    {
        $this->reset([
            'name', 'district', 'description_id', 'description_en', 'thumbnail', 
            'video_url', 'map_location', 'contact_person', 'overall_grade',
            'score_attraction', 'score_accessibility', 'score_amenities', 
            'is_top_destination', 'selected_id', 'old_thumbnail'
        ]);
        $this->resetErrorBag();
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min:5|unique:destinations,name,' . $this->selected_id,
            'district' => 'required',
            'description_id' => 'required',
            'overall_grade' => 'required|in:A,B,C',
            // thumbnail nullable agar saat edit tidak wajib upload ulang
            'thumbnail' => $this->thumbnail ? 'image|max:2048' : 'nullable',
        ];

        $this->validate($rules);

        // Handle Upload Thumbnail
        $imagePath = $this->old_thumbnail;
        if ($this->thumbnail && !is_string($this->thumbnail)) {
            // Hapus foto lama jika ada
            if ($this->old_thumbnail) {
                Storage::disk('public')->delete($this->old_thumbnail);
            }
            // Simpan file baru
            $imagePath = $this->thumbnail->store('thumbnails', 'public');
        }

        // Menyiapkan data untuk insert/update
        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name), // Fix: Pastikan slug selalu terisi
            'district' => $this->district,
            'description_id' => $this->description_id,
            'description_en' => $this->description_en,
            'thumbnail' => $imagePath,
            'video_url' => $this->video_url,
            'map_location' => $this->map_location,
            'contact_person' => $this->contact_person,
            'overall_grade' => $this->overall_grade,
            'score_attraction' => $this->score_attraction ?? 0,
            'score_accessibility' => $this->score_accessibility ?? 0,
            'score_amenities' => $this->score_amenities ?? 0,
            'is_top_destination' => $this->is_top_destination ? 1 : 0,
        ];

        if ($this->isEditMode) {
            Destination::find($this->selected_id)->update($data);
            session()->flash('message', 'Destinasi berhasil diperbarui!');
        } else {
            Destination::create($data);
            session()->flash('message', 'Destinasi berhasil ditambahkan!');
        }

        $this->showModal = false;
        $this->resetInput();
        
        // Opsional: Refresh halaman agar gambar baru muncul
        $this->dispatch('refreshComponent');
    }

    public function edit($id)
    {
        $this->resetInput();
        $this->isEditMode = true;
        $this->selected_id = $id;
        
        $destination = Destination::findOrFail($id);
        $this->name = $destination->name;
        $this->district = $destination->district;
        $this->description_id = $destination->description_id;
        $this->description_en = $destination->description_en;
        $this->old_thumbnail = $destination->thumbnail;
        $this->video_url = $destination->video_url; // <--- BENAR, ambil field video_url saja        $this->map_location = $destination->map_location;
        $this->contact_person = $destination->contact_person;
        $this->overall_grade = $destination->overall_grade;
        $this->score_attraction = $destination->score_attraction;
        $this->score_accessibility = $destination->score_accessibility;
        $this->score_amenities = $destination->score_amenities;
        $this->is_top_destination = $destination->is_top_destination;

        $this->showModal = true;
    }

    public function delete($id)
    {
        $destination = Destination::find($id);
        if ($destination) {
            if ($destination->thumbnail) {
                Storage::disk('public')->delete($destination->thumbnail);
            }
            $destination->delete();
            session()->flash('message', 'Destinasi berhasil dihapus!');
        }
    }

    public function render()
    {
        return view('livewire.admin.destination-manager', [
            'destinations' => Destination::where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10)
        ]);
    }
}