@extends('layouts.userNav')

@section('main-content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h4 class="font-weight-bold">User Profile</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', [auth()->user()->id]) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="ic" class="form-label">IC Number</label>
                        <input type="text" class="form-control" id="ic" value="{{ Auth::guard('web')->user()->ic }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ strtoupper(Auth::guard('web')->user()->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender">
                            <option value="male" {{ Auth::guard('web')->user()->gender === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ Auth::guard('web')->user()->gender === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="contact" id="contact" value="{{ Auth::guard('web')->user()->contact }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ Auth::guard('web')->user()->email }}">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Confirm to update profile?')">Edit Profile</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-header text-center">
                <h4 class="font-weight-bold">Change Password</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update-password-user') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="oldPasswordInput" class="form-label">Old Password</label>
                        <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput" placeholder="Old Password">
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="newPasswordInput" class="form-label">New Password</label>
                        <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput" placeholder="New Password">
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                        <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput" placeholder="Confirm New Password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirm to change password?')">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
