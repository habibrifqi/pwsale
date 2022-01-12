<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cetak barcode</title>
</head>

<style>
    .text-center {
        text-align: center;
    }

    .dd {
        width: 33%;
    }

</style>

<body>
    <table width="100%">
        <tr>
            @foreach ($dataproduk as $key => $produk)
                <td class="text-center dd">
                    <p>{{ $produk->nama_produk }} - Rp. {{ format_uang($produk->harga_jual) }}</p>
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG('45435', 'C39') }}" alt="barcode"
                        width="180" height="60">
                    {{ $produk->kode_produk }}
                </td>
                @if (($key + 1) % 3 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
</body>

</html>
