<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #F5F0E9; 
            color: #112250;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #112250; 
            color: #F5F0E9;
            position: fixed;
            left: 0;
            top: 0;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            margin-bottom: 35px;
            border-bottom: 1px solid #3C5070;
            padding-bottom: 20px;
        }

        .sidebar-header h4 { font-size: 1.2rem; font-weight: bold; margin: 0; color: #E0C58F; }
        .sidebar-header p { font-size: 0.8rem; color: #D9CBC2; margin: 5px 0 0; }

        .nav_menu { list-style: none; padding: 0; flex-grow: 1; }
        .nav_item { margin-bottom: 8px; }

        .nav_link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #F5F0E9;
            padding: 12px 15px;
            border-radius: 8px;
            transition: 0.3s;
            font-weight: 500;
        }

        .nav_link:hover {
            background: #3C5070;
            color: #E0C58F;
            transform: translateX(5px);
        }

        .nav_link.active {
            background: #3C5070;
            color: #E0C58F;
            font-weight: bold;
        }

        .user-section {
            padding-top: 20px;
            border-top: 1px solid #3C5070;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #E0C58F;
            border-radius: 50%;
            color: #112250;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .main-content {
            margin-left: 260px;
            padding: 40px;
            min-height: 100vh;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 18px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #E0C58F;
        }

        .top-bar h3 { font-size: 1.3rem; font-weight: 700; margin: 0; color: #112250; }

        .welcome-card {
            background: white;
            padding: 60px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 15px -3px rgba(17, 34, 80, 0.1);
            text-align: center;
            max-width: 600px;
            margin: 40px auto;
            border: 1px solid #D9CBC2;
        }

        .welcome-card h3 { font-size: 1.8rem; font-weight: 800; color: #112250; margin-bottom: 15px; }

        .logout-button {
            border: none;
            background: #D9CBC2;
            color: #112250;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .logout-button:hover { background: #3C5070; color: white; }

        .btn-primary {
            background-color: #112250;
            border-color: #112250;
            color: #E0C58F;
        }

        .btn-primary:hover {
            background-color: #3C5070;
            border-color: #3C5070;
            color: #F5F0E9;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>DASHBOARD</h4>
            <p>Shopping Dashboard</p>
        </div>

        <ul class="nav_menu">
            <li class="nav_item">
                <a href="{{ route('customer.dashboardcus') }}" class="nav_link active">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav_item">
                <a href="{{ route('customer.productcus') }}" class="nav_link">
                    <i class="bi bi-bag-check"></i> Browse Products
                </a>
            </li>
            <li class="nav_item">
                <a href="{{ route('customer.cart') }}" class="nav_link">
                    <i class="bi bi-cart"></i> My Cart
                </a>
            </li>
            <li class="nav_item">
                <a href="{{ route('customer.orders') }}" class="nav_link">
                    <i class="bi bi-receipt"></i> My Orders
                </a>
            </li>
        </ul>

        <div class="user-section">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div style="flex-grow: 1;">
                <strong style="display: block; font-size: 14px; color: #F5F0E9;">{{ Auth::user()->name }}</strong>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h3>Welcome, enjoy your Shopping</h3>
            <div class="text-muted small">{{ date('D, d M Y') }}</div>
        </div>

        <div class="welcome-card">
            <h3>Welcome, {{ Auth::user()->name }}</h3>
            <p class="text-muted">Glad to see you again! Let's find some great products today.</p>
            <div class="mt-4">
                <a href="{{ route('customer.productcus') }}" class="btn btn-primary px-4 py-2 rounded-pill">
                    Start Shopping
                </a>
            </div>
        </div>
    </div>

</body>

<script>
    
    const logoutBtn = document.querySelector('.logout-button');
    
    if (logoutBtn) {
        logoutBtn.onclick = function(e) {
            // Muncul kotak pesan simpel
            let yakin = confirm("Yakin mau keluar?");
            
            // Jika user pilih "Cancel", batalkan proses logout
            if (!yakin) {
                e.preventDefault();
            }
        };
    }

</script>
</html>