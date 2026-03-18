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

        $destinasi = Destination::all()->map(function($item) {
            return "Wisata: {$item->name}, Info: {$item->description}";
        })->implode(" | ");

        $this->chatHistory[] = ['role' => 'user', 'content' => $this->message];
        $userQuestion = $this->message;
        $this->message = '';

        try {
            $apiKey = env('GEMINI_API_KEY');

            /**
             * LANGKAH 1: Ambil daftar model yang tersedia untuk KEY kamu.
             * Ini akan menjawab teka-teki "Model mana yang aktif?".
             */
            $listResponse = Http::withOptions(['verify' => false])
                ->get("https://generativelanguage.googleapis.com/v1beta/models?key=" . $apiKey);

            $availableModels = $listResponse->json();
            $targetModel = '';

            // Cari model yang mendukung 'generateContent'
            if (isset($availableModels['models'])) {
                foreach ($availableModels['models'] as $m) {
                    // Kita prioritaskan gemini-1.5-flash
                    if (str_contains($m['name'], 'gemini-1.5-flash')) {
                        $targetModel = $m['name'];
                        break;
                    }
                }
                // Jika tidak ada flash, ambil model pertama yang ada
                if (!$targetModel && count($availableModels['models']) > 0) {
                    $targetModel = $availableModels['models'][0]['name'];
                }
            }

            if (!$targetModel) {
                throw new \Exception("Tidak ada model Gemini yang ditemukan di akun ini.");
            }

            /**
             * LANGKAH 2: Kirim pertanyaan ke model yang sudah ditemukan.
             */
            $url = "https://generativelanguage.googleapis.com/v1beta/{$targetModel}:generateContent?key=" . $apiKey;

            $response = Http::withOptions(['verify' => false])
                ->post($url, [
                    'contents' => [
                        ['parts' => [['text' => "Kamu Guide Anambas. Data: $destinasi. Pertanyaan: $userQuestion"]]]
                    ]
                ]);

            if ($response->successful()) {
                $result = $response->json();
                $botResponse = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'AI tidak merespon.';
                $this->chatHistory[] = ['role' => 'bot', 'content' => $botResponse];
            } else {
                $this->chatHistory[] = ['role' => 'bot', 'content' => "Gagal kirim: " . $response->body()];
            }

        } catch (\Exception $e) {
            $this->chatHistory[] = ['role' => 'bot', 'content' => "Error Sistem: " . $e->getMessage()];
        }
    }

    public function render()
    {
        return view('livewire.chatbot');
    }
}