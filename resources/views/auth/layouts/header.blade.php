<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | @yield('page-title')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .login-logo h1 {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="card shadow-sm" style="width: 400px;">
        <div class="card-body">
            <div class="login-logo text-center mb-3">
                <h1>{{ __('Complaint') }} <strong>{{ __('MS') }}</strong></h1>
            </div>
