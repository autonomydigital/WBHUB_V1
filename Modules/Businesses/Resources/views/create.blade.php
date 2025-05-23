@extends('layouts.master')

@section('title', 'Create Business')

@section('content')
    <form action="{{ route('businesses.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-lg-6">

                <div class="mb-3">
                    <label class="form-label">Business Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Street</label>
                    <input type="text" name="street" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Suburb</label>
                    <input type="text" name="suburb" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Postcode</label>
                    <input type="text" name="postcode" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="Australia">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Create</button>
                    <a href="{{ route('businesses.index') }}" class="btn btn-light">Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection