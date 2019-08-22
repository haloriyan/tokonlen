<title>Semua Produk</title>
<h2>Semua Produk</h2>
<table border="1" style="width: 100%;">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>