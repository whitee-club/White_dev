@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$alert}} </div>

                <div class="card-body">
                    <form method="POST" action="{{route('report.answerReport', $confession->id )}}">
                        @csrf

                        <div class="form-group row">
                           <label>
                             {{ $confession->answer}}</label>

                            <div class="col-md-6">
                                <input id="reason" type="text" 
                                class="form-control @error('reason') is-invalid @enderror" 
                                name="reason" value="{{ old('reason') }}" required autocomplete="reason" autofocus>

                                @error('reason')
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
