@extends('layouts/master')

@section('title')
    Transaksi Pembelian
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Transaksi Pembelian</li>
@endsection
@push('css')
    <style>
        .tampil-bayar {
            font-size: 5em;
            text-align: center;
            height: 100px;
        }

        .tampil-terbilang {
            padding: 15px;
            background: #f0f0f0;
        }

        .berbayar {
            padding-left: 1.5em;
            padding-right: 1.5em;
        }

        .des-rp {
            padding-left: 1.5em;
            padding-right: 1.5em;
        }

        .table_pembelian_detail tbody tr:last-child {
            display: none;
        }

        @media(max-width : 768) {
            .tampil-bayar {
                font-size: 3em;
                height: 76px;
                padding-top: 5px;
            }

            .berbayar {
                padding: 0;
            }
        }

    </style>
@endpush


@section('content')
    <style>
        .center {
            text-align: center;
        }

        dl.row.pb-0.mb-0 {
            /* font-size: 14px; */
        }

        .ss {
            margin-top: -5px
        }

        .kode-box-produk {
            margin-top: -5px
        }

    </style>
    <div class="container-fluid">
        <!-- /.row -->
        {{-- monly recap --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body pb-0">
                        {{-- <b>asdas</b><b>asdas</b>
                        <br>
                        <b>asdas</b><b>asdas</b>
                        <br>
                        <b>asdas</b><b>asdas</b> --}}
                        {{-- <dl class="row pb-0 mb-0">
                            <dt class="col-sm-1">Supplier</dt>
                            <dt class="col-sm-0.1">:</dt>
                            <dd class="col-sm-10">{{ $supplier->nama }}</dd>

                            <dt class="col-sm-1 ss">telepon</dt>
                            <dt class="col-sm-0.1 ss">:</dt>
                            <dd class="col-sm-10 ss">{{ $supplier->telepon }}</dd>

                            <dt class="col-sm-1 ss">Alamat</dt>
                            <dt class="col-sm-0.1 ss">:</dt>
                            <dd class="col-sm-10 ss">{{ $supplier->alamat }}</dd>

                        </dl> --}}
                        <table>
                            <tr>
                                <td>Supplier</td>
                                <td>{{ $supplier->nama }}</td>
                            </tr>
                            <tr>
                                <td>telepon</td>
                                <td>{{ $supplier->telepon }}</td>
                            </tr>
                            <tr>
                                <td>alamat</td>
                                <td>{{ $supplier->alamat }}</td>
                            </tr>


                        </table>
                    </div>

                    <div class="box-body table-responsive pb-3 pr-3 pl-3 pt-1">
                        <div class="form-group mb-0">
                            <form action="" class="form-produk ">
                                <div style="" class="row d-flex align-items-center">
                                    <div class="col-sm-12 col-lg-1.5 kode-box-produk">
                                        <label for="kode_produk">Kode Produk :</label>
                                    </div>
                                    <div class="col-sm-12 col-lg-10">
                                        <div class="input-group mb-3">
                                            <!-- /btn-group -->

                                            @csrf
                                            {{-- @method('POST') --}}
                                            <input type="hidden" name="id_produk" id="id_produk">
                                            <input type="hidden" name="id_pembelian" id="id_pembelian"
                                                value="{{ $id_pembelian }}">
                                            <input type="text" class="form-control" name="kode_produk" id="kode_produk"
                                                placeholder="Produk">
                                            <div class="input-group-prepend">
                                                <button onclick="tampilProduk()" type="button" class="btn btn-success"><i
                                                        class="fa fa-arrow-right"></i></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <table class="table table_pembelian_detail table-stiped table-bordered">
                            <thead>
                                <th width="5%">no</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th min-width="100px" width="15%">jumlah</th>
                                <th>Sub total</th>
                                <th widht="15%"> <i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-sm-12 berbayar">
                            <div class="tampil-bayar bg-primary d-flex align-items-center justify-content-center">

                            </div>
                            <div class="tampil-terbilang d-flex align-items-center justify-content-center">
                            </div>
                        </div>
                        <div class="col-lg-4 pr-4 col-sm-12 des-rp">
                            <form action="{{ route('pembelian.store') }}" class="form-pembelian" method="post">
                                @csrf
                                <input type="hidden" name="id_pembelian" value="{{ $id_pembelian }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="bayar" id="bayar">
                                <div class="form-group row">
                                    <label for="totalrp" class="col-lg-3 control-label">Total</label>
                                    <div class="col-lg-9">
                                        <input type="text" id="totalrp" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diskon" class="col-lg-3 control-label">Diskon</label>
                                    <div class="col-lg-9">
                                        <input type="number" name="diskon" id="diskon" value="0" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bayarrp" class="col-lg-3 control-label">bayar</label>
                                    <div class="col-lg-9">
                                        <input type="text" id="bayarrp" class="form-control" readonly>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="box-footer d-flex justify-content-end pr-3 pb-3">
                                <button type="submit" class="p-2 btn btn-primary btn-sm btn-flat pull-right btn-simpan">
                                    {{-- <i class="fa fa-flopy-o"></i> --}}
                                    simpan transaksi
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
    {{-- @dump($supplier); --}}
@endsection
@includeIf('pembelian_detail.produk')


@push('scripts')
    <script>
        let table, table2;
        $(function() {
            table = $('.table_pembelian_detail').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: {
                        url: '{{ route('pembelian_detail.data', $id_pembelian) }}',
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            searchable: false,
                            sortable: false
                        },
                        {
                            data: 'kode_produk'
                        },
                        {
                            data: 'nama_produk'
                        },
                        {
                            data: 'harga_beli'
                        },
                        {
                            data: 'jumlah'
                        },
                        {
                            data: 'subtotal'
                        },
                        {
                            data: 'aksi',
                            searchable: false,
                            sortable: false
                        },
                    ],
                    // dom: 'Brt',
                    select: true,
                    dom: 'lrtip',
                    responsive: true,
                    lengthChange: false,
                    bSort: false,
                    buttons: true,
                    bInfo: false
                })
                .on('draw.dt', function() {
                    loadform($('#diskon').val())
                })
            table2 = $('.table_produk').DataTable();

            $(document).on('change', '.quantity', function() {
                let id = $(this).data('id');
                let jumlah = parseInt($(this).val());

                if (jumlah > 10000) {
                    alert('jumlah tidak boleh terlalu banyak sayang');
                    jumlah = 10000;
                    return;
                }
                if (jumlah < 1) {
                    alert('jumlah min 1 sayang');
                    table.ajax.reload();
                    return;
                }
                console.log(jumlah);
                $.post(`{{ url('/pembelian_detail') }}/${id}`, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'put',
                        'jumlah': jumlah
                    })
                    .done(response => {
                        // $(this).on('mouseout', function() {
                        //     table.ajax.reload();
                        // });
                        table.ajax.reload();

                    })
                    .fail(response => {
                        alert('tidak dapat menganti data');
                        return;
                    });

            });

            $(document).on('input', '#diskon', function() {
                if ($(this).val() == "") {
                    $(this).val(0).select();
                }

                loadform($(this).val());
            })

            $('.btn-simpan').on('click', function() {
                $('.form-pembelian').submit();
                console.log('sadfas');
            })

        });


        function tampilProduk() {
            $('#modal-produk').modal('show');
        }

        function hideProduk() {
            $('#modal-produk').modal('hide');
        }

        function pilihProduk(id, kode) {
            $('#id_produk').val(id);
            $('#kode_produk').val(kode);
            tambahProduk();

            hideProduk();
        }

        function tambahProduk() {
            $.post('{{ route('pembelian_detail.store') }}', $('.form-produk').serialize())
                .done((response) => {
                    $('#kode_produk').focus();
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('tidak dapet menyimpan data blogk');
                    return;
                });
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }

        function loadform(diskon = 0) {
            $('#total').val($('.total').text());
            $('#total_item').val($('.total_item').text());

            $.get(`{{ url('/pembelian_detail/loadform') }}/${diskon}/${$('.total').text()}`)
                .done(response => {
                    $('#totalrp').val('Rp. ' + response.totalrp);
                    $('#bayar').val(response.bayar);
                    // console.log(response.bayar);
                    $('#bayarrp').val('Rp. ' + response.totalrp);
                    $('.tampil-bayar').text('Rp. ' + response.bayarrp);
                    $('.tampil-terbilang').text('Rp. ' + response.terbilang);
                })
                .fail(errors => {
                    alert('data salah');
                    return;
                })
        }
    </script>
@endpush
