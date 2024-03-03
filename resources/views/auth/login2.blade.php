@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 my-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form2Example1" name="email" class="form-control" />
                        <label class="form-label"  for="form2Example1">Email address</label>
                    </div>
    
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="form2Example2" name="password" class="form-control" />
                        <label class="form-label"  for="form2Example2">Password</label>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                </form>
            </div>
            
        </div>
    </div>
@endsection
