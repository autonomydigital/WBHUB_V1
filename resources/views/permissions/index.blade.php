@extends('layouts.master')
@section('title', 'Role Permissions')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Role Permissions</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('permissions.update') }}">
            @csrf

            <div class="mb-4">
                <label class="form-label">Select Role</label>
                <select name="role_id" class="form-select" onchange="this.form.submit()">
                    @foreach($roles as $roleOption)
                        <option value="{{ $roleOption->id }}" {{ $selected == $roleOption->id ? 'selected' : '' }}>
                            {{ ucfirst($roleOption->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                @foreach($permissions as $module => $modulePermissions)
                    <div class="col-md-4 mb-3">
                        <h6 class="text-uppercase">{{ ucfirst($module) }}</h6>
                        @foreach($modulePermissions as $permission)
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permissions[]"
                                    value="{{ $permission->name }}"
                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ Str::title(str_replace('_',' ',$permission->name)) }}</label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Save Permissions</button>
            </div>
        </form>
    </div>
</div>
@endsection