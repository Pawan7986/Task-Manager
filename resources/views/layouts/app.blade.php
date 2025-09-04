<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>

        body {
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #4e73df;
            color: #fff;
            position: fixed;
        }
        .sidebar .user-info {
            padding: 20px;
            background: rgba(255,255,255,0.1);
            text-align: center;
            font-weight: bold;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
            padding-left: 25px;
        }

        /* Main content */
        .content {
            margin-left: 250px;
            padding: 30px;
        }

        @media(max-width:768px){
            .sidebar { position: relative; width: 100%; }
            .content { margin-left: 0; }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" style="width:250px; min-height:100vh; background:#1e1e2f; color:white; padding:20px;">

    <!-- Text Logo -->
    <div class="text-logo mb-3 text-center" style="font-weight:bold; font-size:18px; color:#ffd700;">
        Task Management
    </div>

    <!-- User Info -->
    <div class="user-info mb-4 text-center">
        @if(auth()->user()->role == 'admin')
            <h6 class="mb-0">Welcome Admin, {{ auth()->user()->name }}</h6>
        @else
            <h6 class="mb-0">Welcome {{ auth()->user()->name }}</h6>
        @endif
    </div>

    <!-- Navigation -->
    <div class="nav flex-column">
        <a href="{{ route('dashboard') }}" class="nav-link text-white mb-2 p-2 rounded sidebar-link">Dashboard</a>

        @if(auth()->user()->role == 'admin')
            <a href="{{ route('admin.users.index') }}" class="nav-link text-white mb-2 p-2 rounded sidebar-link">Users</a>
            <a href="{{ route('projects.index') }}" class="nav-link text-white mb-2 p-2 rounded sidebar-link">Projects</a>
            <a href="{{ route('tasks.index') }}" class="nav-link text-white mb-2 p-2 rounded sidebar-link">Tasks</a>
            <a href="{{ route('admin.report') }}" class="nav-link text-white mb-2 p-2 rounded sidebar-link">Reports</a>
        @elseif(auth()->user()->role == 'employee')
            <a href="{{ route('tasks.my') }}" class="nav-link text-white mb-2 p-2 rounded sidebar-link">My Tasks</a>
            <a href="{{ route('employee.report') }}" class="nav-link text-white mb-2 p-2 rounded sidebar-link">My Report</a>
        @endif

        <a href="{{ route('logout') }}" class="nav-link text-white mb-2 p-2 rounded sidebar-link">Logout</a>
    </div>
</div>

<!-- CSS -->
<style>
.sidebar-link {
    display: block;
    transition: 0.3s;
}
.sidebar-link:hover {
    background: #343454;
    color: #fff;
    text-decoration: none;
}
</style>


    <!-- Main content -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>
