@extends('layouts.AdminLTE')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header"><h2>Health Officer Registration</h2></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="healthOfficer_name" class="col-md-4 col-form-label text-md-right">{{ __('Health Officer Name') }}</label>

                            <div class="col-md-6">
                                <input id="healthOfficer_name" type="text" class="form-control @error('healthOfficer_name') is-invalid @enderror" name="healthOfficer_name" value="{{ old('healthOfficer_name') }}" required autocomplete="healthOfficer_name" autofocus>

                                @error('healthOfficer_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hospitalGiven" class="col-md-4 col-form-label text-md-right">{{ __('Hospital Allocated') }}</label>

                            <div class="col-md-6">
                                <!--<input id="hospitalGiven" type="text" class="form-control @error('hospitalGiven') is-invalid @enderror" name="hospitalGiven" value="{{ old('hospitalGiven') }}" required autocomplete="hospitalGiven">-->
                                <select id="hospitalGiven" type="text" class="form-control select2 @error('hospitalGiven') is-invalid @enderror" name="hospitalGiven" value="{{ old('hospitalGiven') }}" required autocomplete="hospitalGiven" style="width: 100%;">
                                    <option selected="selected">Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                                @error('hospitalGiven')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="officerUsername" class="col-md-4 col-form-label text-md-right">{{ __('Officer Username') }}</label>

                            <div class="col-md-6">
                                <input id="officerUsername" type="text" class="form-control @error('officerUsername') is-invalid @enderror" name="officerUsername" required autocomplete="username" autofocus>

                                @error('officerUsername')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="registrationDate" class="col-md-4 col-form-label text-md-right">{{ __('Registration Date') }}</label>

                            <div class="col-md-6">
                                <input id="registrationDate" type="date" class="form-control @error('registrationDate') is-invalid @enderror" name="registrationDate" required autocomplete="new-registrationDate">

                                @error('registrationDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input id="gender" type="radio" class="form-check-input" name="gender" value="{{ old('gender') }}" checked>
                                    <label class="form-check-label" for="male">M</label>                                                                
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="gender" type="radio" class="form-check-input" name="gender" value="{{ old('gender') }}" >
                                    <label class="form-check-label" for="female">F</label>
                                </div> 
                            </div>                                             
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
