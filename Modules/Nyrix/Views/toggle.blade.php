@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2>Nyrix Toggle (God Mode)</h2>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form action="{{ route('nyrix.toggle.update') }}" method="POST">
        @csrf
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="nyrixSwitch" name="enabled" value="1" {{ $enabled ? 'checked' : '' }}>
            <label class="form-check-label" for="nyrixSwitch">Enable Nyrix AI</label>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>
</div>
@endsection