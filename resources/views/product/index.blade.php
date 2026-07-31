<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Products - Admin Panel</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f0f4ff; /* Light navy background */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* HEADER TITLE */
        .page-title {
            color: #1e3a8a;
            font-weight: 700;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        /* CARD STYLING */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card-header-custom {
            background-color: #1e40af; /* Navy Muda */
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* TABLE STYLING */
        .table {
            margin-bottom: 0;
        }

        .table thead {
            background-color: #f8fafc;
        }

        .table thead th {
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            color: #1e293b;
        }

        /* PRODUCT IMAGE */
        .img-product {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        /* BUTTONS */
        .btn-add {
            background-color: #3b82f6;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-add:hover {
            background-color: #1e40af;
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-back {
            background-color: #64748b;
            color: white;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-back:hover {
            background-color: #475569;
            color: white;
        }

        /* BADGE FOR STOCK */
        .badge-stock {
            background-color: #dcfce7;
            color: #166534;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
        }

        /* PAGINATION CUSTOM */
        .pagination .page-link {
            color: #1e40af;
            border-radius: 5px;
            margin: 0 2px;
        }

        .pagination .page-item.active .page-link {
            background-color: #1e40af;
            border-color: #1e40af;
        }
    </style>
</head>
<body>

<div class="container pb-5">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title text-center">LIST DATA PRODUCTS</h3>
            
            <div class="card">
                <div class="card-header-custom">
                    <h5 class="m-0"><i class="bi bi-box-seam me-2"></i>Product Inventory</h5>
                    <div>
                        <a href="{{ route('Admin.dashboard') }}" class="btn btn-back btn-sm me-2">
                            <i class="bi bi-arrow-left"></i> Back to Dashboard
                        </a>
                        <a href="{{ route('product.create') }}" class="btn btn-add btn-sm">
                            <i class="bi bi-plus-lg"></i> Add Product
                        </a>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Image</th>
                                    <th>Product Title</th>
                                    <th>Price</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="text-center">
                                            @if($product->image)
                                                <img src="{{ asset('storage/products/' . $product->image) }}" class="img-product shadow-sm">
                                            @else
                                                <div class="img-product d-flex align-items-center justify-content-center bg-light text-muted">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ $product->title }}</span>
                                        </td>
                                        <td>
                                            <span class="text-primary fw-semibold">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge-stock">{{ $product->stock }} Pcs</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-info btn-sm" title="Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-outline-primary btn-sm" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form onsubmit="return confirm('Apakah anda yakin ingin menghapus produk ini?')" action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bi bi-folder-x display-4 d-block mb-3"></i>
                                            Data Product belum tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($products->hasPages())
                <div class="card-footer bg-white py-3">
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // SweetAlert handling
    @if (session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000,
            background: '#ffffff',
            iconColor: '#3b82f6'
        });
    @elseif (session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>

</body>
</html>