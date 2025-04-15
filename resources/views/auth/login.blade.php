@extends('auth.layouts.app')
@section('page-title', 'Log In')
@section('auth-body')
    <p class="text-center mb-4">{{ __('Log in to start your session') }}</p>

    <form id="loginForm" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">{{ __('Email') }}</label>
            <div class="input-group">
                <input type="email" name="email" class="form-control" placeholder="{{ __('Email') }}" required autofocus>
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Password') }}</label>
            <div class="input-group">
                <input type="password" name="password" id="passwordField" class="form-control" placeholder="{{ __('Password') }}" required>
                <span class="input-group-text"><i class="fas fa-lock toggle-password" style="cursor: pointer;"></i></span>
            </div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">{{ __('Remember me') }}</label>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">{{ __('Log In') }}</button>
        </div>
    </form>
@endsection
