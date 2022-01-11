<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ss</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body p-1">
                        <div class="form-group mb-0">
                            <label for="nama_produk">Nama</label>
                            <input type="text" class="form-control" id="nama_produk" placeholder="nama_produk"
                                name="nama_produk" autofocus required>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="form-group mb-0">
                            <label for="id_kategori">Kategori</label>
                            <select name="id_kategori" id="id_kategori" class="form-control" required>
                                <option value="0">pilih Kategori</option>
                                @foreach ($kategori as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="form-group mb-0">
                            <label for="merk">Merk</label>
                            <input type="text" class="form-control" id="merk" placeholder="merk" name="merk" required>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="form-group mb-0">
                            <label for="harga_beli">Harga beli</label>
                            <input type="number" class="form-control" id="harga_beli" placeholder="harga beli"
                                name="harga_beli" required>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="form-group mb-0">
                            <label for="harga_jual">Harga jual</label>
                            <input type="number" class="form-control" id="harga_jual" placeholder="harga beli"
                                name="harga_jual" required>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="form-group mb-0">
                            <label for="diskon">Diskon</label>
                            <input type="number" class="form-control" id="diskon" placeholder="harga beli"
                                name="diskon" required value="0">
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="form-group mb-0">
                            <label for="stock">stock</label>
                            <input type="number" class="form-control" id="stock" placeholder="harga beli" name="stock"
                                required value="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-flat btn-secondary" data-dismiss="modal">batal</button>
                    <button class="btn btn-flat btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_kategori" class="col-lg-2 col-lg-offset-1 control-label">Kategori</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required
                                autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i
                            class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div> --}}
