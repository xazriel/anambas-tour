<div class="fixed bottom-5 right-5 w-80 md:w-96 z-50">
    <div class="bg-white shadow-2xl rounded-lg overflow-hidden border border-gray-200 flex flex-col">
        <div class="bg-indigo-600 p-4 text-white font-bold flex justify-between items-center">
            <span>Guide Anambas AI</span>
            <div class="flex items-center gap-1">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span class="text-xs font-normal">Online</span>
            </div>
        </div>

        <div class="h-96 overflow-y-auto p-4 space-y-4 bg-gray-50" id="chat-content">
            @foreach($chatHistory as $chat)
                <div class="flex {{ $chat['role'] == 'user' ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[85%] rounded-2xl p-3 shadow-sm {{ $chat['role'] == 'user' ? 'bg-indigo-600 text-white rounded-tr-none' : 'bg-white text-gray-800 border border-gray-200 rounded-tl-none' }}">
                        <p class="text-sm">{{ $chat['content'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <form wire:submit.prevent="sendMessage" class="p-3 border-t bg-white flex gap-2">
            <input wire:model="message" type="text" 
                   class="flex-1 border-gray-300 rounded-full px-4 text-sm focus:ring-indigo-500 focus:border-indigo-500" 
                   placeholder="Tanya tentang Anambas...">
            <button type="submit" class="bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
            </button>
        </form>
    </div>
</div>