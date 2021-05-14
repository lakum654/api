@extends('layouts.app')

@section('content')
<div class="container w-50 justify-content-lg-center bg-white">
               <div class="row">
                   <div class="col">                   
                       <h3 class="py-3">Login With Credentials</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                                
                           <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                           </div>
                                
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                          </div>                         
                        </form>
                   </div>

                   
                   <div class="col">
                       <h3 class="py-3">Login With Social</h3>
                  <div class="form-group">
                    <a href="{{ url('auth/google') }}" class="btn btn-md btn-danger btn-block">
                        <strong>Login With Google</strong>
                      </a> 
                  </div>
                  <div class="form-group">
                    <a href="{{ url('auth/facebook') }}" class="btn btn-md btn-info btn-block">
                        <strong>Login With Facebook</strong>
                      </a> 
                  </div>                  
                      
                  <div class="form-group">
                    <a href="{{ url('auth/github') }}" class="btn btn-md btn-success btn-block">
                        <strong>Login With Github</strong>
                      </a> 
                  </div>  
                  </div>
                   </div>
               
               </div>  
</div>
@endsection
