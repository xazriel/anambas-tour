<div>
    <div class="flex flex-wrap gap-4 mb-12 bg-surface-container-low p-4 rounded-2xl border border-outline-variant/10">
        <div class="flex-grow min-w-[250px]">
            <input wire:model.live="search" type="text" placeholder="Search destinations..." 
                class="w-full bg-surface-container-lowest border-none rounded-xl py-3 px-4 focus:ring-2 focus:ring-primary/20 text-sm">
        </div>
        <select wire:model.live="district" class="bg-surface-container-lowest border-none rounded-xl py-3 px-6 text-sm focus:ring-2 focus:ring-primary/20 min-w-[180px]">
            <option value="">All Districts</option>
            <option value="Siantan">Siantan</option>
            <option value="Siantan Timur">Siantan Timur</option>
            <option value="Siantan Selatan">Siantan Selatan</option>
            <option value="Siantan Tengah">Siantan Tengah</option>
            <option value="Siantan Utara">Siantan Utara</option>
            <option value="Palmatak">Palmatak</option>
            <option value="Jemaja">Jemaja</option>
            <option value="Jemaja Timur">Jemaja Timur</option>
            <option value="Jemaja Barat">Jemaja Barat</option>
            <option value="Kute Siantan">Kute Siantan</option>
                </select>
        <select wire:model.live="grade" class="bg-surface-container-lowest border-none rounded-xl py-3 px-6 text-sm focus:ring-2 focus:ring-primary/20">
            <option value="">All Grades</option>
            <option value="A">Grade A</option>
            <option value="B">Grade B</option>
            <option value="C">Grade C</option>
        </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($destinations as $item)
            <div class="group bg-surface-container-lowest rounded-2xl overflow-hidden ambient-shadow flex flex-col h-[520px] transition-all duration-500 hover:-translate-y-2 border border-outline-variant/10">
                <div class="h-3/5 overflow-hidden relative">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                        src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'https://images.unsplash.com/photo-1559128010-7c1ad6e1b6a5?q=80&w=2073' }}" 
                        alt="{{ $item->name }}"/>
                    
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full shadow-sm flex items-center gap-1">
                        <span class="text-[10px] font-bold text-primary uppercase">Grade</span>
                        <span class="text-sm font-black text-primary">{{ $item->overall_grade }}</span>
                    </div>
                </div>
                
                <div class="p-8 flex flex-col justify-between flex-grow">
                    <div>
                        <span class="text-tertiary text-[10px] font-bold uppercase tracking-widest">{{ $item->district }}</span>
                        <h3 class="text-2xl font-headline font-bold mb-2 text-on-surface">{{ $item->name }}</h3>
                        <p class="text-on-surface-variant line-clamp-2 text-sm leading-relaxed">{{ $item->description }}</p>
                    </div>
                    
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('destination.detail', $item->slug) }}" class="text-primary font-bold text-sm flex items-center gap-2 group/btn">
                                Explore Destination 
                                <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center bg-surface-container-low rounded-3xl border-2 border-dashed border-outline-variant/30">
                <span class="material-symbols-outlined text-5xl text-outline-variant mb-4">search_off</span>
                <p class="text-on-surface-variant font-medium">Belum ada destinasi di kategori ini.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $destinations->links() }}
    </div>
</div>