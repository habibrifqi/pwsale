@extends('layouts/master')

@section('title')
    Dafter Produk
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
    {{-- @dump($kategori); --}}
    <div class="container-fluid">
        <!-- /.row -->
        {{-- monly recap --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-group">
                            <button onclick="addForm('{{ route('produk.store') }}')" class="btn btn-success xs btn-flat"><i
                                    class="fa fa-plus-circle"></i>
                                Tambah</button>

                            <button onclick="deleteSelected('{{ route('produk.delete_selected') }}')"
                                class="btn btn-danger xs btn-flat"><i class="fa fa-trash"></i>
                                hapus</button>
                            <button onclick="cetakBarcode('{{ route('produk.cetak_barcode') }}')"
                                class="btn btn-primary xs btn-flat"><i class="fa fa-barcode"></i>
                                cetak barcode</button>
                        </div>
                    </div>
                    <div class="box-body table-responsive p-3">
                        <form class="form-produk" method="post" action="">
                            @csrf
                            <table class="table table-stiped table-bordered">
                                <thead>
                                    <th>
                                        <div class="p-1">
                                            <input type="checkbox" name="select_all" id="select_all">
                                        </div>
                                    </th>
                                    <th widht="5%">no</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kategory</th>
                                    <th>Merk</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Diskon</th>
                                    <th>Stok</th>
                                    <th widht="15%"> <i class="fa fa-cog"></i></th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
@endsection
@includeIf('produk.form')


@push('scripts')
    <script>
        let table;
        $(function() {
            table = $('.table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('produk.data') }}',
                },
                columns: [{
                        data: 'select_all',
                        searchable: false,
                        sortable: false
                    },
                    {
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
                        data: 'nama_kategori'
                    },
                    {
                        data: 'merk'
                    },
                    {
                        data: 'harga_beli'
                    },
                    {
                        data: 'harga_jual'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'stock'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });
            $('#modal-form').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                        .done((response) => {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak dapat menyimpan data');
                            return;
                        });
                }
            });

            $('[name=select_all]').on('click', function() {
                $(':checkbox').prop('checked', this.checked);
            })
        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah Produk');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nama_produk]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Produk');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=nama_produk]').focus();
            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama_produk]').val(response.nama_produk);
                    $('#modal-form [name=id_kategori]').val(response.id_kategori);
                    $('#modal-form [name=merk]').val(response.merk);
                    $('#modal-form [name=harga_beli]').val(response.harga_beli);
                    $('#modal-form [name=harga_jual]').val(response.harga_jual);
                    $('#modal-form [name=diskon]').val(response.diskon);
                    $('#modal-form [name=stock]').val(response.stock);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
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

        function deleteSelected(url) {
            if ($('input:checked').length > 1) {
                if (confirm('yakin mau di hapus nih?')) {
                    $.post(url, $('.form-produk').serialize())
                        .done((response) => {
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('tidak dapat menghapus sayang');
                            return;
                        })
                }

            } else {
                alert('pilih data yg akan di hapus sayang');
                return;
            }
        }

        function cetakBarcode(url) {
            if ($('input:checked').length < 1) {
                console.log('1');
                alert('pilih data yg akan di cetak sayang');
                return;
            } else if ($('input:checked').length < 3) {
                console.log('3');
                alert('pilih data minimal 3 sayang');
                return;
            } else {
                console.log('4');
                $('.form-produk')
                    .attr('action', url)
                    .attr('target', '_black')
                    .submit();
            }
        }
    </script>
@endpush
