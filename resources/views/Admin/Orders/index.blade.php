<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Order</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
body{
    font-family: 'Times New Roman', Times, serif;
    background:#f8fafc;
}

/* MAIN CONTENT (biar tidak ketabrak sidebar) */
.container{
    margin-left:260px;
    max-width:1200px;
}

/* PAGE TITLE */
.container h2{
    font-weight:600;
    color:#0f172a;
}

/* CARD */
.card{
    border:none;
    border-radius:12px;
    overflow:hidden;
}

.card-header{
    background:#1e3a8a;
    color:white;
    font-weight:600;
    padding:14px 20px;
}

.card-body{
    padding:25px;
}

/* TABLE */
.table{
    margin-bottom:0;
}

.table thead{
    background:#f1f5f9;
}

.table th{
    font-weight:600;
    color:#0f172a;
    border-bottom:2px solid #e2e8f0;
}

.table td{
    vertical-align:middle;
}

/* TABLE ROW HOVER */
.table-hover tbody tr:hover{
    background:#f8fafc;
}

/* BUTTON DETAIL */
.btn-primary{
    background:#1e3a8a;
    border:none;
    padding:6px 12px;
    font-size:14px;
}

.btn-primary:hover{
    background:#0f172a;
}

/* BADGE STATUS */
.badge-status{
    padding:6px 12px;
    border-radius:8px;
    font-size:13px;
    font-weight:500;
    display:inline-block;
}

/* ORDER STATUS */
.status-pending{
    background:#fef3c7;
    color:#92400e;
}

.status-processing{
    background:#dbeafe;
    color:#1e40af;
}

.status-completed{
    background:#dcfce7;
    color:#166534;
}

.status-cancelled{
    background:#fee2e2;
    color:#991b1b;
}

/* PAYMENT STATUS */
.status-paid{
    background:#dcfce7;
    color:#166534;
}

.status-unpaid{
    background:#fee2e2;
    color:#991b1b;
}

/* PAGINATION */
.pagination{
    justify-content:center;
}

.page-link{
    color:#1e3a8a;
}

.page-link:hover{
    color:#0f172a;
}
    </style>
</head>

<body>
    @include('Admin.sidebar')

    <div class="container mt-4">
        <h2 class="mb-3">Manage Orders</h2>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">ORDER LIST</h5>
            </div>

            <div class="card-body">
                @if (session('succes'))
                    <div class="alert alert-success">
                        {{ session('succes') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Payment Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($Orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>
                                        Rp{{ number_format($order->total_amount, 2, ',', '.') }}
                                    </td>
                                    <td class="text-uppercase">
                                        {{ str_replace('-', ' ', $order->payment_method) }}
                                    </td>
                                    <td>
                                        <span class="badge-status status-{{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-status status-{{ $order->payment_status }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('Admin.Orders.show', $order->id) }}"
                                           class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $Orders->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
