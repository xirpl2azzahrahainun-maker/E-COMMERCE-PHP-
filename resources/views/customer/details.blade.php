<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #F5F0E9;
            color: #112250;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #112250;
            color: #F5F0E9;
            position: fixed;
            left: 0;
            top: 0;
            padding: 25px 20px;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header h4 {
            margin: 0;
            font-weight: 600;
            color: #E0C58F;
        }

        .sidebar-header p {
            font-size: 0.8rem;
            color: #D9CBC2;
        }

        .nav_menu {
            list-style: none;
            padding: 0;
            margin-top: 30px;
        }

        .nav_item {
            margin-bottom: 12px;
        }

        .nav_link {
            text-decoration: none;
            color: #F5F0E9;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 6px;
            transition: 0.2s;
        }

        .nav_link:hover {
            background: #3C5070;
            color: #E0C58F;
        }

        .main-content {
            margin-left: 250px;
            padding: 35px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .top-bar {
            width: 100%;
            max-width: 750px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #E0C58F;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            background: #E0C58F;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #112250;
            font-weight: bold;
        }

        .logout-button {
            border: none;
            background: #D9CBC2;
            color: #112250;
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
            transition: 0.3s;
        }

        .logout-button:hover {
            background: #3C5070;
            color: white;
        }

        .back-btn {
            text-decoration: none;
            margin-bottom: 15px;
            color: #3C5070;
            font-weight: 500;
            align-self: flex-start;
            transition: 0.2s;
        }

        .back-btn:hover {
            color: #112250;
        }

        .content-card {
            width: 100%;
            max-width: 750px;
            background: white;
            padding: 22px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid #D9CBC2;
        }

        .section-header {
            font-weight: 600;
            margin-bottom: 15px;
            color: #112250;
            border-bottom: 2px solid #F5F0E9;
            padding-bottom: 8px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .info-label {
            font-size: 13px;
            color: #3C5070;
        }

        .info-value {
            font-weight: 600;
            color: #112250;
        }

        .badge-status {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            color: white;
            font-weight: 600;
        }

        .status-pending { background: #E0C58F; color: #112250; }
        .status-completed { background: #112250; }
        .status-cancelled { background: #ef4444; }

        .order-item-table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-item-table th {
            background: #F5F0E9;
            color: #112250;
            padding: 12px;
            font-size: 14px;
            text-align: left;
        }

        .order-item-table td {
            padding: 12px;
            border-bottom: 1px solid #F5F0E9;
            vertical-align: middle;
        }

        .item-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .item-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #D9CBC2;
        }

        .total-footer-row td {
            border-bottom: none;
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>My Orders</h4>
            <p>Customer Portal</p>
        </div>

        <ul class="nav_menu">
            <li class="nav_item">
                <a href="{{ route('customer.dashboardcus') }}" class="nav_link">
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
    </div>

    <div class="main-content">
        <div class="top-bar">
            <h3>Order Details</h3>

            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <strong>{{ Auth::user()->name }}</strong>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <a href="{{ route('customer.orders') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i> Back to Orders
        </a>

        <div class="content-card">
            <div class="section-header">Order Information</div>
            <div class="info-grid">
                <div>
                    <div class="info-label">Order Number</div>
                    <div class="info-value">#{{ $order->id }}</div>
                </div>
                <div>
                    <div class="info-label">Date Placed</div>
                    <div class="info-value">{{ $order->created_at->format('d M Y, H:i') }}</div>
                </div>
                <div>
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span class="badge-status status-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
                <div>
                    <div class="info-label">Payment Method</div>
                    <div class="info-value">{{ str_replace('_', ' ', $order->payment_method) }}</div>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="section-header">Shipping Details</div>
            <div class="info-grid">
                <div>
                    <div class="info-label">Recipient Name</div>
                    <div class="info-value">{{ $order->shipping_name }}</div>
                </div>
                <div>
                    <div class="info-label">Phone Number</div>
                    <div class="info-value">{{ $order->shipping_phone }}</div>
                </div>
                <div style="grid-column: span 2;">
                    <div class="info-label">Shipping Address</div>
                    <div class="info-value">{{ $order->shipping_address }}</div>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="section-header">Order Items</div>
            <table class="order-item-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>
                                <div class="item-row">
                                    <img src="{{ asset('storage/products/' . $item->product->image) }}" alt="" class="item-image">
                                    <span style="font-weight: 500;">{{ $item->product->title }}</span>
                                </div>
                            </td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="text-end" style="font-weight: 600">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="total-footer-row">
                        <td colspan="3" class="text-end"><strong>Grand Total</strong></td>
                        <td class="text-end">
                            <h5 style="color: #112250; font-weight: 800; margin: 0;">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>