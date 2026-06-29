@extends('admin.template')
@section('content')
<div class="main-content">
    <div class="container-fluid d-flex justify-content-between mb-3 py-3">
        <h3>Data Products</h3>
        <header class="justify-content-end">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Tambah Product</a>
            <a href="{{ route('products.pdf') }}" class="btn btn-secondary" target="_blank">Cetak PDF</a>
        </header>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered" id="tabel_project">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($product->gambar)
                                <img src="{{ secure_asset('images/' . $product->gambar) }}" alt="{{ $product->nama }}" width="100">
                            @else
                                <p>No Image Available</p>
                            @endif
                        </td>
                        <td>{{ $product->nama }}</td>
                        <td>{{ $product->kategori }}</td>
                        <td>{{ $product->harga }}</td>
                        <td>{{ $product->deskripsi }}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#tabel_project').DataTable();
    });
</script>
@endsection