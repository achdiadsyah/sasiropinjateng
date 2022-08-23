@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                Admin Login
            </div>
            <div class="card-body">
                <form action="{{route('admin.doLogin')}}" method="POST">
                    @csrf

                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address...">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block" onClick="this.form.submit(); this.disabled=true; this.innerText ='Login Process'; ">Login</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection