@extends('layouts/master')

@section('title')
    Transaksi Penjualan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Transaksi Penjualan</li>
@endsection


@section('content')
    <style>
        .center {
            text-align: center;
        }

    </style>
    <div class="container-fluid">
        <!-- /.row -->
        {{-- monly recap --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="alert alert-success" role="alert">
                            Transaksi selesai
                        </div>
                        @if ($setting->tipe_nota == 1)
                            <button onclick="notaKecil('{{ route('transaksi.nota_kecil') }}', 'nota_kecil')"
                                class="btn  btn-success"><i class="fa fa-plus-circle"></i>
                                Transaksi Baru</button>
                        @else
                            <button onclick="notaBesar('{{ route('transaksi.nota_besar') }}', 'nota_besar')"
                                class="btn  btn-success"><i class="fa fa-plus-circle"></i>
                                Transaksi Baru</button>
                        @endif

                        <a href="{{ route('transaksi.baru') }}" class="btn btn-primary">Transaksi baru</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
    @includeIf('pembelian.detail')
    {{-- @includeIf('pembelian.supplier') --}}
@endsection



@push('scripts')
    <script>
        function notaKecil(url, title) {
            popupCenter(url, title, 720, 675);
        }

        function notaBesar() {
            popupCenter(url, title, 720, 675);
        }

        function popupCenter(url, title, w, h) {
            const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
            const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

            const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document
                .documentElement.clientWidth : screen.width;
            const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document
                .documentElement.clientHeight : screen.height;

            const systemZoom = width / window.screen.availWidth;
            const left = (width - w) / 2 / systemZoom + dualScreenLeft
            const top = (height - h) / 2 / systemZoom + dualScreenTop
            const newWindow = window.open(url, title,
                `
                scrollbars=yes,
                width   =${w / systemZoom}, 
                height  =${h / systemZoom}, 
                top     =${top}, 
                left    =${left}
                `
            )

            if (window.focus) newWindow.focus();
        }
    </script>
@endpush
