<div class="container-fluid py-3 d-flex flex-column vh-100">
    <h4 class="text-center mb-3">💬 ChatGPT Asistente</h4>

    <!-- Chat box -->
    <div class="flex-grow-1 overflow-auto border rounded p-3 bg-light" id="chatbox" style="max-height: 70vh;">
        @foreach ($chatHistory as $message)
            <div
                class="mb-2 d-flex @if ($message['role'] === 'user') justify-content-end @else justify-content-start @endif">
                <div class="p-2 rounded shadow-sm 
                    @if ($message['role'] === 'user') bg-primary text-white @else bg-white border @endif"
                    style="max-width: 90%; word-wrap: break-word;">
                    {{ $message['content'] }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Input -->
    <form wire:submit.prevent="sendMessage" class="mt-3 d-flex flex-column flex-sm-row gap-2">
        <input type="text" wire:model="userMessage" class="form-control" placeholder="Escribe tu mensaje..." />
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <!-- Scroll automático -->
    <script>
        Livewire.on('messageSent', () => {
            const chatbox = document.getElementById('chatbox');
            setTimeout(() => {
                chatbox.scrollTop = chatbox.scrollHeight;
            }, 100);
        });
    </script>
</div>
