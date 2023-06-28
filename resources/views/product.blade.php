@extends('layout-app')

@section('content')
    <div class="d-flex justify-content-center mt-5 mb-5">
        <div class="col-10">
            <div class="d-flex justify-content-end mb-5">
                <button class="btn btn-primary btn-action" id="add-produk" data-action="add">Tambah Produk</button>
            </div>
            <table id="table-produk" class="table table-striped"></table>
        </div>
    </div>

    <div class="modal fade" id="modal-form-produk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Tambah Produk</h5>
            <button type="button" class="close close-modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="form-produk" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama Produk</label>
                    <input type="text" class="form-control" name="nama_produk" id="nama_produk">
                </div>
                <div class="mb-3">
                    <label for="">Kategori</label>
                    <input type="text" class="form-control" name="kategori" id="kategori">
                </div>
                <div class="mb-3">
                    <label for="">Harga</label>
                    <input type="text" class="form-control" name="harga" id="harga">
                </div>
                {{-- <div class="mb-3">
                    <label for="">Status</label>
                    <input type="text" class="form-control" name="status" id="status">
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal">Close</button>
                <button type="submit" class="btn btn-primary" id="save-produk">Simpan</button>
            </div>
        </form>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            dataTable = $('#table-produk').DataTable({
                order: [[0, 'desc']],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{url()->current()}}'
                },
                columns: [
                    {data: 'id_produk', name: 'id_produk', title: 'id_produk' },
                    {data: 'nama_produk', name: 'nama_produk', title: 'Nama Produk' },
                    {data: 'kategori', name: 'kategori', title: 'Kategori' },
                    {data: 'harga', name: 'harga', title: 'Harga' },
                    {data: 'status', name: 'status', title: 'Status' },
                    {data: 'action', name: 'action', title: 'Aksi' },
                ],
                columnDefs: [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    }
                ]

            });

        });
        function ajaxPost(url, data){
            $.ajax({
                type: 'POST',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                error: function(err) {
                    $('#save-produk').removeClass('disabled');
                    Swal.fire(
                        'Error!',
                        err.responseJSON.message,
                        'error'
                    );

                },
                success: function(response) {
                    if (response.status == 200 || response.status == 201) {

                        $('#save-produk').removeClass('disabled');
                        $('#modal-form-produk').modal('toggle');
                        $('#form-produk')[0].reset();

                        Swal.fire(
                            'Success!',
                            response.message,
                            'success'
                        );

                        $('#table-produk').DataTable().ajax.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            err.responseJSON.message,
                            'error'
                        );
                    }
                }
            })
        }

        $(document).on('click', '.close-modal', function(){
            $('#modal-form-produk').modal('toggle');

        })

        $(document).on('click', '#refresh', function () {
            $('#table-produk').DataTable().ajax.reload();
         })

        var state
        $(document).on('click', '.btn-action', function(){
            var action = $(this).data('action');
            if( action === 'add' ) {
                $('#form-produk')[0].reset();
                $('#modal-form-produk').modal('toggle');
                $('#form-produk').removeAttr('data-id');
            }

            if( action === 'update' ) {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var kategori = $(this).data('kategori');
                var harga = $(this).data('harga');
                $('#nama_produk').val(nama);
                $('#kategori').val(kategori);
                $('#harga').val(harga);
                $('#modal-form-produk').modal('toggle');
                $('#form-produk').attr('data-id', id);
            }

            state = action;
            $('#form-produk').attr('data-action', action);
        });

        $('#form-produk').submit(function(e) {
            e.preventDefault();
            $('#save-produk').addClass('disabled');
            var action = state;
            var url = '';
            var data = new FormData(this);

            if( action === 'add' ) {
                url = "{{ route('store.product') }}";

            } else if( action === 'update' ) {
                var id = $(this).data('id');
                url = "{{ route('update.product', [':id']) }}";
                url = url.replace(':id', id);
            }

            ajaxPost(url, data);

        });

        $(document).on('click', '.btn-delete', function(){
            Swal.fire({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-light'
                },
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data("id");
                    var token = $("meta[name='csrf-token']").attr("content");

                    var url = "{{ route('destroy.product') }}"
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: token,
                            id: id
                        },
                        error: function(err) {
                            Swal.fire(
                                'Error!',
                                'Gagal',
                                'error'
                            );

                        },
                        success: function(response) {
                            Swal.fire({
                                customClass: {
                                    confirmButton: 'btn btn-danger',
                                },
                                title: 'Success',
                                text: "Data telah terhapus",
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });

                            $('#table-produk').DataTable().ajax.reload();
                        }
                    });
                    return false;
                }
            })
        })
    </script>
@endpush
