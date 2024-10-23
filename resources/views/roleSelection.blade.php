@extends('main')

@section('title', 'Dashboard')

@section('page')

<div class="container">
    <h2>Select Your Role</h2>
    <form action="{{ route('selectRole.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="role">Choose Role:</label>
            <select name="role_id" id="role" class="form-control" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Proceed</button>
    </form>
</div>
@endsection