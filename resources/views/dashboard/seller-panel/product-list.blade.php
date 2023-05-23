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
    @php
        $category_names = [];
        foreach ($categories as $category) {
            $category_names[] = $category->category_name;
        }
    @endphp

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <div class="container mt-5">
        <!-- Create Category Modal -->
        @component('components.product-create-modal', ['category_names' => $category_names])@endcomponent

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

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Kategoriyi Düzenle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm">
                    <input type="hidden" id="editProductId" name="editProductId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editName" class="col-form-label text-dark">Ürün Adı:</label>
                            <input type="text" class="form-control" id="editName" name="editName">
                        </div>
                        <div class="mb-3">
                            <label for="editCategory" class="col-form-label text-dark">Kategori:</label>
                            <select class="form-select" aria-label="Default select example" id="editCategory">
                                @foreach($category_names as $name)
                                    <option value="{{ $name }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Güncelle</button>

                    </div>
                </form>
            </div>
        </div>
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

        // Edit Category
        $('#productTable').on('click', '.edit', function() {
            var productId = $(this).data('id');
            $.ajax({
                url: "{{ route('product.edit', '') }}/" + productId,
                type: "GET",
                success: function(data) {
                    $('#editModal').modal('show');
                    $('#editCategoryId').val(data.id);
                    $('#editName').val(data.product_name);
                    $('#editCategory').val(data.category_name);
                }
            });
        });

        // Update Category
        $('#editForm').submit(function(e) {
            e.preventDefault();
            var productId = $('#editProductId').val();
            var formData = {
                product_name: $('#editName').val(),
                category_name: $('#editCategory').val()
            };
            formData._token = '{{ csrf_token() }}'; // CSRF token'ı formData'ya ekle

            $.ajax({
                url: "{{ route('product.update', '') }}/" + productId,
                type: "PUT",
                data: formData,
                success: function(data) {
                    $('#editModal').modal('hide');
                    $('#productTable').DataTable().ajax.reload();
                    //alert(data.success);
                }
            });
        });

        // Delete Category
        $('#productTable').on('click', '.delete', function() {
            var productId = $(this).data('id');
            if (confirm("Ürünü silmek istediğinize emin misiniz?")) {
                $.ajax({
                    url: "{{ route('product.destroy', '') }}/" + productId,
                    type: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#productTable').DataTable().ajax.reload();
                        alert(data.success);
                    }
                });
            }
        });

        })
    </script>
@endsection
