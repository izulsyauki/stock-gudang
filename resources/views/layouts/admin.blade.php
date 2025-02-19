<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
        }

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

        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            transition: margin 0.3s ease-in-out;
            width: calc(100% - 250px);
        }

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

        .close-btn {
            display: none;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

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

        .sidebar-bottom {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 1rem 0px;
            margin: 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-email {
            color: white;
            font-size: 0.9rem;
            padding: 1rem;
            margin-bottom: 1rem;
            width: 100%;
            word-break: break-all;
        }

        .logout-btn {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            color: inherit;
            padding: 10px 20px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body>

    <button class="menu-btn" id="toggleSidebar">
        <i class="fas fa-bars"></i>
    </button>

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
        <a href="{{ route('transaction.index') }}"
            class="{{ request()->routeIs('transaction.index*') ? 'active' : '' }}"><i
                class="fas fa-exchange-alt me-2"></i> Stock Transaction</a>
        <a href="{{ route('customers.index') }}"
            class="{{ request()->routeIs('customers.index*') ? 'active' : '' }}"><i class="fas fa-users me-2"></i>
            Customers</a>

        <div class="sidebar-bottom">
            <div class="user-email">
                <i class="fas fa-user me-2"></i>
                {{ Auth::user()->email }}
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display: inline-block; width: 100%;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="content" id="mainContent">

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'error!',
                text: "{{ session('error') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.add('show');
        });

        document.getElementById('closeSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
        });

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
