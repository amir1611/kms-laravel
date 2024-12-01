@extends('layouts.pupukAdminNav')

@section('main-content')
    <!--USER PROFILE -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h4 class="font-weight-bold">User Profile</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pupuk.update', [auth()->id()]) }}" method="post">
                    @method('PUT')
                    @csrf

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label">IC Number</label>
                        <div class="col-md-8">
                            <p class="form-control-plaintext">{{ Auth::guard('web')->user()->ic }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label">Name</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="name" id="name"
                                value="{{ strtoupper(Auth::guard('web')->user()->name) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="gender" class="col-md-4 col-form-label">Gender</label>
                        <div class="col-md-8">
                            <select class="form-control" name="gender" id="gender">
                                <option value="male" {{ Auth::guard('web')->user()->gender === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ Auth::guard('web')->user()->gender === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="contact" class="col-md-4 col-form-label">Phone Number</label>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="contact" id="contact"
                                value="{{ Auth::guard('web')->user()->contact }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label">Email</label>
                        <div class="col-md-8">
                            <input class="form-control" type="email" name="email" id="email"
                                value="{{ Auth::guard('web')->user()->email }}">
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Confirm to update profile?')">Edit Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CHANGE PASSWORD -->
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h4 class="font-weight-bold">Change Password</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pupuk.update-password-staff') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <label for="oldPasswordInput" class="col-md-4 col-form-label">Old Password</label>
                        <div class="col-md-8">
                            <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror"
                                id="oldPasswordInput" placeholder="Old Password">
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="newPasswordInput" class="col-md-4 col-form-label">New Password</label>
                        <div class="col-md-8">
                            <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror"
                                id="newPasswordInput" placeholder="New Password">
                            @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="confirmNewPasswordInput" class="col-md-4 col-form-label">Confirm New Password</label>
                        <div class="col-md-8">
                            <input name="new_password_confirmation" type="password" class="form-control"
                                id="confirmNewPasswordInput" placeholder="Confirm New Password">
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Confirm to change password?')">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
