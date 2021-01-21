@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Report </div>

                <div class="card-body">
                	Reported By:- {{$reportedBy->name}}<br>
                	Reported To:- {{$reported_to->name}}<br>
                	Reason :- {{$rep->reason}}<br>
                    <!-- <form method="POST" action="/confessions/created/">
                        @csrf

                        <div class="form-group row">
                            <label for="confession" class="col-md-4 col-form-label text-md-right">{{ __('Your Confession') }}</label>

                            <div class="col-md-6">
                                <input id="confession" type="text" 
                                class="form-control @error('confession') is-invalid @enderror" 
                                name="confession" value="{{ old('confession') }}" required autocomplete="confession" autofocus>

                                @error('confession')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                      

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
