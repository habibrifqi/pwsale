<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cetak kartu member</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap');

        td {
            position: relative;
        }

        .box {
            position: relative;
        }

        .box .item {
            position: absolute;
            top: 0;
            left: 0;
            background: #fff
        }

        .barcode {
            position: absolute;
            top: 50pt;
            width: 45px;
            background: #fff;
            left: 1.5rem;
        }

        .telepon {
            position: absolute;
            top: 117pt;
            left: 1.5rem;
            font-family: 'Play', sans-serif;
            font-size: 12pt;
            text-transform: uppercase;
            color: #fff;
            font-weight: 400;
        }

        .nama {
            position: absolute;
            top: 100pt;
            left: 1.5rem;
            font-family: 'Play', sans-serif;
            font-size: 12pt;
            text-transform: uppercase;
            width: 250px;
            color: #fff;
            font-weight: 400;
            /* background: #fff; */
        }

    </style>
</head>

<body>
    <section style="border:1px solid #fff">
        <table width="100%">
            @foreach ($datamember as $key => $data)
                <tr>
                    @foreach ($data as $item)
                        <td class="text-center" width=50%>
                            <div class="box">
                                <img src="{{ asset('image/member.png') }}" alt="card" width="100%">
                                <div class="item">
                                    <div class="barcode text-left">
                                        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG("$item->kode_member", 'QRCODE') }}"
                                            alt="QRCODE" height="45" widht="45">
                                    </div>
                                    <div class="nama">{{ $item->nama }}</div>
                                    <div class="telepon">{{ $item->telepon }}</div>
                                </div>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </section>
</body>

</html>
