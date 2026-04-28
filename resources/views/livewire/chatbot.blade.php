<div x-data="{ open: false }" class="fixed bottom-5 right-5 w-80 md:w-96 z-50 flex flex-col items-end">
    
    <button 
        @click="open = !open" 
        x-show="!open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-full p-4 shadow-2xl flex items-center justify-center transition-all transform hover:scale-110"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>

    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95 translate-y-10"
        x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 transform scale-95 translate-y-10"
        class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-200 flex flex-col w-full h-[500px]"
    >
        <div class="bg-indigo-600 p-4 text-white font-bold flex justify-between items-center shadow-md">
            <div class="flex flex-col">
                <span class="text-sm">Guide Anambas AI</span>
                <div class="flex items-center gap-1 mt-1">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-normal uppercase tracking-wider">Online</span>
                </div>
            </div>
            <button @click="open = false" class="text-white hover:bg-indigo-500 p-1 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50/50" id="chat-content">
            @if(empty($chatHistory))
                <div class="flex flex-col items-center justify-center h-full text-center space-y-2 opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-xs text-gray-500">Halo! Tanyakan apapun seputar pariwisata di Kepulauan Anambas.</p>
                </div>
            @endif

            @foreach($chatHistory as $chat)
                <div class="flex {{ $chat['role'] == 'user' ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[85%] rounded-2xl p-3 shadow-sm {{ $chat['role'] == 'user' ? 'bg-indigo-600 text-white rounded-br-none' : 'bg-white text-gray-800 border border-gray-200 rounded-bl-none' }}">
                        
                        <p class="text-sm leading-relaxed">{!! $chat['content'] !!}</p>

                        @if(isset($chat['image']) && $chat['image'])
                            <div class="mt-3 overflow-hidden rounded-lg border border-gray-100 shadow-md bg-gray-100">
                                <img 
                                    src="{{ asset('storage/destinations/' . str_replace(' ', '%20', $chat['image'])) }}" 
                                    class="w-full h-auto object-cover hover:scale-105 transition-transform duration-300" 
                                    alt="Visual Destinasi"
                                    onload="window.dispatchEvent(new Event('scroll-to-bottom'))"
                                    onerror="this.parentElement.style.display='none'"
                                >
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <form wire:submit.prevent="sendMessage" class="p-4 border-t bg-white flex gap-2 items-center">
            <div class="relative flex-1">
                <input 
                    wire:model="message" 
                    type="text" 
                    class="w-full border-gray-200 rounded-full px-4 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500 transition-shadow pr-12" 
                    placeholder="Tanya tentang Anambas..."
                    required
                    autocomplete="off"
                >
                <button 
                    type="submit" 
                    wire:loading.attr="disabled"
                    class="absolute right-2 top-1/2 -translate-y-1/2 text-indigo-600 hover:text-indigo-800 p-1 transition-colors disabled:text-gray-400"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform rotate-90" viewBox="0 0 20 20" fill="currentColor" wire:loading.remove>
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                    <svg wire:loading class="animate-spin h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi Scroll Otomatis ke bawah setiap ada pesan baru
    window.addEventListener('scroll-to-bottom', () => {
        const chatContent = document.getElementById('chat-content');
        if (chatContent) {
            setTimeout(() => {
                chatContent.scrollTo({
                    top: chatContent.scrollHeight,
                    behavior: 'smooth'
                });
            }, 100);
        }
    });
</script>