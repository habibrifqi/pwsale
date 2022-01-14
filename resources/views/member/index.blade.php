@extends('layouts/master')

@section('title')
    Member
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Member</li>
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
                        <button onclick="addForm('{{ route('member.store') }}')" class="btn btn-success xs btn-flat"><i
                                class="fa fa-plus-circle"></i>
                            Tambah</button>
                        <button onclick="cetakMember('{{ route('member.cetak_member') }}')"
                            class="btn btn-info xs btn-flat"><i class="fa fa-id-card"></i>
                            Cetak Member</button>
                    </div>
                    <div class="box-body table-responsive p-3">
                        <form class="form-member" method="post" action="">
                            @csrf
                            <table class="table table-stiped table-bordered">
                                <thead>
                                    <th widht="5%">
                                        <div class="p-1">
                                            <input type="checkbox" name="select_all" id="select_all">
                                        </div>
                                    </th>
                                    <th widht="5%">no</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>telepon</th>
                                    <th>Alamat</th>
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
    <img src="{{ asset('image/member.png') }}" alt="card">
@endsection
@includeIf('member.form')


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
                    url: '{{ route('member.data') }}',
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
                        data: 'kode_member'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'telepon'
                    },
                    {
                        data: 'alamat'
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
            $('#modal-form .modal-title').text('Tambah member');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('post');
            $('#modal-form [name=nama]').focus();
        }

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Kategori');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=namma]').focus();
            $.get(url)
                .done((response) => {
                    $('#modal-form [name=nama]').val(response.nama);
                    $('#modal-form [name=telepon]').val(response.telepon);
                    $('#modal-form [name=alamat]').val(response.alamat);
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

        function cetakMember(url) {
            if ($('input:checked').length < 1) {
                console.log('1');
                alert('pilih data yg akan di cetak sayang');
                return;
            } else {
                console.log('4');
                $('.form-member')
                    .attr('action', url)
                    .attr('target', '_black')
                    .submit();
            }
        }
    </script>
@endpush
