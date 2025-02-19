<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            padding-top: 20px;
            transition: transform 0.3s ease-in-out;
            z-index: 1000;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #495057;
        }

        .sidebar a.active {
            background: #007bff;
        }

        /* Content utama */
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            transition: margin 0.3s ease-in-out;
            width: calc(100% - 250px);
        }

        /* Tombol toggle */
        .menu-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            z-index: 1100;
            display: none;
        }

        /* Tombol close di sidebar */
        .close-btn {
            display: none;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        /* Mode Mobile */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 250px;
            }

            .content {
                margin-left: 0;
                width: 100%;
            }

            .menu-btn {
                display: block;
            }

            .close-btn {
                display: block;
                color: white;
            }

            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>

    <!-- Tombol untuk membuka Sidebar -->
    <button class="menu-btn" id="toggleSidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <span class="close-btn" id="closeSidebar">&times;</span>
        <h4 class="text-center m-2 p-2">Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.index*') ? 'active' : '' }}"><i
                class="fas fa-box me-2"></i> Products</a>
        <a href="{{ route('supplier.index') }}" class="{{ request()->routeIs('supplier.index*') ? 'active' : '' }}"><i
                class="fas fa-truck me-2"></i> Supplier</a>
        <a href="{{ route('purchases.index') }}" class="{{ request()->routeIs('purchases.index*') ? 'active' : '' }}"><i
                class="fas fa-shopping-cart me-2"></i> Purchases</a>
        <a href="{{ route('admin.transaction') }}" class="{{ request()->routeIs('admin.stock*') ? 'active' : '' }}"><i
                class="fas fa-exchange-alt me-2"></i> Stock Transaction</a>
        <a href="{{ route('admin.customers') }}"
            class="{{ request()->routeIs('admin.customers*') ? 'active' : '' }}"><i class="fas fa-users me-2"></i>
            Customers</a>
    </div>

    <!-- Content -->
    <div class="content" id="mainContent">

        @yield('content')

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Script -->
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.add('show');
        });

        document.getElementById('closeSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
        });

        // Klik di luar sidebar untuk menutup di mode mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('toggleSidebar');

            if (!sidebar.contains(event.target) && !toggleButton.contains(event.target) && sidebar.classList
                .contains('show')) {
                sidebar.classList.remove('show');
            }
        });
    </script>

</body>

</html>
