<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple CRUD Product Sepatu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Simple CRUD Product Sepatu</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-conten-center">
            <div class="cold-md-10">
            <div class="card borde-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Create Product</h3>
                </div>
            <form enctype="multipart/form-data"  action="{{ route ('products.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label h5">Name</label>
                        <input value= "{{ old('nama_product') }}" type="text" class="@error('nama_product'):is-invalid @enderror form-control form-control-lg" placeholder="Name"
                        name="nama_product">
                        @error('nama_product')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label h5">Kategori</label>
                        <input value= "{{ old('kategori') }}"type="text" class="@error('kategori'):is-invalid @enderror form-control form-control-lg" placeholder="Kategori"
                        name="kategori">
                        @error('kategori')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label h5">Harga</label>
                        <input value= "{{ old('harga') }}" type="text" class="@error('harga'):is-invalid @enderror form-control form-control-lg" placeholder="Harga"
                        name="harga">
                        @error('harga')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="" class="form-label h5">Image</label>
                        <input type="file" class="form-control form-control-lg" placeholder="Image"
                        name="image">
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-lg btn-primary bg-dark">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>  
    </div> 
</div>

  </body>
</html>