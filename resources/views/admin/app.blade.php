<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Complaint Management')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .wrapper {
            flex: 1;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
            height: 100vh;
        }
        .content {
            flex: 1;
            padding: 20px;
        }

        .card-hover {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card-hover:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .action-btn[data-disabled="true"] {
            pointer-events: none;
            cursor: not-allowed !important;
        }

        .dropdown-menu[data-bs-popper] {
            left: -86px !important;
        }

    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Complaint System</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="mx-3 user-panel dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user" style="color: white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <a href="{{url('/profile')}}" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <a href="{{url('/logout')}}" class="dropdown-item" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-lock mr-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{url('/logout')}}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>

                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Wrapper -->
<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar border-end">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{url("/admin/complaints")}}">Complaints</a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="{{url("/admin/complaint-types")}}">Complaint Types</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url("/admin/complaint-logs")}}">Complaint Logs</a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        @yield("content")
    </div>
</div>

<!-- Footer -->
<footer class="bg-light text-center py-3 mt-auto border-top">
    <small>&copy; {{ date('Y') }} Complaint Management System</small>
</footer>

<!-- Bootstrap JS (optional for interactivity) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')

</body>
</html>
