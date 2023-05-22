@extends('dashboard.layouts.app')


@section('css')
    <style>
        .dataTables_filter {
            background-color: #1f2937;
            color: white;
        }
        label{
            color: white;
        }
    </style>
@endsection

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <div class="container mt-5">

        <table id="productTable" class="table table-striped table-dark"  style="width:100%" >
            <thead>
            <tr>
                <th>Ürün Adı</th>
                <th>Kategori</th>
                <th>Düzenle</th>
                <th>Sil</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.index') }}",
                columns: [
                    { data: 'product_name', name: 'product_name' },
                    { data: 'category.category_name', name: 'category.category_name' },
                    // { data: 'action', name: 'action', orderable: false, searchable: false }
                    { data: 'edit', name: 'edit', orderable: false, searchable: false },
                    { data: 'delete', name: 'delete', orderable: false, searchable: false }
                ]
            });
        })
    </script>
@endsection
