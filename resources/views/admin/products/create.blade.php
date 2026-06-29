@extends('admin.template')
@section('content')
<div class="container mt-3">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3>Tambah Product</h3>
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="image">Gambar</label>
                        <input type="file" class="form-control" id="image" name="gambar" required> 
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nama">Nama Product</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="tersedia">Tersedia</option>
                            <option value="hampir habis">Hampir Habis</option>
                            <option value="habis">Habis</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection