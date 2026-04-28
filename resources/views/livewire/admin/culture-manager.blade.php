<div class="space-y-6" x-data="{ open: @entangle('showModal') }">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold text-slate-800">Manage Cultures</h2>
        <button wire:click="openModal" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold transition">
            + Add Culture
        </button>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="p-4 border-b border-slate-100">
            <input wire:model.live="search" type="text" placeholder="Search cultures..." class="w-full md:w-80 rounded-xl border-slate-200 focus:ring-indigo-500">
        </div>
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-widest">
                <tr>
                    <th class="px-6 py-4 text-slate-500">Name</th>
                    <th class="px-6 py-4 text-slate-500">District</th>
                    <th class="px-6 py-4 text-right text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($items as $item)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 font-bold text-slate-700">{{ $item->name }}</td>
                    <td class="px-6 py-4 text-slate-500 text-sm">{{ $item->district }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <button wire:click="edit({{ $item->id }})" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">Edit</button>
                        <button wire:click="delete({{ $item->id }})" wire:confirm="Delete this item?" class="text-rose-600 hover:text-rose-900 font-medium text-sm">Delete</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-6 py-10 text-center text-slate-400 italic">No cultures found.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($items->hasPages())
        <div class="p-4 bg-slate-50 border-t border-slate-100">
            {{ $items->links() }}
        </div>
        @endif
    </div>

    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-cloak x-transition>
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="open = false"></div>
        <div class="bg-white rounded-3xl shadow-2xl z-50 w-full max-w-2xl p-8 transform transition-all">
            <h3 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight">{{ $isEditMode ? 'Edit' : 'Add' }} Culture</h3>
            <form wire:submit.prevent="store" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1 tracking-wider">Name</label>
                        <input wire:model="name" type="text" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1 tracking-wider">District</label>
                        <input wire:model="district" type="text" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1 tracking-wider">Thumbnail</label>
                        <input wire:model="thumbnail" type="file" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1 tracking-wider">Description (ID)</label>
                    <textarea wire:model="description_id" rows="3" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
                <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-slate-100">
                    <button type="button" @click="open = false" class="px-6 py-2 text-slate-400 font-bold uppercase text-xs hover:text-slate-600">Cancel</button>
                    <button type="submit" class="bg-slate-900 text-white px-8 py-2 rounded-xl font-black uppercase text-xs shadow-lg hover:bg-black transition-colors">
                        Save Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>