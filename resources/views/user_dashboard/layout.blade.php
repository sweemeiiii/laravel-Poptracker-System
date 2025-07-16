<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PopMart Collectible Tracker</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #c00000;
            color: white;
            position: fixed;
        }

        /* LOGO */
        .sidebar-logo {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            border-bottom: 1px solid #f3f2f2;
            text-align: center;
        }

        .sidebar-logo img {
            width: 90%;
            height: auto;
            max-height: 160px;
            object-fit: contain;
        }

        /* ICON STYLING (only for menu icons) */
        .sidebar a .icon {
            height: 20px;
            width: 20px;
            margin-right: 10px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #cac4c4;
            color: black;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .calendar {
            margin-top: 15px;
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            height: 300px;
        }

        .message-button {
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
        }

        .logout-button {
            width: 100%;
            padding: 10px 0;
            color: white;
            background: none;
            border: none;
            text-align: left;
            font-size: 16px;
        }

        .logout-button i {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<!-- Sidebar Navigation -->
<div class="sidebar">
    <div class="sidebar-logo">
        <a href="{{ route('user.dashboard') }}">
            <img src="{{ asset('images/poptracker_logo.png') }}" alt="POP TRACKER Logo">
        </a>
    </div>
    <a href="{{ route('user.dashboard') }}">
        <img class="icon" src="{{ asset('images/add.png') }}" alt="Add Icon"> Dashboard
    </a>
    <a href="{{ route('figurines.index') }}">
        <img class="icon" src="{{ asset('images/add.png') }}" alt="Add Icon"> My Collection
    </a>
    <a href="{{ route('wishlists.index') }}">
        <img class="icon" src="{{ asset('images/heart.png') }}" alt="Heart Icon"> Wishlist
    </a>
    <a href="{{ route('owned.index') }}">
        <img class="icon" src="{{ asset('images/owned.png') }}" alt="Owned Icon"> Owned
    </a>
    <a href="{{ route('duplicates.index') }}">
        <img class="icon" src="{{ asset('images/duplicate.png') }}" alt="Duplicate Icon"> Duplicate
    </a>
    <a href="{{ route('map.index') }}">
        <img class="icon" src="{{ asset('images/locator.png') }}" alt="Locator Icon"> Store Locator
    </a>

    <form method="POST" action="{{ route('logout') }}" style="margin: 20px;">
        @csrf
        <button type="submit" class="logout-button">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </form>
</div>

@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif

<div class="content">
    @yield('content')  <!-- This will be replaced by the child template content -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@yield('scripts')

</body>
</html>
