<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">

            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">

                    <form action="{{ route('product.update', $product->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- IMAGE --}}
                        <div class="form-group mb-3">
                            <label class="fw-bold">IMAGE</label>
                            <input type="file"
                                   name="image"
                                   class="form-control @error('image') is-invalid @enderror">

                            @error('image')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- TITLE --}}
                        <div class="form-group mb-3">
                            <label class="fw-bold">TITLE</label>
                            <input type="text"
                                   name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $product->title) }}"
                                   placeholder="Masukkan judul product">

                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="form-group mb-3">
                            <label class="fw-bold">DESCRIPTION</label>
                            <textarea name="description"
                                      rows="5"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Masukkan deskripsi product">{{ old('description', $product->description) }}</textarea>

                            @error('description')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- PRICE --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold">PRICE</label>
                                    <input type="text"
                                           name="price"
                                           class="form-control @error('price') is-invalid @enderror"
                                           value="{{ old('price', $product->price) }}"
                                           placeholder="Masukkan harga product">

                                    @error('price')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- STOCK --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold">STOCK</label>
                                    <input type="number"
                                           name="stock"
                                           class="form-control @error('stock') is-invalid @enderror"
                                           value="{{ old('stock', $product->stock) }}"
                                           placeholder="Masukkan stock product">

                                    @error('stock')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <button type="submit" class="btn btn-md btn-primary me-2">
                            SAVE
                        </button>
                        <button type="reset" class="btn btn-md btn-warning">
                            RESET
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>

</body>
<
