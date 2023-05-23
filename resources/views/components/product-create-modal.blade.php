<button class="mb-3 btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">Yeni Ürün</button>

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
                        <label for="product-name" class="col-form-label text-dark">Ürün Adı:</label>
                        <input type="text" name="product_name" class="form-control" id="product-name">
                    </div>
                    <div class="mb-3">
                        <label for="category-name" class="col-form-label text-dark">Ürün Kategorisi</label>
                        <select class="form-select" aria-label="Default select example" id="category-name">
                            @foreach($category_names as $name)
                                <option value="{{ $name }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-light">
                        Yeni Ürün
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    addEventListener("DOMContentLoaded", function(e) {
        $(document).ready(function() {
            // Create Product
            $('#createForm').submit(function(e) {
                e.preventDefault();
                var formData = {
                    product_name: $('#product-name').val(),
                    category_name: $('#category-name').val()
                };

                formData._token = '{{ csrf_token() }}'; // CSRF token'ı formData'ya ekle

                $.ajax({
                    url: "{{ route('product.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        $('#createModal').modal('hide');
                        $('#createForm').trigger('reset');
                        $('#productTable').DataTable().ajax.reload();
                        //alert(data.success);
                    }
                });
            });
        });
    });

</script>
