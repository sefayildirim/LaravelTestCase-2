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


      <!-- Create Category Modal -->
      <x-category-create-modal />

      <table id="categoryTable" class="table table-striped table-dark"  style="width:100%" >
          <thead>
              <tr>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Düzenle</th>
                  <th>Sil</th>
              </tr>
          </thead>
      </table>
  </div>


    <!-- Edit User Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Kategoriyi Düzenle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm">
                    <input type="hidden" id="editCategoryId" name="editCategoryId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editName" class="col-form-label text-dark">Kategori Adı:</label>
                            <input type="text" class="form-control" id="editName" name="editName">
                        </div>
                        <div class="mb-3">
                            <label for="editType" class="col-form-label text-dark">Kategori Tipi:</label>
                            <input type="text" class="form-control" id="editType" name="editType">
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
            $('#categoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category.index') }}",
                columns: [
                    { data: 'category_name', name: 'category_name' },
                    { data: 'category_type', name: 'category_type' },
                    // { data: 'action', name: 'action', orderable: false, searchable: false }
                    { data: 'edit', name: 'edit', orderable: false, searchable: false },
                    { data: 'delete', name: 'delete', orderable: false, searchable: false }
                ]
            });

            // Edit Category
            $('#categoryTable').on('click', '.edit', function() {
                var categoryId = $(this).data('id');
                $.ajax({
                    url: "{{ route('category.edit', '') }}/" + categoryId,
                    type: "GET",
                    success: function(data) {
                        $('#editModal').modal('show');
                        $('#editCategoryId').val(data.id);
                        $('#editName').val(data.category_name);
                        $('#editType').val(data.category_type);
                    }
                });
            });

            // Update Category
            $('#editForm').submit(function(e) {
                e.preventDefault();
                var categoryId = $('#editCategoryId').val();
                var formData = {
                    category_name: $('#editName').val(),
                    category_type: $('#editType').val()
                };
                formData._token = '{{ csrf_token() }}'; // CSRF token'ı formData'ya ekle

                $.ajax({
                    url: "{{ route('category.update', '') }}/" + categoryId,
                    type: "PUT",
                    data: formData,
                    success: function(data) {
                        $('#editModal').modal('hide');
                        $('#categoryTable').DataTable().ajax.reload();
                        //alert(data.success);
                    }
                });
            });

            // Delete Category
            $('#categoryTable').on('click', '.delete', function() {
                var categoryId = $(this).data('id');
                if (confirm("Kategoriyi silmek istediğinize emin misiniz?")) {
                    $.ajax({
                        url: "{{ route('category.destroy', '') }}/" + categoryId,
                        type: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            $('#categoryTable').DataTable().ajax.reload();
                            alert(data.success);
                        }
                    });
                }
            });

        });
    </script>

@endsection

