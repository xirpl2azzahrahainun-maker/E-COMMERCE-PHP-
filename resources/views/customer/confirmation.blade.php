<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation - Success</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background: #F5F0E9;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #112250;
        }

        .confirmation-card {
            background: white;
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(17, 34, 80, 0.1);
            text-align: center;
            position: relative;
            border: 1px solid #D9CBC2;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: #112250;
            color: #E0C58F;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 40px;
            box-shadow: 0 8px 20px rgba(17, 34, 80, 0.3);
        }

        h3 {
            color: #112250;
            font-weight: 800;
            margin-bottom: 15px;
            letter-spacing: -0.5px;
        }

        .message {
            color: #3C5070;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .details-container {
            background: #F5F0E9;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 1px solid #D9CBC2;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .detail-row:last-child {
            margin-bottom: 0;
            padding-top: 12px;
            border-top: 1px dashed #D9CBC2;
        }

        .detail-row span:first-child {
            color: #3C5070;
            font-weight: 500;
        }

        .detail-row span:last-child {
            font-weight: 700;
            color: #112250;
        }

        .total-label {
            color: #112250 !important;
        }

        .total-value {
            color: #3C5070 !important;
            font-size: 16px;
        }

        .button-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .btn-custom {
            padding: 12px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary-custom {
            background: #112250;
            color: #E0C58F;
            border: none;
        }

        .btn-primary-custom:hover {
            background: #3C5070;
            color: #F5F0E9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(17, 34, 80, 0.2);
        }

        .btn-outline-custom {
            background: white;
            color: #112250;
            border: 2px solid #112250;
        }

        .btn-outline-custom:hover {
            background: #F5F0E9;
            transform: translateY(-2px);
        }

        .text-uppercase-bold {
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="confirmation-card">
        <div class="success-icon">
            <i class="bi bi-check2-circle"></i>
        </div>

        <h3>Payment Successful</h3>
        <p class="message">Thank you for your order! We are currently processing it. Have a wonderful day!</p>
        
        <div class="details-container">
            <div class="detail-row">
                <span>Order Number</span>
                <span style="font-family: monospace;">#{{ $order->order_number }}</span>
            </div>
            <div class="detail-row">
                <span>Date</span>
                <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
            </div>
            <div class="detail-row">
                <span>Payment Method</span>
                <span class="text-uppercase-bold">{{ str_replace('_',' ',$order->payment_method) }}</span>
            </div>
            <div class="detail-row">
                <span class="total-label">Total Amount</span>
                <span class="total-value">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="button-group">
            <a href="{{ route('customer.productcus') }}" class="btn-custom btn-outline-custom">
                <i class="bi bi-cart-plus me-1"></i> Continue
            </a>
            <a href="{{ route('customer.orders') }}" class="btn-custom btn-primary-custom">
                <i class="bi bi-box-seam me-1"></i> View Order
            </a>
        </div>
    </div>

</body>
</html>