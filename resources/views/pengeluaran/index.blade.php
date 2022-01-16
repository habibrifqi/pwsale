@extends('layouts/master')

@section('title')
    Pengeluaran
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pengeluaran</li>
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
                        <button onclick="addForm('{{ route('pengeluaran.store') }}')"
                            class="btn btn-success xs btn-flat"><i class="fa fa-plus-circle"></i>
                            Tambah</button>
                    </div>
                    <div class="box-body table-responsive p-3">
                        <table class="table table-stiped table-bordered">
                            <thead>
                                <th widht="5%">no</th>
                                <th>deskripsi</th>
                                <th>nominal</th>
                                <th>tanggal</th>
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
    {{-- <button type="button" class="btn btn-success toastrDefaultSuccess">
        Launch Success Toast
    </button> --}}
@endsection
@includeIf('pengeluaran.form')


@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let table;
        let jenis = "kosong"


        $(function() {
            table = $('.table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pengeluaran.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'deskripsi'
                    },
                    {
                        data: 'nominal'

                    },
                    {
                        data: 'created_at'

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
                            if (jenis == 'tambah_data') {
                                toastr.success('data berhasil di tambah');
                                toastr.options.timeOut = 1000;
                                table.ajax.reload();
                                return;
                            }
                            toastr.success('data berhasil di edit');
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('Tidak dapat menyimpan data');
                            return;
                        });
                }
            });

        });

        function addForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Tambah pengeluaran');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=deskripsi]').focus();
            jenis = "tambah_data";
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit pengeluaran');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=deskripsi]').focus();
            jenis = "edit_data";
            $.get(url)
                .done((response) => {
                    $('#modal-form [name=deskripsi]').val(response.deskripsi);
                    $('#modal-form [name=nominal]').val(response.nominal);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
        }

        function deleteData(url) {
            Swal.fire({
                title: 'Yakin Sayang?',
                text: "mau di hapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Ngak jadi',
                confirmButtonText: 'yaaa',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
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
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }
    </script>
@endpush
