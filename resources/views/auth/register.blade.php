@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-md-center">{{ __('Register') }}</div>

                <div class="card-body px-md-5 py-md-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-12 col-form-label text-md-start">
                                {{ __('Name') }}
                            </label>

                            <div class="col-md-12">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Enter Your Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-12 col-form-label text-md-start">
                                {{ __('Email Address') }}
                            </label>

                            <div class="col-md-12">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Enter Your Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-12 col-form-label text-md-start">
                                {{ __('Password') }}
                            </label>

                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password" placeholder="Enter Your Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-12 col-form-label text-md-start">
                                {{ __('Confirm Password') }}
                            </label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Re-type Your Password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-12 col-form-label text-md-start">
                                {{ __('Gender') }}
                            </label>

                            <div>
                                <div>
                                    <input type="radio" class="form-check-input @error('gender') is-invalid @enderror"
                                        id="male" name="gender" value="Male"
                                        {{ old('gender') == 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>

                                <div>
                                    <input type="radio" class="form-check-input @error('gender') is-invalid @enderror"
                                        id="female" name="gender" value="Female"
                                        {{ old('gender') == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label for="dateofbirth" class="col-md-12 col-form-label text-md-start">
                                {{ __('Date of Birth') }}
                            </label>

                            <div class="col-md-12">
                                <input type="date" name="dateofbirth" id="dateofbirth"
                                    class="form-control @error('dateofbirth') is-invalid @enderror" required
                                    autocomplete="dateofbirth" value="{{ old('dateofbirth') }}">

                                @error('dateofbirth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="country" class="col-md-12 col-form-label text-md-start">
                                {{ __('Country') }}
                            </label>

                            <div class="col-md-12">
                                <select name="country" id="country"
                                    class="form-control form-select @error('country') is-invalid @enderror" required>
                                    <option selected disabled>Choose a Country </option>
                                    @foreach ($countries as $countryId => $countryValue)
                                        <option value={{ $countryValue }}
                                            {{ old('country') == $countryValue ? 'selected' : '' }}>
                                            {{ $countryValue }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="text-md-center col-md-12">
                                <button type="submit" class="btn btn-outline-primary w-100">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
