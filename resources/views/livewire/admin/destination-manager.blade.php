<div class="space-y-6" x-data="{ open: @entangle('showModal') }">
    @if (session()->has('message'))
        <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl shadow-sm mb-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <p class="font-medium">{{ session('message') }}</p>
            </div>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="relative w-full md:w-80">
            <input wire:model.live="search" type="text" placeholder="Search destinations..." 
                class="w-full pl-10 pr-4 py-2.5 rounded-xl border-none ring-1 ring-slate-200 focus:ring-2 focus:ring-indigo-500 transition shadow-sm">
            <div class="absolute left-3 top-3 text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
        
        <button wire:click="openModal" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-medium transition flex items-center justify-center gap-2 shadow-lg shadow-indigo-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Destination
        </button>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Preview</th>
                        <th class="px-6 py-4 font-semibold">Name</th>
                        <th class="px-6 py-4 font-semibold">District</th>
                        <th class="px-6 py-4 font-semibold text-center">Grade</th>
                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($destinations as $item)
                    <tr class="hover:bg-slate-50/50 transition group">
                        <td class="px-6 py-4">
                            <div class="w-14 h-14 rounded-2xl bg-slate-100 overflow-hidden border border-slate-200 shadow-sm">
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                @else
                                    <div class="flex items-center justify-center h-full text-[10px] text-slate-400 font-medium">NO IMG</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-700 uppercase tracking-tight">{{ $item->name }}</td>
                        <td class="px-6 py-4 text-slate-500 text-sm italic">{{ $item->district }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase
                                {{ $item->overall_grade == 'A' ? 'bg-emerald-100 text-emerald-700' : ($item->overall_grade == 'B' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') }}">
                                GRADE {{ $item->overall_grade }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <button wire:click="edit({{ $item->id }})" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <button wire:click="delete({{ $item->id }})" wire:confirm="Are you sure you want to delete this destination?" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-slate-400 font-medium italic">No destinations found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-slate-50/50 border-t border-slate-100">
            {{ $destinations->links() }}
        </div>
    </div>

    <div x-show="open" class="fixed inset-0 z-[60] overflow-y-auto" x-cloak>
        <div class="flex items-center justify-center min-h-screen px-4 py-10">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-slate-900/60 backdrop-blur-md transition-opacity" @click="open = false"></div>

            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                class="bg-white rounded-[2rem] shadow-2xl z-[70] w-full max-w-4xl transform transition-all overflow-hidden">
                
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-2xl font-black text-slate-800 tracking-tight">{{ $isEditMode ? 'EDIT DESTINATION' : 'NEW DESTINATION' }}</h3>
                            <p class="text-slate-500 text-sm mt-1">Fill in the details for Anambas tourism.</p>
                        </div>
                        <button @click="open = false" class="p-2 bg-slate-100 text-slate-400 hover:text-slate-600 rounded-full transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="store" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">Destination Name</label>
                                    <input wire:model="name" type="text" class="w-full rounded-2xl border-slate-200 focus:ring-2 focus:ring-indigo-500 transition py-3">
                                    @error('name') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">District</label>
                                        <input wire:model="district" type="text" placeholder="e.g. Siantan" class="w-full rounded-2xl border-slate-200 focus:ring-2 focus:ring-indigo-500 py-3">
                                        @error('district') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">Overall Grade</label>
                                        <select wire:model="overall_grade" class="w-full rounded-2xl border-slate-200 focus:ring-2 focus:ring-indigo-500 py-3">
                                            <option value="A">Grade A</option>
                                            <option value="B">Grade B</option>
                                            <option value="C">Grade C</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="space-y-4 bg-indigo-50/50 p-4 rounded-2xl border border-indigo-100">
                                    <div>
                                        <label class="block text-[10px] font-black uppercase text-indigo-400 mb-2">YouTube Video URL</label>
                                        <input wire:model="video_url" type="text" placeholder="https://youtube.com/..." class="w-full rounded-xl border-slate-200 focus:ring-indigo-500 py-2 text-sm">
                                        @error('video_url') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black uppercase text-indigo-400 mb-2">Google Maps Link</label>
                                        <input wire:model="map_location" type="text" placeholder="https://maps.app.goo.gl/..." class="w-full rounded-xl border-slate-200 focus:ring-indigo-500 py-2 text-sm">
                                        @error('map_location') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">Thumbnail Image</label>
                                    <div class="flex items-start gap-4">
                                        <div class="w-24 h-24 rounded-2xl bg-slate-100 border-2 border-dashed border-slate-300 overflow-hidden flex-shrink-0">
                                            @if ($thumbnail)
                                                <img src="{{ $thumbnail->temporaryUrl() }}" class="w-full h-full object-cover">
                                            @elseif ($old_thumbnail)
                                                <img src="{{ asset('storage/' . $old_thumbnail) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="flex items-center justify-center h-full text-[10px] text-slate-400 text-center p-2 uppercase font-bold">No Preview</div>
                                            @endif
                                        </div>
                                        <label class="flex-1 flex flex-col items-center justify-center h-24 border-2 border-slate-200 border-dashed rounded-2xl cursor-pointer bg-slate-50 hover:bg-indigo-50 hover:border-indigo-300 transition group">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-6 h-6 text-slate-400 group-hover:text-indigo-500 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-tighter">Choose File</p>
                                            </div>
                                            <input wire:model="thumbnail" type="file" class="hidden" />
                                        </label>
                                    </div>
                                    @error('thumbnail') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">Description (Indonesian)</label>
                                    <textarea wire:model="description_id" rows="5" class="w-full rounded-2xl border-slate-200 focus:ring-2 focus:ring-indigo-500"></textarea>
                                    @error('description_id') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">Description (English)</label>
                                    <textarea wire:model="description_en" rows="5" placeholder="Optional description in English..." class="w-full rounded-2xl border-slate-200 focus:ring-2 focus:ring-indigo-500 italic"></textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">Contact Person</label>
                                    <input wire:model="contact_person" type="text" placeholder="e.g. 0812..." class="w-full rounded-2xl border-slate-200 focus:ring-2 focus:ring-indigo-500 py-3 text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-50 p-6 rounded-3xl grid grid-cols-3 gap-4 border border-slate-100">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Attraction</label>
                                <input wire:model="score_attraction" type="number" class="w-full rounded-xl border-slate-200 focus:ring-indigo-500 py-2">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Accessibility</label>
                                <input wire:model="score_accessibility" type="number" class="w-full rounded-xl border-slate-200 focus:ring-indigo-500 py-2">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2">Amenities</label>
                                <input wire:model="score_amenities" type="number" class="w-full rounded-xl border-slate-200 focus:ring-indigo-500 py-2">
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" wire:model="is_top_destination" id="is_top" class="rounded text-indigo-600 focus:ring-indigo-500">
                                <label for="is_top" class="text-xs font-bold text-slate-500 uppercase tracking-widest">Mark as Top Destination</label>
                            </div>
                            <div class="flex gap-4">
                                <button type="button" @click="open = false" class="px-6 py-3 rounded-2xl text-slate-500 font-bold hover:bg-slate-100 transition uppercase tracking-widest text-xs">Discard</button>
                                <button type="submit" wire:loading.attr="disabled" class="px-10 py-3 bg-slate-900 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-indigo-600 transition disabled:opacity-50 flex items-center gap-2 shadow-xl shadow-slate-200">
                                    <span wire:loading.remove>{{ $isEditMode ? 'Save Changes' : 'Create Now' }}</span>
                                    <span wire:loading>Processing...</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>