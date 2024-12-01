@extends('layouts.pupukAdminNav')

@section('main-content')
    <h1 class="text-center mb-4 mt-3">REGISTER USER</h1>
    <div class="container2" style="background-color: white; border-radius: 30px; margin: 0 auto; max-width: 800px; padding: 30px;">
        @if(session('success'))
            <div id="success-alert" class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('pupuk.store-staff') }}" class="p-4">
            @csrf
            <div class="row mb-4">
                <label for="ic" class="col-md-4 col-form-label text-md-end">{{ __('IC Number') }}</label>
                <div class="col-md-6">
                    <input id="ic" type="text" class="form-control @error('ic') is-invalid @enderror"
                        name="ic" value="{{ old('ic') }}" required autocomplete="ic" autofocus>
                    @error('ic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>
                <div class="col-md-6">
                    <select id="gender" class="form-select @error('gender') is-invalid @enderror"
                        name="gender" required>
                        <option value="" hidden selected>Select Gender</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <label for="contact" class="col-md-4 col-form-label text-md-end">{{ __('Contact') }}</label>
                <div class="col-md-6">
                    <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror"
                        name="contact" value="{{ old('contact') }}" required autocomplete="contact">
                    @error('contact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role Type') }}</label>
                <div class="col-md-6">
                    <select id="role" class="form-select @error('role') is-invalid @enderror"
                        name="role" required>
                        <option value="" hidden selected>Select Role</option>
                        <option value="pupuk-admin">Pupuk Admin</option>
                        <option value="user">Kiosk Participant</option>
                    </select>
                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary px-4">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#success-alert").fadeOut("slow");
            }, 5000);
        });
    </script>
@endsection
