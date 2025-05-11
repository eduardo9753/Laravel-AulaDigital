<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ChatBot extends Component
{
    public $userMessage = '';
    public $chatHistory = [];

    public function sendMessage()
    {
        if (trim($this->userMessage) === '') return;

        $this->chatHistory[] = ['role' => 'user', 'content' => $this->userMessage];

        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => $this->chatHistory,
        ]);

        // Debug completo de respuesta
        if (!$response->successful()) {
            dd($response->status(), $response->body());
        }

        $reply = $response['choices'][0]['message']['content'] ?? 'Error al obtener respuesta.';
        $this->chatHistory[] = ['role' => 'assistant', 'content' => $reply];
        $this->userMessage = '';
    }


    public function render()
    {
        return view('livewire.chat-bot');
    }
}
