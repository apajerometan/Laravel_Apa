@extends('layouts.auth')

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="auth-card">
            <h2>Register</h2>
            
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="fullname" id="fullName" 
                           placeholder="Enter full name" required>
                </div>

                <div class="mb-3">
                    <label for="regEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="regEmail" 
                           placeholder="Enter email address" required>
                </div>

                <div class="mb-3">
                    <label for="regPass" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="regPass" 
                           placeholder="Enter password" required>
                </div>

                <div class="mb-3">
                    <label for="confirmPass" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirmpassword" id="confirmPass" 
                           placeholder="Confirm password" required>
                </div>

                <button type="submit" class="btn btn-primary">Create Account</button>
            </form>
            
            <p class="auth-links">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </div>
</section>
@endsection