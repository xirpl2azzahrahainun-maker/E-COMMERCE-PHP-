<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #F5F0E9;
            margin: 0;
            color: #112250;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #112250;
            color: #F5F0E9;
            position: fixed;
            left: 0;
            top: 0;
            padding: 25px 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header h4 { 
            font-size: 1.1rem; 
            font-weight: bold; 
            margin-bottom: 25px; 
            border-bottom: 1px solid #3C5070; 
            padding-bottom: 15px; 
            color: #E0C58F;
        }

        .sidebar_menu { list-style: none; padding: 0; flex-grow: 1; }
        .sidebar_item { margin-bottom: 8px; }

        .sidebar_link {
            text-decoration: none;
            color: #F5F0E9;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border-radius: 8px;
            transition: 0.3s;
            font-size: 14px;
        }

        .sidebar_link:hover, .sidebar_link.active {
            background: #3C5070;
            color: #E0C58F;
        }

        /* USER SECTION SIDEBAR */
        .user-section-sidebar {
            padding-top: 20px;
            border-top: 1px solid #3C5070;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            background: #E0C58F;
            border-radius: 50%;
            color: #112250;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 240px;
            padding: 30px 40px;
            min-height: 100vh;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-left: 5px solid #E0C58F;
        }

        .top-bar h3 { font-size: 1.25rem; font-weight: bold; margin: 0; color: #112250; }

        /* TABLE CONTAINER */
        .table-container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #D9CBC2;
        }

        .table thead th {
            background-color: #F5F0E9;
            border-bottom: 2px solid #D9CBC2;
            color: #112250;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            color: #3C5070;
            font-size: 0.95rem;
            border-bottom: 1px solid #F5F0E9;
        }

        /* BADGE STATUS */
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-pending { background: #E0C58F; color: #112250; }
        .status-completed { background: #112250; color: white; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }

        .logout-button {
            border: none;
            background: #D9CBC2;
            color: #112250;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .logout-button:hover { background: #3C5070; color: white; }

        .btn-view {
            background-color: #112250;
            border: none;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 15px;
            border-radius: 6px;
            color: #E0C58F;
        }

        .btn-view:hover {
            background-color: #3C5070;
            color: #F5F0E9;
        }

        .text-primary {
            color: #112250 !important;
        }

        .btn-shop {
            background-color: #112250;
            border: none;
            color: #E0C58F;
        }
        
        .btn-shop:hover {
            background-color: #3C5070;
            color: white;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>My Orders</h4>
        </div>

        <ul class="sidebar_menu">
            <li class="sidebar_item">
                <a href="{{ route('customer.dashboardcus') }}" class="sidebar_link">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="sidebar_item">
                <a href="{{ route('customer.productcus') }}" class="sidebar_link">
                    <i class="bi bi-bag-check"></i> Browse Products
                </a>
            </li>
            <li class="sidebar_item">
                <a href="{{ route('customer.cart') }}" class="sidebar_link">
                    <i class="bi bi-cart"></i> My Cart
                </a>
            </li>
            <li class="sidebar_item">
                <a href="{{ route('customer.orders') }}" class="sidebar_link active">
                    <i class="bi bi-receipt"></i> My Orders
                </a>
            </li>
        </ul>

        <div class="user-section-sidebar">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <strong style="display: block; font-size: 13px; color: #F5F0E9;">{{ Auth::user()->name }}</strong>
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h3>Order History</h3>
            <div class="text-muted small"><i class="bi bi-calendar3 me-2"></i>History</div>
        </div>

        @if($orders->count() > 0)
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td class="fw-bold">#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td class="fw-bold text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td><span class="text-uppercase small">{{ str_replace('_',' ',$order->payment_method) }}</span></td>
                            <td>
                                <span class="badge-status status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('customer.order.show', $order->id) }}" class="btn btn-view">
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        </div>
        @else
        <div class="text-center bg-white p-5 rounded-4 shadow-sm" style="margin-top: 50px; border: 1px solid #D9CBC2;">
            <i class="bi bi-receipt text-muted" style="font-size: 60px; opacity: 0.3;"></i>
            <h4 class="mt-3 text-muted">You have no orders yet.</h4>
            <a href="{{ route('customer.productcus') }}" class="btn btn-shop mt-3 px-4 py-2 rounded-pill">
                Start Shopping
            </a>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>