@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-md-center">{{ __('Profile') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-12 col-form-label text-md-start">{{ __('Name') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control" name="name"
                                value="{{ Auth::user()->name }}" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-12 col-form-label text-md-start">{{ __('Email') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control" name="email"
                                value="{{ Auth::user()->email }}" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="gender" class="col-md-12 col-form-label text-md-start">{{ __('Gender') }}</label>

                        <div class="col-md-12">
                            <input id="gender" type="gender" class="form-control" name="gender"
                                value="{{ Auth::user()->gender }}" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for=dateofbirth"
                            class="col-md-12 col-form-label text-md-start">{{ __('Date of Birth') }}</label>

                        <div class="col-md-12">
                            <input id="dateofbirth" type="dateofbirth" class="form-control" name="dateofbirth"
                                value="{{ Auth::user()->dateofbirth }}" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="country" class="col-md-12 col-form-label text-md-start">{{ __('Country') }}</label>

                        <div class="col-md-12">
                            <input id="country" type="country" class="form-control" name="country"
                                value="{{ Auth::user()->country }}" disabled>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
