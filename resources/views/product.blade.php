@extends('layout-app')

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="col-10">
            <div class="d-flex justify-content-between mb-5">
                <button class="btn btn-success">Import Data From API</button>
                <button class="btn btn-primary">Add Data</button>
            </div>
            <table id="table-produk" class="table table-striped"></table>
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
    </script>
@endpush
