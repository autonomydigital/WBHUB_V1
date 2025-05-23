@extends('layouts.master')

@section('title', 'Edit ' . $business->name)

@section('content')
    <form action="{{ route('businesses.update', $business) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Business Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $business->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $business->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Street</label>
                    <input type="text" name="street" class="form-control" value="{{ old('street', $business->street) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Suburb</label>
                    <input type="text" name="suburb" class="form-control" value="{{ old('suburb', $business->suburb) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control" value="{{ old('state', $business->state) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Postcode</label>
                    <input type="text" name="postcode" class="form-control" value="{{ old('postcode', $business->postcode) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="{{ old('country', $business->country ?? 'Australia') }}">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('businesses.show', $business) }}" class="btn btn-light">Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection