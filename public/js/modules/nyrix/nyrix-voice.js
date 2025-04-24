// nyrix-voice.js

if (typeof window.NyrixVoice === 'undefined') {
    window.NyrixVoice = (function () {
        
        function startNyrixPulse() {
    speaking = true;
}

function stopNyrixPulse() {
    speaking = false;
}

const NyrixVoice = (function () {
    let synth = window.speechSynthesis;
    let selectedVoice = null;
    let currentUtterance = null;

    const state = {
        tone: 'calm', // calm, intense, playful
        whisper: false,
        energySync: true,
        speaking: false
    };

    function init() {
        const voices = synth.getVoices();

        // Fallback if voices aren't loaded immediately
        if (!voices.length) {
            synth.onvoiceschanged = () => {
                selectVoice(synth.getVoices());
            };
        } else {
            selectVoice(voices);
        }
    }

    function selectVoice(voices) {
        // Preference: natural female voice
        selectedVoice = voices.find(v =>
            v.name.toLowerCase().includes('samantha') ||
            v.name.toLowerCase().includes('zira') ||
            v.name.toLowerCase().includes('google us english') ||
            v.gender === 'female'
        ) || voices[0];
    }

    function speak(text) {
        if (!synth || !text) return;

        if (state.speaking) {
            synth.cancel();
        }

        const utterance = new SpeechSynthesisUtterance(text);
        currentUtterance = utterance;

        utterance.voice = selectedVoice;
        utterance.pitch = getPitch();
        utterance.rate = getRate();
        utterance.volume = state.whisper ? 0.3 : 1;

        utterance.onstart = () => {
            state.speaking = true;
            if (state.energySync && typeof onVoiceStart === 'function') onVoiceStart();
        };

        utterance.onend = () => {
            state.speaking = false;
            if (state.energySync && typeof onVoiceEnd === 'function') onVoiceEnd();
        };

        synth.speak(utterance);
    }

    function getPitch() {
        switch (state.tone) {
            case 'intense': return 1.2;
            case 'playful': return 1.5;
            case 'calm':
            default: return 1.0;
        }
    }

    function getRate() {
        switch (state.tone) {
            case 'intense': return 1.3;
            case 'playful': return 1.1;
            case 'calm':
            default: return 0.95;
        }
    }

    function setTone(tone) {
        state.tone = tone;
    }

    function toggleWhisper(enabled) {
        state.whisper = enabled;
    }

    function toggleEnergySync(enabled) {
        state.energySync = enabled;
    }

    // Optional: hook these up externally
    let onVoiceStart = null;
    let onVoiceEnd = null;

    return {
        init,
        speak,
        setTone,
        toggleWhisper,
        toggleEnergySync,
        setOnVoiceStart: cb => onVoiceStart = cb,
        setOnVoiceEnd: cb => onVoiceEnd = cb,
        isSpeaking: () => state.speaking,
        getVoice: () => selectedVoice
    };
})();

// Initialize on load
window.addEventListener('DOMContentLoaded', () => {
    NyrixVoice.init();
});

})();
}