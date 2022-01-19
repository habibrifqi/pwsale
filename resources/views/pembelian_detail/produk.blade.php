<div class="modal fade" id="modal-produk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table_produk table-striped table-bordered">
                    <thead>
                        <th width="2%">No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga beli</th>
                        <th max-width="50px"><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($produk as $key => $item)
                            <tr>
                                <td width="2%">{{ $key + 1 }}</td>
                                <td><span class="badge bg-success">{{ $item->kode_produk }}</span></td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->harga_beli }}</td>
                                <td>
                                    {{-- <button type="button"
                                        onclick="pilihProduk('{{ $item->id_produk }}','{{ $item->kode_produk }}')"
                                        style="width: 100%" class="btn btn-primary btn-xs btn-flat">
                                        <i class="fa fa-check-circle"></i>
                                        pilih
                                    </button> --}}
                                    <a href="#" type="button"
                                        onclick="pilihProduk('{{ $item->id_produk }}','{{ $item->kode_produk }}')"
                                        style="width: 100%" class="btn btn-primary btn-xs btn-flat">
                                        <i class="fa fa-check-circle"></i>
                                        pilih
                                    </a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

                {{-- <div class="card-body p-1">
                    <div class="form-group">
                        <label for="nama">Nama member</label>
                        <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" autofocus
                            required>
                    </div>

                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" id="telepon" placeholder="telepon" name="telepon"
                            autofocus required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3"></textarea>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
