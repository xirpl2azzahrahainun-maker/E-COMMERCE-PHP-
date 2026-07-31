<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #F5F0E9;
            font-family: Arial, Helvetica   , sans-serif;
            color: #112250;
        }

        .container {
            max-width: 1100px;
            margin-top: 40px;
        }

        .back-link {
            text-decoration: none;
            color: #3C5070;
            font-weight: 500;
            transition: 0.3s;
        }

        .back-link:hover {
            color: #112250;
        }

        .back-link i {
            margin-right: 6px;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-top: 20px;
        }

        .form-section,
        .order-summary {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #D9CBC2;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #112250;
            border-bottom: 2px solid #E0C58F;
            display: inline-block;
            padding-bottom: 5px;
        }

        .section-title i {
            margin-right: 6px;
            color: #3C5070;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 5px;
            color: #3C5070;
        }

        .form-control:focus {
            border-color: #E0C58F;
            box-shadow: 0 0 0 0.25rem rgba(224, 197, 143, 0.25);
        }

        .payment-methods {
            display: flex;
            gap: 15px;
        }

        .payment-methods label {
            flex: 1;
            border: 2px solid #D9CBC2;
            border-radius: 10px;
            text-align: center;
            padding: 15px;
            cursor: pointer;
            transition: 0.2s;
            color: #3C5070;
        }

        .payment-methods input {
            display: none;
        }

        .payment-methods i {
            font-size: 22px;
            margin-bottom: 5px;
            display: inline-block;
        }

        .payment-methods label:hover {
            border-color: #E0C58F;
        }

        .payment-option.selected,
        .COD-option.selected,
        .e-wallet-option.selected {
            border-color: #112250;
            background: #F5F0E9;
            color: #112250;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
            color: #3C5070;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-weight: 600;
            font-size: 18px;
            border-top: 1px solid #D9CBC2;
            padding-top: 15px;
            margin-top: 15px;
            color: #112250;
        }

        .btn-confirm {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #112250;
            color: #E0C58F;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-confirm:hover {
            background: #3C5070;
            color: #F5F0E9;
        }

        .btn-confirm i {
            margin-left: 6px;
        }

        @media(max-width:768px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }

            .payment-methods {
                flex-direction: column;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <a href="{{ route('customer.cart') }}" class="back-link"><i class="bi bi-arrow-left"></i> Back to Cart</a>
        <form action="{{ route('customer.checkout.process') }}" method="POST">
            @csrf
            <div class="checkout-grid">
                <div class="form-section">
                    <div class="section-title">
                        <i class="bi bi-truck"></i> Shipping Details
                    </div>

                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="shipping_name" class="form-control" required
                            value="{{ Auth::user()->name }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" name="shipping_phone" class="form-control" required
                            placeholder="08xxxxxxxx">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <textarea name="shipping_address" class="form-control" rows="4" required
                            placeholder="Complete address, City, streets, zip code"></textarea>
                    </div>

                    <div class="section-title" style="margin-top: 30px;">
                        <i class="bi bi-credit-card"></i> Payment Method
                    </div>

                    <div class="payment-methods">
                        <label class="COD-option">
                            <input type="radio" name="payment_method" value="COD">
                            <div><i class="bi bi-cash"></i><br>Cash on Delivery </div>
                        </label>

                        <label class="e-wallet-option">
                            <input type="radio" name="payment_method" value="e_wallet">
                            <div><i class="bi bi-wallet"></i><br>E-Wallet </div>
                        </label>
                        
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="bank_transfer" required checked>
                            <div><i class="bi bi-bank"></i><br>Bank Transfer </div>
                        </label>
                    </div>
                </div>

                <div class="order-summary">
                    <div class="section-title">
                        Order Summary
                    </div>
                    @foreach ($cartitem as $item)
                        <div class="summary-item">
                            <span>{{ $item->product->title }} x {{ $item->quantity }}</span>
                            <span>RP {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                    @endforeach

                    <div class="total-row">
                        <span>Total Payment</span>
                        <span style="color: #3C5070;">RP {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="btn-confirm">Place Order<i class="bi bi-arrow-right"></i></button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const allOptions = document.querySelectorAll('.payment-methods label');
        
        allOptions.forEach(option => {
            option.addEventListener('click', () => {
                allOptions.forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');
            });
        });

        const initialChecked = document.querySelector('input[name="payment_method"]:checked');
        if (initialChecked) {
            initialChecked.parentElement.classList.add('selected');
        }
    </script>
</body>

</html>