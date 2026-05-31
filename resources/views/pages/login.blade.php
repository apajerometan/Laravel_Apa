@extends('layouts.auth')

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="auth-card">
            <h2>Login</h2>
            
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="loginEmail" 
                           placeholder="Enter email address" required>
                </div>

                <div class="mb-3">
                    <label for="loginPass" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="loginPass" 
                           placeholder="Enter password" required>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            
            <p class="auth-links">No account yet? <a href="{{ route('register') }}">Register here</a></p>
        </div>
    </div>
</section>
@endsection