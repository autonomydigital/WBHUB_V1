@extends('layouts.master') {{-- or whatever your main layout is --}}
@section('title') Nyrix AI @endsection

@section('content')
<div class="row" data-masonry='{"percentPosition": true }'>

    

    <video autoplay muted loop playsinline id="nyrix-bg-video" style="
    position: fixed;
    top: 0;
    left: 0;
    min-width: 100%;
    min-height: 100%;
    object-fit: cover;
    z-index: -1;
">
    <source src="{{ asset('videos/nyrix-bg.mp4') }}" type="video/mp4">
</video>

<!-- 🔥 Add this overlay div right after -->
<div id="nyrix-bg-overlay" style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7); /* 👈 adjust opacity as needed */
    z-index: 0;
    pointer-events: none; /* ensures it doesn’t interfere with clicks */
"></div>
    <!-- Left Panel: Ask Nyrix + Chat History -->
    <div class="col-xl-6 col-lg-8">

        <div class="col-xl-12">
            <div class="row">
                <!-- Logo Card -->
                <div class="col-md-6 mb-4">
                    <div class="card text-center border-0 bg-transparent">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center p-3" style="backdrop-filter: blur(6px); background-color: rgba(0,0,0,0.3); border-radius: 1rem;">
                            <img src="{{ asset('images/nyrix-logo.png') }}" alt="Nyrix Logo" class="img-fluid">
                        </div>
                    </div>
                </div>

            <!-- Nyrix Rotary Lock Card -->
<div class="card bg-dark text-white border-danger" style="position: relative; overflow: hidden;">
   
    <div class="card-body text-center">
      <!-- Dial Container -->
      <div id="nyrix-dial-wrapper" style="position: relative; width: 200px; height: 200px; margin: auto;">
        <img src="/images/nyrix-lock/dial-base.png" draggable="false" alt="Dial Base" style="position: absolute; top: 0; left: 0; width: 100%;">
        <img id="nyrix-dial" src="/images/nyrix-lock/dial-overlay.png" alt="Dial Overlay" style="position: absolute; top: 0; left: 0; width: 100%; transform: rotate(0deg); transform-origin: center center; cursor: grab;" draggable="false">
        {{-- <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;">
          <div style="position: absolute; top: 10px; left: 50%; transform: translateX(-50%); width: 4px; height: 20px; background: red;"></div>
        </div> --}}
      </div>
      <div id="dial-combo-display" style="margin-top: 1rem; font-size: 1.2rem; color: #fff;">
        🔐 <span id="combo-numbers">LIVE: -- | Combo: -- -- --</span>
      </div>
      <p class="mt-3 small">Enter the 3-number combination to disable Nyrix.</p>
      <button id="disable-nyrix-button" class="btn btn-danger mt-2" style="display: none;">🛑 Disable Nyrix</button>
    </div>
  </div>
        
                <!-- Admin Tools Card -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">🛠️ Admin Tools</h5>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('nyrix.toggle') }}" class="btn btn-outline-warning w-100 mb-2">
                                🔁 Toggle Nyrix
                            </a>
                            <form method="POST" action="{{ route('nyrix.toggle') }}">
                                @csrf
                                <input type="hidden" name="enabled" value="{{ config('nyrix.enabled') ? '' : '1' }}">
                                <button type="submit" class="btn btn-outline-{{ config('nyrix.enabled') ? 'danger' : 'success' }} w-100">
                                    {{ config('nyrix.enabled') ? 'Disable Nyrix' : 'Enable Nyrix' }}
                                </button>
                            </form>
                            <hr>
                            <button class="btn btn-light w-100" onclick="clearHistory()">🧹 Clear History</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="card">
            <div class="card-header bg-soft-dark">
                <h5 class="mb-0">🧠 Nyrix Command Console</h5>
            </div>
            <div class="card-body">
                <form id="nyrix-form">
                    @csrf
                    <label class="form-label">Execute Command</label>
                    <div class="input-group mb-3">
                        <input type="text" name="command" class="form-control" id="command-input" placeholder="e.g. clear_cache" required>
                        <button class="btn btn-dark" type="submit">Execute</button>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-secondary" onclick="runPresetCommand('clear_cache')">🧹 Clear Cache</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="runPresetCommand('view_clear')">🖼️ Clear Views</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="runPresetCommand('migrate')">📦 Migrate DB</button>
                        <button type="button" class="btn btn-outline-warning" onclick="runPresetCommand('refresh_system')">🔄 Refresh System</button>
                        <button type="button" class="btn btn-outline-secondary" onclick="runPresetCommand('route_clear')">🧭 Clear Routes</button>
                        <button type="button" class="btn btn-outline-danger" onclick="runPresetCommand('nuke')">💣 Nuclear Clear</button>
                    </div>

                    <hr class="my-4">

                    <div class="card border shadow-sm">
                        <div class="card-header bg-soft-secondary" data-bs-toggle="collapse" data-bs-target="#advancedActions" role="button">
                            <h6 class="mb-0 text-uppercase">⚙️ Advanced Actions</h6>
                        </div>
                        <div class="collapse" id="advancedActions">
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-dark w-100" onclick="runPresetCommand('config_cache')">🗂️ Cache Config</button>
                                        <small class="text-muted d-block mt-1">Precompile and cache Laravel config files for speed.</small>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-dark w-100" onclick="runPresetCommand('optimize')">🚀 Optimize</button>
                                        <small class="text-muted d-block mt-1">Recompile route/config/view caches for production.</small>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-dark w-100" onclick="runPresetCommand('queue_restart')">🔁 Restart Queues</button>
                                        <small class="text-muted d-block mt-1">Restart all queue workers (after deploys).</small>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-dark w-100" onclick="runPresetCommand('schedule_run')">⏰ Run Scheduled Tasks</button>
                                        <small class="text-muted d-block mt-1">Manually trigger scheduled events (cron).</small>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-warning w-100" onclick="runPresetCommand('down_mode')">🛑 Maintenance Mode</button>
                                        <small class="text-muted d-block mt-1">Take the app offline temporarily.</small>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-success w-100" onclick="runPresetCommand('up_mode')">✅ Resume App</button>
                                        <small class="text-muted d-block mt-1">Bring the app back online after maintenance.</small>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-info w-100" onclick="runPresetCommand('list_routes')">🧭 Show Routes</button>
                                        <small class="text-muted d-block mt-1">List all current routes in the app.</small>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-info w-100" onclick="runPresetCommand('list_users')">👥 List Users</button>
                                        <small class="text-muted d-block mt-1">Show a list of registered user emails.</small>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-info w-100" onclick="runPresetCommand('dump_env')">🌐 Show Env</button>
                                        <small class="text-muted d-block mt-1">View current Laravel environment variables.</small>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-primary w-100" onclick="runPresetCommand('log_test')">🧪 Test Log</button>
                                        <small class="text-muted d-block mt-1">Write a test log line to the Laravel log file.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="mt-4">
                    <h6>Output:</h6>
                    <pre id="nyrix-output" class="bg-light p-3 rounded border" style="min-height: 100px;"></pre>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Center Panel: Main Chat + Command Console -->
    <div class="col-xl-6 col-lg-8">
        <div class="card transparent" id="nyrix-energy-card">
           
            <div class="card-body text-center">
                <div id="nyrix-energy-wrapper" style="position: relative; width: 100%;">
                    <video id="nyrix-video" autoplay muted playsinline loop style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    z-index: 1;
                "></video>
                    <canvas id="nyrix-energy-canvas" width="1280" height="720" style="display: block; position: absolute; top: 0; left: 0; z-index: 5;"></canvas>                        <canvas id="nyrix-energy-canvas" style="display:block;"></canvas>
                      </div>                </div>                                
            </div>
        </div>
        

        <div class="card mb-4">
            <div class="card-header bg-soft-primary">
                <h5 class="mb-0">🤖 Ask Nyrix</h5>
            </div>
            <div class="card-body">
                @if(session('response'))
                    <div class="alert alert-secondary">
                        <strong>Nyrix:</strong> {{ session('response') }}
                    </div>
                @endif

                @if(session('message'))
                <div class="alert alert-secondary">
                    💬 <strong>Nyrix:</strong> {{ session('message') }}
                </div>
            @endif
            
            @if(session('ai_command'))
                <div class="alert alert-info">
                    <strong>🧠 Suggested Command:</strong><br>
                    <code>{{ session('ai_command') }}</code><br>
                    <small>{{ session('explanation') }}</small><br>
                    <button class="btn btn-sm btn-outline-primary mt-2"
                        onclick="runCommand(@js(session('ai_command')))">Run this command</button>
                </div>
            @endif
               
                @if(isset($error))
                    <div class="alert alert-danger">{{ $error }}</div>
                @endif

                <form method="POST" action="{{ route('nyrix.ask') }}" id="ask-nyrix-form">                    @csrf
                    <div class="mb-3">
                        <label for="prompt" class="form-label">Your Prompt</label>
                        <textarea name="prompt" id="prompt" rows="4" class="form-control" placeholder="Ask anything..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
                <div id="nyrix-suggestion" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="nyrixConfirmModal" tabindex="-1" aria-labelledby="nyrixConfirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="nyrixConfirmLabel">⚠️ Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="nyrixConfirmText">Are you sure you want to do this?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="nyrixConfirmBtn">Yes, do it</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')

<script>
window.nyrixExecuteUrl = window.nyrixExecuteUrl || "{{ route('nyrix.execute') }}";
window.pendingCommand = window.pendingCommand || null;

function runPresetCommand(command) {
    const risky = ['nuke', 'migrate', 'down_mode', 'up_mode'];
    if (risky.includes(command)) {
        showConfirm(command);
    } else {
        runCommand(command);
    }
}

function runCommand(command) {
    document.getElementById('command-input').value = command;
    document.getElementById('nyrix-form').dispatchEvent(new Event('submit'));
}

function showConfirm(command) {
    pendingCommand = command;
    const messages = {
        nuke: "This will clear all caches and compiled files. Are you absolutely sure?",
        migrate: "This will apply database migrations. Make sure backups exist.",
        down_mode: "This will take the site offline. Continue?",
        up_mode: "This will bring the site back online. Confirm?",
    };
    document.getElementById('nyrixConfirmText').textContent = messages[command] || "Are you sure?";
    new bootstrap.Modal(document.getElementById('nyrixConfirmModal')).show();
}

document.getElementById('nyrixConfirmBtn')?.addEventListener('click', function () {
    if (pendingCommand) {
        runCommand(pendingCommand);
        pendingCommand = null;
        bootstrap.Modal.getInstance(document.getElementById('nyrixConfirmModal')).hide();
    }
});

document.getElementById('nyrix-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const input = document.getElementById('command-input');
    const command = input.value.trim();

    if (!command) {
        document.getElementById('nyrix-output').textContent = "⚠️ No command entered.";
        return;
    }

    fetch(nyrixExecuteUrl, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ command })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('nyrix-output').textContent = data.output || "✅ Command executed.";
    })
    .catch(err => {
        document.getElementById('nyrix-output').textContent = "Error: " + err;
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('ask-nyrix-form');
    const box = document.getElementById('nyrix-suggestion');

    if (!form) return;

    // Prevent multiple listeners
    form.onsubmit = async function (e) {
        e.preventDefault();

        const prompt = form.prompt.value.trim();
        if (!prompt) return;

        // Stop any current speech
        window.speechSynthesis.cancel();

        box.innerHTML = `<div class="alert alert-info">⏳ Thinking...</div>`;

        try {
            const res = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ prompt })
            });

            const data = await res.json();
            box.innerHTML = ''; // Clear old content

            if (data.error) {
                box.innerHTML = `<div class='alert alert-danger'>${data.error}</div>`;
                return;
            }

            const wrapper = document.createElement('div');
            wrapper.className = 'alert alert-info';

            if (data.command) {
    wrapper.innerHTML = `
                    <strong>🧠 Nyrix Suggests:</strong><br>
                    <code>${data.command}</code><br>
                    <small>${data.explanation || 'No explanation provided.'}</small><br>
                `;

                const button = document.createElement('button');
                button.className = 'btn btn-sm btn-outline-primary mt-2';
                button.textContent = 'Run this command';
                button.addEventListener('click', () => runCommand(data.command));
                wrapper.appendChild(button);
            } else {
                wrapper.innerHTML = `
                    <strong>🧠 Nyrix Says:</strong><br>
                    <p>${data.message}</p>
                `;
            }

            // const button = document.createElement('button');
            // button.className = 'btn btn-sm btn-outline-primary mt-2';
            // button.textContent = 'Run this command';
            // button.addEventListener('click', () => runCommand(data.command));
            // wrapper.appendChild(button);

            box.appendChild(wrapper);

            // 🔊 Speak response
            speak(data.explanation || data.message);

        } catch (err) {
            console.error('Ask Nyrix error:', err);
            box.innerHTML = `<div class='alert alert-danger'>Error: ${err}</div>`;
        }
    };
});

function clearHistory() {
    const list = document.getElementById('chat-history');
    list.innerHTML = '';
}

function speak(text) {
    if (!('speechSynthesis' in window)) {
        console.warn("🚫 Your browser doesn't support speech synthesis.");
        return;
    }

    const utterance = new SpeechSynthesisUtterance(text);
    const voices = speechSynthesis.getVoices();

    // 💃 Prioritized sassy / natural voices
    const preferredVoices = [
        'Karen',
        'Tessa',
        'Moira',
        'Microsoft Aria Online (Natural)',
        'Microsoft Jenny',
        'Microsoft Zira',
    ];

    const selected = voices.find(v =>
        preferredVoices.some(name => v.name.toLowerCase().includes(name.toLowerCase()))
    );

    if (selected) {
        utterance.voice = selected;
    }

    // 💅 Set the sass
    utterance.pitch = 1.05;      // Higher = more playful/animated
    utterance.rate = 1.05;       // Slightly fast, confident tone
    utterance.volume = 1.0;     // Full volume for maximum personality

    // Optional: animated energy ball or console log
    utterance.onstart = () => {
        console.log("🎤 Nyrix is speaking...");
        if (typeof startNyrixPulse === 'function') startNyrixPulse();
    };
    utterance.onend = () => {
        if (typeof stopNyrixPulse === 'function') stopNyrixPulse();
    };

    speechSynthesis.cancel(); // Stop any previous speech
    speechSynthesis.speak(utterance);
}
</script>
{{-- <script src="{{ asset('js/modules/nyrix/nyrix-energy.js') }}"></script> --}}
<script src="{{ asset('js/modules/nyrix/nyrix-voice.js') }}"></script>
<script src="{{ asset('js/modules/nyrix/nyrix-tracker.js') }}"></script>
@endsection
