<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style> 
      body{
    font-family: 'Times New Roman', Times, serif;
    background: #fafafa;
}

/* SIDEBAR */
.sidebar{
    width:220px;
    height:100vh;
    position:fixed;
    top:0;
    left:0;
    background: linear-gradient(180deg,#a4badd,#7e9ac7);
    color:#f8f8f8;
    padding:20px;
    box-shadow:4px 0 10px rgba(0,0,0,0.15);
    z-index:1000;
}

/* MENU */
.nav-link{
    color:#f8f8f8;
    padding:10px 12px;
    border-radius:6px;
    transition:all 0.3s ease;
}

/* HOVER EFFECT */
.nav-link:hover{
    background:rgb(207,241,250);
    color:black;
    transform:translateX(5px);
}

/* ACTIVE MENU */
.nav-link.active{
    background:white;
    color:#2c3e70;
    font-weight:600;
}

/* MAIN CONTENT */
.main-content{
    margin-left:240px;
    padding:20px;
}

/* CARD STATISTIC */
.stat-card{
    background:#fff;
    border-radius:12px;
    padding:20px;
    box-shadow:0 4px 10px rgba(0,0,0,0.08);
    transition:0.3s;
}

.stat-card:hover{
    transform:translateY(-3px);
    box-shadow:0 6px 15px rgba(0,0,0,0.15);
}

    </style>

    <title>Sales Report - Admin</title>
</head>

<body>

@include('Admin.sidebar')

<div class="main-content container-fluid p-4">


    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Sales Report</h2>
        <button onclick="window.print()" class="btn btn-outline-secondary">
            <i class="bi bi-printer"></i> Print Report
        </button>
    </div>


    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('Admin.sales') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Period</label>
                    <select name="period" class="form-select" onchange="this.form.submit()">
                        <option value="all" {{ $period == 'all' ? 'selected' : '' }}>All time</option>
                        <option value="daily" {{ $period == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ $period == 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    </select>
                </div>

                @if ($period != 'all')
                <div class="col-md-3">
                    <label class="form-label">Select Data</label>
                    <input type="date" name="date" class="form-control"
                        value="{{ $date ?? '' }}" onchange="this.form.submit()">
                </div>
                @endif

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>


    <h4 class="mb-4">{{ $title }}</h4>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="fw-bold">Total Revenue</div>
                    <div class="fs-4 text-success">
                        Rp{{ number_format($totalRevenue, 2, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="fw-bold">Total Orders</div>
                    <div class="fs-4">{{ $totalOrders }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="fw-bold">Successful Orders</div>
                    <div class="fs-4">{{ $successfulOrders }}</div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Order List</h5>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Orders as $Order)
                    <tr>
                        <td style ="font-family: monospace">{{ $Order->order_number }}</td>
                        <td>{{ $Order->created_at->format('d M Y') }}</td>
                        <td>{{ $Order->user->name }}</td>
                      <td>Rp{{ number_format($Order->total_amount, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge-status status-{{ $Order->status }}">{{ Str::ucfirst($Order->status) }}</span>
                        </td>
                        <td class="text-uppercase">{{ Str::replace('_','', $Order->payment_method) }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 ">
                                <i class="bi bi-inbox fs-1 text-muted"></i>
                                <p class="text-muted mt-2"> No orders found for this period</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
