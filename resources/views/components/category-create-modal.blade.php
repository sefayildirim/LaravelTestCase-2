<button class="mb-3 btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Yeni Kategori</button>

<!-- Create User Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="categoryCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="categoryCreateLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category-name" class="col-form-label text-dark">Kategori Adı:</label>
                        <input type="text" name="category_name" class="form-control" id="category-name">
                    </div>
                    <div class="mb-3">
                        <label for="category-type" class="col-form-label text-dark">Kategori Tipi:</label>
                        <input type="text" name="category_type" class="form-control" id="category-type">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-light">
                        Yeni Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    addEventListener("DOMContentLoaded", function(e) {
        $(document).ready(function() {
            // Create Category
            $('#createForm').submit(function(e) {
                e.preventDefault();
                var formData = {
                    category_name: $('#category-name').val(),
                    category_type: $('#category-type').val()
                };

                formData._token = '{{ csrf_token() }}'; // CSRF token'ı formData'ya ekle

                $.ajax({
                    url: "{{ route('category.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        $('#createModal').modal('hide');
                        $('#createForm').trigger('reset');
                        $('#categoryTable').DataTable().ajax.reload();
                        //alert(data.success);
                    }
                });
            });
        });
    });

</script>
