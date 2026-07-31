<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Explorer</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #F5F0E9; /* Light Cream */
            margin: 0;
            color: #112250;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #112250; /* Deep Navy */
            color: #F5F0E9;
            position: fixed;
            left: 0;
            top: 0;
            padding: 25px 20px;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .sidebar-header {
            margin-bottom: 25px;
            border-bottom: 1px solid #3C5070;
            padding-bottom: 15px;
        }

        .sidebar-header h4 { font-size: 1.1rem; font-weight: bold; margin: 0; color: #E0C58F; }
        .sidebar-header p { font-size: 12px; color: #D9CBC2; margin: 5px 0 0; }

        .sidebar_menu { list-style: none; padding: 0; flex-grow: 1; margin-top: 15px; }
        .sidebar_item { margin-bottom: 5px; }

        .sidebar_link {
            text-decoration: none;
            color: #F5F0E9;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 8px;
            transition: 0.3s;
            font-size: 14px;
        }

        .sidebar_link:hover {
            background: #3C5070;
            color: #E0C58F;
        }

        /* USER SECTION */
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
            border-radius: 50%;
            color: #112250;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 250px;
            padding: 30px 40px;
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-left: 5px solid #E0C58F;
        }

        .top-bar h3 { font-size: 1.2rem; font-weight: bold; margin: 0; color: #112250; }

        /* PRODUCTS GRID */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 25px;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: 0.3s;
            border: 1px solid #D9CBC2;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 8px 25px rgba(0,0,0,0.1); 
            border-color: #E0C58F;
        }

        .product-image { 
            width: 100%; 
            height: 200px; 
            object-fit: cover;
            border-bottom: 1px solid #F5F0E9;
        }

        .product-info { padding: 15px; flex-grow: 1; }
        .product-title { font-weight: bold; font-size: 1rem; color: #112250; margin-bottom: 6px; }
        .product-price { color: #112250; font-weight: 800; font-size: 1.1rem; margin-bottom: 8px; }
        .product-stock { font-size: 13px; color: #3C5070; display: flex; align-items: center; gap: 6px; }

        .btn-add-cart {
            width: 100%;
            border: none;
            padding: 12px;
            background: #112250;
            color: #E0C58F;
            border-radius: 0 0 15px 15px;
            font-weight: 600;
            transition: 0.2s;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .btn-add-cart:hover { background: #3C5070; color: white; }

        .logout-button {
            border: none;
            background: #D9CBC2;
            color: #112250;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .logout-button:hover {
            background: #ef4444;
            color: white;
        }

        /* PAGINATION CUSTOM */
        .pagination .page-link { color: #112250; }
        .pagination .active .page-link { background-color: #112250; border-color: #112250; }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h4>OUR ITEMS</h4>
            <p>Customer Experience</p>
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
                    <i class="bi bi-cart3"></i> My Cart
                </a>
            </li>
            <li class="sidebar_item">
                <a href="{{ route('customer.orders') }}" class="sidebar_link">
                    <i class="bi bi-receipt"></i> My Orders
                </a>
            </li>
        </ul>

        <div class="user-section-sidebar">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div style="flex-grow: 1;">
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
            <h3>Explore Our Products</h3>
            <div class="text-muted small"><i class="bi bi-calendar3 me-2"></i>{{ date('d M Y') }}</div>
        </div>

        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4" style="background: #dcfce7; color: #166534;">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if ($products->count() > 0)
            <div class="products-grid">
                @foreach ($products as $product)
                    <div class="product-card">
                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}" class="product-image">
                        <div class="product-info">
                            <div class="product-title">{{ $product->title }}</div>
                            <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            <div class="product-stock">
                                <i class="bi bi-box-seam"></i> Stock: {{ $product->stock }}
                            </div>
                        </div>
                        
                        <form action="{{ route('customer.cart.add', $product->id) }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn-add-cart">
                                Add to Cart <i class="bi bi-cart-plus ms-1"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center mt-5 py-5 bg-white rounded-3 shadow-sm" style="border: 1px solid #D9CBC2;">
                <i class="bi bi-inbox text-muted" style="font-size:50px; opacity: 0.5;"></i>
                <h4 class="text-muted mt-3">No products available at the moment</h4>
            </div>
        @endif
    </div>

</body>
</html>