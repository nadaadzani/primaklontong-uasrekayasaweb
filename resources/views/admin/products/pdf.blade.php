<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Product</title>
</head>
<body>
    <h1>Data Products</h1>
    <table border="1" width="100%" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if($product->gambar)
                        <img src="{{ public_path('images/' . $product->gambar) }}" alt="{{ $product->nama }}" width="100">
                    @else
                        <p>No Image Available</p>
                    @endif
                </td>
                <td>{{ $product->nama }}</td>
                <td>{{ $product->kategori }}</td>
                <td>{{ $product->harga }}</td>
                <td>{{ $product->deskripsi }}</td>
                <td>{{ $product->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>