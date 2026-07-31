<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Details - Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6fb;
            margin: 0;
        }

        /* SIDEBAR - DIUBAH MENJADI BIRU */
        .sidebar {
            width: 230px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #0d6efd; /* Warna Biru Primer Bootstrap */
            color: white;
            padding: 20px;
            z-index: 1000;
        }

        /* SIDEBAR MENU */
        .nav-link {
            color: rgba(255, 255, 255, 0.8); /* Warna teks putih agak transparan */
            padding: 10px 12px;
            border-radius: 6px;
            display: block;
            margin-bottom: 8px;
            text-decoration: none;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.15); /* Hover putih transparan */
            color: white;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        /* CARD */
        .card {
            border: none;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* CARD HEADER - DIUBAH MENJADI BIRU */
        .card-header {
            background: #0d6efd; /* Warna Biru Primer Bootstrap */
            color: white;
            font-weight: 600;
        }

        /* TABLE */
        .table {
            margin-bottom: 0;
        }

        /* TABLE THEAD - DIUBAH MENJADI BIRU */
        .table thead {
            background: #0d6efd; /* Warna Biru Primer Bootstrap */
            color: white;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        /* FORM */
        .form-control,
        .form-select {
            border-radius: 6px;
        }
    </style>
</head>

<body>
    @include('Admin.sidebar')

    <!-- Konten Utama -->
    <div class="main-content">
        
        <div class="d-flex align-items-center mb-4 gap-3">
            <a href="{{ route('Admin.Orders.index') }}" class="btn btn-outline-primary"> <!-- Tombol diubah jadi biru -->
                <i class="bi bi-arrow-left"> Back</i>
            </a>
            <h3 class="m-0">Order Details</h3>
        </div>

        <div class="row">
            <!-- Kolom Kiri: Items & Shipping -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="m-0">Order Items</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-primary text-white"> <!-- Memaksa header tabel biru -->
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <img src="{{ asset('/storage/products/' . $item->product->image) }}"
                                                        width="50" height="50" class="rounded object-fit-cover" alt="">
                                                    <span>{{ $item->product->title }}</span>
                                                </div>
                                            </td>
                                            <td>Rp{{ number_format($item->price, 2, ',', '.') }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>Rp{{ number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">GRAND TOTAL</td>
                                        <td class="fw-bold">Rp{{ number_format($order->total_amount, 2, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Shipping Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Recipient Name</label>
                                <div class="fw-bold">{{ $order->shipping_name }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="text-muted small">Phone Number</label>
                                <div class="fw-bold">{{ $order->shipping_phone }}</div>
                            </div>

                            <div class="col-12">
                                <label class="text-muted small">Address</label>
                                <div class="fw-bold">{{ $order->shipping_address }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Status Update & Customer Info -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="m-0">Update Order Status</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Admin.Orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Order Status</label>
                                <select name="status" class="form-select">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Payment Status</label>
                                <select name="payment_status" class="form-select">
                                    <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-2">Update Status</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Customer Info</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="bg-primary rounded-circle p-2 d-flex align-items-center justify-content-center text-white"
                                style="width:40px; height:40px;">
                                <i class="bi bi-person"></i>
                            </div>
                            <div>
                                <div class="fw-bold">{{ $order->user_name }}</div>
                                <div class="text-muted small">{{ $order->user_email }}</div>
                            </div>
                        </div>
                        <div class="text-muted small pt-2 border-top">
                            Joined: {{ $order->created_at ? $order->created_at->format('d M Y') : '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>