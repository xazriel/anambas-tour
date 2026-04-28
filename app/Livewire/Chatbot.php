<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Destination;
use Illuminate\Support\Facades\Http;

class Chatbot extends Component
{
    public $message = '';
    public $chatHistory = [];

    public function sendMessage()
    {
        if (empty($this->message)) return;

        // 1. AMBIL DATA DARI DATABASE
        $destinasiData = Destination::all();
        
        $destinasiString = $destinasiData->map(function($item) {
            return "NAMA: {$item->name} | INFO: {$item->description} | FILE_GAMBAR: {$item->image}";
        })->implode(" --- ");

        // Simpan pesan user ke history
        $this->chatHistory[] = ['role' => 'user', 'content' => $this->message];
        $userQuestion = $this->message;
        $this->message = '';

        try {
            $apiKey = env('GEMINI_API_KEY');

            // LANGKAH 1: Cari model yang aktif
            $listResponse = Http::withOptions(['verify' => false])
                ->get("https://generativelanguage.googleapis.com/v1beta/models?key=" . $apiKey);

            $availableModels = $listResponse->json();
            $targetModel = '';

            if (isset($availableModels['models'])) {
                foreach ($availableModels['models'] as $m) {
                    if (str_contains($m['name'], 'gemini-1.5-flash')) {
                        $targetModel = $m['name'];
                        break;
                    }
                }
                if (!$targetModel && count($availableModels['models']) > 0) {
                    $targetModel = $availableModels['models'][0]['name'];
                }
            }

            if (!$targetModel) {
                throw new \Exception("Tidak ada model Gemini yang ditemukan.");
            }

            // LANGKAH 2: Kirim pertanyaan ke Gemini
            $url = "https://generativelanguage.googleapis.com/v1beta/{$targetModel}:generateContent?key=" . $apiKey;

            $systemInstruction = "Kamu adalah Guide Anambas AI, pakar pariwisata Kepulauan Anambas. " .
                                "DATA INTERNAL KAMI: $destinasiString. " .
                                "\n\nATURAN MENJAWAB:" .
                                "\n1. Gunakan pengetahuan luasmu untuk menjawab pertanyaan umum seputar Anambas (sejarah, cuaca, cara transportasi, dll) meskipun tidak ada di DATA INTERNAL." .
                                "\n2. Jika kamu membahas tempat atau makanan yang terdaftar di DATA INTERNAL, kamu WAJIB menyertakan tag [IMG:nama_file_lengkap] di akhir jawabanmu." .
                                "\n3. Ambil 'nama_file_lengkap' PERSIS dari field FILE_GAMBAR (contoh: [IMG:mie-tarempa.webp])." .
                                "\n4. Jika tempat tersebut tidak punya data FILE_GAMBAR atau tidak ada di DATA INTERNAL, jangan sertakan tag [IMG:]." .
                                "\n5. Jawablah dengan ramah dan santai seperti pemandu wisata.";

            $response = Http::withOptions(['verify' => false])
                ->post($url, [
                    'contents' => [
                        ['parts' => [['text' => "$systemInstruction \n\n Pertanyaan User: $userQuestion"]]]
                    ]
                ]);

            if ($response->successful()) {
                $result = $response->json();
                $botResponse = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya sedang kehilangan sinyal di Anambas.';

                // --- FIX BINTANG (BOLD) ---
                // Mengubah format **teks** menjadi <b>teks</b>
                $botResponse = preg_replace('/\*\*(.*?)\*\*/', '<b>$1</b>', $botResponse);

                // --- LOGIKA PARSING GAMBAR ---
                $imagePath = null;
                if (preg_match('/\[IMG:(.*?)\]/', $botResponse, $matches)) {
                    $imagePath = trim($matches[1]);
                    // Hapus tag agar tidak mengganggu tampilan teks chat
                    $botResponse = str_replace($matches[0], '', $botResponse);
                }

                $this->chatHistory[] = [
                    'role' => 'bot', 
                    'content' => $botResponse,
                    'image' => $imagePath
                ];

                $this->dispatch('scroll-to-bottom');

            } else {
                $this->chatHistory[] = ['role' => 'bot', 'content' => "Gagal terhubung ke AI. Coba lagi ya!"];
            }

        } catch (\Exception $e) {
            $this->chatHistory[] = ['role' => 'bot', 'content' => "Sistem sedang sibuk. Silakan coba lagi nanti."];
        }
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}