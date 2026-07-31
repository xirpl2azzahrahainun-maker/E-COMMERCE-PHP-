<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Cart - Customer Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #F5F0E9;
            color: #112250;
            margin: 0;
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
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .sidebar-header h4 {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 5px;
            color: #E0C58F;
        }

        .sidebar-header p {
            font-size: 0.8rem;
            color: #D9CBC2;
            margin-bottom: 30px;
        }

        .nav_menu {
            list-style: none;
            padding: 0;
            flex-grow: 1;
        }

        .nav_item {
            margin-bottom: 8px;
        }

        .nav_link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #F5F0E9;
            padding: 12px 15px;
            border-radius: 10px;
            transition: 0.3s;
            font-size: 14px;
        }

        .nav_link:hover,
        .nav_link.active {
            background: #3C5070;
            color: #E0C58F;
        }

        .user-section-sidebar {
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
            border-radius: 10px;
            color: #112250;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }

        .logout-button {
            border: none;
            background: #3C5070;
            color: #F5F0E9;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 4px;
        }

        .main-content {
            margin-left: 260px;
            padding: 40px;
        }

        .top-bar {
            background: #FFFFFF;
            padding: 20px 30px;
            border-radius: 15px;
            margin-bottom: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #E0C58F;
        }

        .top-bar h3 {
            font-weight: 700;
            color: #112250;
            margin: 0;
        }

        .cart-items {
            display: grid;
            grid-template-columns: 80px 1fr auto auto;
            align-items: center;
            gap: 20px;
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
            border: 1px solid #D9CBC2;
        }

        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .item-title {
            font-weight: 700;
            color: #112250;
            margin: 0;
        }

        .item-price {
            color: #3C5070;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .btn-remove {
            background: #D9CBC2;
            color: #112250;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-remove:hover {
            background: #3C5070;
            color: white;
        }

        .cart-summary {
            background: #112250;
            color: #F5F0E9;
            padding: 30px;
            border-radius: 20px;
        }

        .btn-checkout {
            background: #E0C58F;
            color: #112250;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            display: block;
            text-align: center;
            text-decoration: none;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-checkout:hover {
            background: #F5F0E9;
            color: #112250;
        }

        .quantity-input {
            width: 60px;
            border: 1px solid #D9CBC2;
            border-radius: 5px;
            text-align: center;
            color: #112250;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h4>My Cart</h4>
            <p>Premium Experience</p>
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
                <a href="{{ route('customer.cart') }}" class="nav_link active">
                    <i class="bi bi-cart"></i> My Cart
                </a>
            </li>
            <li class="nav_item">
                <a href="{{ route('customer.orders') }}" class="nav_link">
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
            <h3>My Shopping Cart</h3>
        </div>

        <div class="row">
            <div class="col-lg-8">
                @forelse ($cartitem as $item)
                <div class="cart-items">
                    <img src="{{ asset('/storage/products/'.$item->product->image) }}" class="item-image">

                    <div>
                        <p class="item-title">{{ $item->product->title }}</p>
                        <span class="item-price">Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('customer.cart.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" 
                               class="quantity-input" onchange="this.form.submit()">
                    </form>

                    <form action="{{ route('customer.cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-remove">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
                @empty
                <div class="text-center py-5 bg-white rounded-3 shadow-sm">
                    <i class="bi bi-cart-x display-1 text-muted"></i>
                    <p class="mt-3 fs-5 text-muted">Your cart is empty.</p>
                    <a href="{{ route('customer.productcus') }}" class="btn btn-primary mt-2" style="background-color: #112250; border: none;">Start Shopping</a>
                </div>
                @endforelse
            </div>

            @if(count($cartitem) > 0)
            <div class="col-lg-4">
                <div class="cart-summary">
                    <h5 class="mb-4" style="color: #E0C58F;">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <hr style="border-color: #3C5070;">
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold fs-4" style="color: #E0C58F;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('customer.checkout') }}" class="btn-checkout">
                        Proceed to Checkout <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

</body>
</html>