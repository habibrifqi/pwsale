@extends('layouts/master')

@section('title')
    Pembelian
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pembelian</li>
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
                        <button onclick="addForm()" class="btn btn-success xs btn-flat"><i class="fa fa-plus-circle"></i>
                            Transaksi Baru</button>
                        @empty(!session('id_pembelian'))
                            <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info xs btn-flat"><i
                                    class="fa fa-plus-circle"></i>
                                Transaksi aktif</a>
                        @endempty

                    </div>
                    <div class="box-body table-responsive p-3">
                        <table class="table table-pembelian table-stiped table-bordered">
                            <thead>
                                <th max-width="5%">no</th>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Total item</th>
                                <th>Total Harga</th>
                                <th>Diskon</th>
                                <th>Total Bayar</th>
                                <th widht="15%"> <i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
    @includeIf('pembelian.detail')
    @includeIf('pembelian.supplier')
@endsection



@push('scripts')
    <script>
        let table, table1;
        $(function() {
            table = $('.table-pembelian').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pembelian.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'tanggal'
                    },
                    {
                        data: 'supplier'

                    },
                    {
                        data: 'total_item'
                    },
                    {
                        data: 'total_harga'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'bayar'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });
            $('.table-supplier').DataTable();
            table1 = $('.table-detail').DataTable({
                processing: true,
                bSort: false,
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
                ]
            });

        });

        function addForm() {
            $('#modal-supplier').modal('show');
        }

        function showDetail(url) {
            $('#modal-detail').modal('show');

            table1.ajax.url(url);
            table1.ajax.reload();
        }

        // function editForm(url) {
        //     $('#modal-form').modal('show');
        //     $('#modal-form .modal-title').text('Edit supplier');
        //     $('#modal-form form')[0].reset();
        //     $('#modal-form form').attr('action', url);
        //     $('#modal-form [name=_method]').val('put');
        //     $('#modal-form [name=namma]').focus();
        //     $.get(url)
        //         .done((response) => {
        //             $('#modal-form [name=nama]').val(response.nama);
        //             $('#modal-form [name=telepon]').val(response.telepon);
        //             $('#modal-form [name=alamat]').val(response.alamat);
        //         })
        //         .fail((errors) => {
        //             alert('Tidak dapat menampilkan data');
        //             return;
        //         });
        // }

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
    </script>
@endpush
