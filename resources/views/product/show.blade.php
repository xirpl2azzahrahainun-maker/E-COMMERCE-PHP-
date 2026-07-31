<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Show Product</title>
</head>
<body>
<div class="container mt-5 mb-5">
    <div class="row g-4">

        <a href="{{ route('product.index') }}">BACK</a>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded h-100">
                <div class="card-body d-flex align-items-center justify-content-center">
                    @if($product->image)
                        <img src="{{ asset('storage/product/' . $product->image) }}"
                             class="img-fluid rounded"
                             style="max-height:300px; object-fit:cover;">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center w-100"
                             style="height:300px">
                            <span class="text-muted">No Image Available</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- DETAIL -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded h-100">
                <div class="card-body">
                    <h3 class="fw-bold">{{ $product->title }}</h3>
                    <hr>

                    <h4 class="text-success mb-3">
                        Rp{{ number_format($product->price,2,',','.') }}
                    </h4>

                    <div class="mb-3">
                        <h6 class="fw-semibold">Deskripsi</h6>
                        <div class="border rounded p-3 bg-light">
                            {!! $product->description !!}
                        </div>
                    </div>

                    <p>
                        Stock :
                        <span class="badge bg-primary">
                            {{ $product->stock }}
                        </span>
                    </p>

                    <div class="mt-4">
                        <a href="{{ route('product.index') }}" class="btn btn-secondary me-2">
                            KEMBALI
                        </a>
                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">
                            EDIT
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
