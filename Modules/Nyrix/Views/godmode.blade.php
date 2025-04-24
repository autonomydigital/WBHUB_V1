@extends('layouts.master') {{-- Or whatever your layout is --}}

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h4 class="card-title mb-3">🧠 Nyrix AI Control Panel</h4>
            <p class="text-muted">Use this switch to enable or disable Nyrix globally.</p>

            <form method="POST" action="{{ route('nyrix.toggle.update') }}">
                @csrf
                <div class="form-check form-switch fs-4">
                    <input class="form-check-input" type="checkbox" name="enabled" value="1" id="nyrixSwitch"
                        {{ $enabled ? 'checked' : '' }} onchange="this.form.submit()">
                    <label class="form-check-label ms-2" for="nyrixSwitch">
                        Nyrix is <strong>{{ $enabled ? 'Enabled' : 'Disabled' }}</strong>
                    </label>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection