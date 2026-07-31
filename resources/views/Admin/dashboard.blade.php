<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD ADMIN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        /* RESET & BASE */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background: #f0f4ff; /* Light navy background */
            min-height: 100vh;
        }

        /* SIDEBAR (Assuming width 240px) */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #1e40af;
            position: fixed;
            color: white;
        }

        /* MAIN CONTENT AREA */
        .main-content {
            margin-left: 240px; /* Samakan dengan lebar sidebar */
            padding: 30px;
            width: calc(100% - 240px);
        }

        /* TOP BAR */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .top-bar h2 {
            color: #1e3a8a;
            font-weight: 700;
            text-transform: capitalize;
        }

        /* USER PROFILE & LOGOUT */
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: #3b82f6;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .logout-btn {
            background: #ef4444; /* Warna merah untuk logout agar kontras */
            border: none;
            padding: 4px 12px;
            color: white;
            border-radius: 6px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            margin-top: 4px;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        /* STATS GRID - Ini kunci agar sejajar ke samping */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5rem;
            color: #3b82f6;
            margin-bottom: 15px;
            display: block;
        }

        .stat-card h3 {
            font-size: 1.8rem;
            color: #1e3a8a;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .stat-card p {
            color: #64748b;
            font-weight: 500;
            margin: 0;
        }

        /* QUICK ACTIONS */
        .quick-actions {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .quick-actions h5 {
            color: #1e3a8a;
            margin-bottom: 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #3b82f6;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            margin-right: 12px;
            font-weight: 500;
            transition: 0.3s;
        }

        .action-btn:hover {
            background: #1e40af;
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body>

    @include('Admin.sidebar')

    <div class="main-content">
        <div class="top-bar">
            <h2>Dashboard</h2>
            
            <div class="user-info">
                <div class="user-details">
                    <strong>{{ Auth::user()->name }}</strong>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <i class="bi bi-box-seam stat-icon"></i>
                <h3>{{ $productCount }}</h3>
                <p>Total Products</p>
            </div>

            <div class="stat-card">
                <i class="bi bi-cart-check stat-icon"></i>
                <h3>{{ $orderCount }}</h3>
                <p>Total Orders</p>
            </div>

            <div class="stat-card">
                <i class="bi bi-currency-dollar stat-icon"></i>
                <h3>RP {{ number_format($revenue, 0, ',', '.') }}</h3>
                <p>Total Revenue</p>
            </div>
        </div>

        <div class="quick-actions">
            <h5>Quick Actions</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('product.index') }}" class="action-btn">
                    <i class="bi bi-kanban"></i> Manage Products
                </a>
                <a href="{{ route('product.create') }}" class="action-btn">
                    <i class="bi bi-plus-circle"></i> Add New Product
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>