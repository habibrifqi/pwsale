<div class="modal fade" id="modal-member" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-member">
                    <thead>
                        <th max-width="5%">No</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>alamat</th>
                        <th max-width="50px"><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($member as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->telepon }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <a href="#" type="button"
                                        onclick="pilihMember('{{ $item->id_member }}','{{ $item->kode_member }}')"
                                        style="width: 100%" class="btn btn-primary btn-xs btn-flat">
                                        <i class="fa fa-check-circle"></i>
                                        pilih
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
