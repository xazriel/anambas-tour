<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pariwisata Anambas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="relative overflow-hidden bg-blue-700 rounded-xl shadow-lg">
                <div class="absolute inset-0 opacity-20 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
                <div class="relative p-8 md:p-12 text-white">
                    <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Jelajahi Surga Tersembunyi Anambas</h1>
                    <p class="text-lg text-blue-100 max-w-2xl">
                        Selamat datang di media informasi digital terintegrasi Kepulauan Anambas. Temukan keajaiban alam bahari, kekayaan budaya, dan kelezatan kuliner khas kami.
                    </p>
                    <div class="mt-6 flex gap-4">
                        <a href="#" class="bg-white text-blue-700 px-6 py-2 rounded-full font-bold hover:bg-blue-50 transition">Eksplorasi Destinasi</a>
                        <button class="border border-white text-white px-6 py-2 rounded-full font-bold hover:bg-white hover:text-blue-700 transition">Panduan Perjalanan</button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-md transition">
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">Foto Pantai Padang Melang</span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-xl text-gray-800">Wisata Bahari</h3>
                        <p class="text-sm text-gray-600 mt-2 italic">Pantai Padang Melang</p>
                        <p class="text-gray-500 text-sm mt-3 leading-relaxed">
                            Nikmati hamparan pasir putih terpanjang yang memukau dan kejernihan air laut di pulau-pulau eksotis Anambas.
                        </p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-md transition">
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">Foto Mie Tarempa</span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-xl text-gray-800">Kuliner Khas</h3>
                        <p class="text-sm text-gray-600 mt-2 italic">Mie Tarempa & Luti Gendang</p>
                        <p class="text-gray-500 text-sm mt-3 leading-relaxed">
                            Rasakan sensasi rasa otentik bumbu rempah dan ikan tongkol segar dalam hidangan legendaris khas Kepulauan Anambas.
                        </p>
                    </div>
                </div>

                <div class="bg-blue-50 overflow-hidden shadow-sm rounded-xl border border-blue-100">
                    <div class="p-6 h-full flex flex-col justify-between">
                        <div>
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-4">
                                <span class="relative flex h-2 w-2 mr-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                </span>
                                Virtual Guide Online
                            </div>
                            <h3 class="font-bold text-xl text-gray-800">Butuh Bantuan?</h3>
                            <p class="text-gray-600 text-sm mt-3 leading-relaxed">
                                Chatbot AI kami siap memberikan rekomendasi perjalanan, info transportasi, dan detail destinasi secara interaktif dan real-time.
                            </p>
                        </div>
                        <p class="text-xs text-blue-500 font-semibold mt-4">Klik ikon di pojok kanan bawah untuk memulai &rarr;</p>
                    </div>
                </div>

            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h4 class="text-gray-400 uppercase text-xs font-bold tracking-widest">Informasi Terkini</h4>
                <div class="mt-4 flex items-start gap-4">
                    <div class="bg-yellow-100 p-3 rounded-lg text-yellow-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-700 leading-relaxed">
                            Berdasarkan data BPS 2024, kunjungan wisatawan ke Anambas perlu ditingkatkan. Website ini hadir sebagai solusi inovatif untuk memperluas promosi melalui teknologi <strong>Chatbot Virtual Guide</strong>.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="fixed bottom-6 right-6 z-50">
        @livewire('chatbot')
    </div>
</x-app-layout>