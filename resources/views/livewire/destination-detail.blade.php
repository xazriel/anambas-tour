<div class="min-h-screen bg-white">
    <div class="relative h-[60vh] w-full overflow-hidden">
        <img src="{{ asset('storage/' . $destination->thumbnail) }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
        <div class="absolute bottom-10 left-0 right-0 px-6 max-w-7xl mx-auto">
            <span class="px-3 py-1 bg-indigo-600 text-white text-xs font-bold rounded-full uppercase tracking-widest">
                {{ $destination->district }}
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-white mt-4 uppercase tracking-tighter">
                {{ $destination->name }}
            </h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 space-y-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 mb-4 font-headline">About this destination</h2>
                <p class="text-slate-600 leading-relaxed text-lg">
                    {{ $destination->description_id }}
                </p>
                @if($destination->description_en)
                    <p class="text-slate-400 leading-relaxed mt-4 italic text-base">
                        "{{ $destination->description_en }}"
                    </p>
                @endif
            </div>

            @if($destination->video_url)
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-slate-800 font-headline">Video Experience</h2>
                <div class="rounded-3xl overflow-hidden shadow-2xl bg-slate-100 aspect-video">
                    @php
                        // Helper sederhana untuk convert link YT ke embed
                        $embedUrl = str_replace('watch?v=', 'embed/', $destination->video_url);
                    @endphp
                    <iframe class="w-full h-full" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-slate-50 p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-4 uppercase tracking-widest text-sm">Location Details</h3>
                
                <div class="flex items-start gap-3 text-slate-600 mb-6">
                    <span class="material-symbols-outlined text-indigo-600">location_on</span>
                    <div>
                        <p class="text-sm font-bold text-slate-800">{{ $destination->district }} District</p>
                        <p class="text-xs">Kepulauan Anambas, Indonesia</p>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-200">
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Explore the natural beauty of {{ $destination->name }}. Make sure to prepare your travel essentials before visiting.
                    </p>
                </div>
            </div>

            @if($destination->map_location)
                <a href="{{ $destination->map_location }}" target="_blank" 
                   class="flex items-center justify-center gap-3 w-full py-5 bg-slate-900 text-white rounded-2xl font-bold hover:bg-indigo-600 transition-all duration-300 shadow-xl hover:shadow-indigo-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    OPEN IN GOOGLE MAPS
                </a>
            @endif
            
            <a href="/" wire:navigate class="flex items-center justify-center gap-2 w-full py-4 text-slate-500 font-medium hover:text-indigo-600 transition-colors">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Back to Destinations
            </a>
        </div>
    </div>
</div>