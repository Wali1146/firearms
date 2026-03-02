<?php echo view('templates/main'); ?>
<div class="container-fluid mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Products Management</h2>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#productModal">
                <i class="fas fa-plus"></i> Add New Product
            </button>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Products Table -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Team</th>
                        <th>Price</th>
                        <th>Created At</th>
                        <th style="width: 15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products) && is_array($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['id'] ?></td>
                                <td><?= htmlspecialchars($product['name']) ?></td>
                                <td>
                                    <span class="badge bg-info">
                                        <?= ucfirst($product['type']) ?>
                                    </span>
                                </td>
                                <td><?= $product['category_id'] ?></td>
                                <td><?= $product['team_id'] ?></td>
                                <td>$<?= number_format($product['price'], 2) ?></td>
                                <td><?= date('M d, Y', strtotime($product['created_at'])) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#productModal"
                                            data-product-id="<?= $product['id'] ?>" data-name="<?= htmlspecialchars($product['name']) ?>"
                                            data-type="<?= $product['type'] ?>" data-category-id="<?= $product['category_id'] ?>"
                                            data-team-id="<?= $product['team_id'] ?>" data-price="<?= $product['price'] ?>"
                                            data-description="<?= htmlspecialchars($product['description']) ?>" data-image="<?= $product['image'] ?>"
                                            onclick="editProduct(this)">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <a href="<?= base_url('admin/delete-product/' . $product['id']) ?>" class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <p class="text-muted">No products found</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/save-product') ?>" method="POST" enctype="multipart/form-data" id="productForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="productId" value="">

                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                        <div class="invalid-feedback" id="productNameError"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="productType" class="form-label">Type</label>
                            <select class="form-select" id="productType" name="type" required>
                                <option value="">Select Type</option>
                                <option value="subscription">Subscription</option>
                                <option value="course">Course</option>
                                <option value="firearms">Firearms</option>
                            </select>
                            <div class="invalid-feedback" id="productTypeError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="productPrice" name="price" step="0.01" required>
                            <div class="invalid-feedback" id="productPriceError"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="categoryId" class="form-label">Category ID</label>
                            <input type="number" class="form-control" id="categoryId" name="category_id" required>
                            <div class="invalid-feedback" id="categoryIdError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="teamId" class="form-label">Team ID</label>
                            <input type="number" class="form-control" id="teamId" name="team_id" required>
                            <div class="invalid-feedback" id="teamIdError"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="4" maxlength="1000"></textarea>
                        <small class="text-muted">Max 1000 characters</small>
                        <div class="invalid-feedback" id="productDescriptionError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="image" accept="image/*">
                        <small class="text-muted">Upload a new image or leave blank to keep existing</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editProduct(button) {
    document.getElementById('productModalLabel').textContent = 'Edit Product';
    document.getElementById('productId').value = button.dataset.productId;
    document.getElementById('productName').value = button.dataset.name;
    document.getElementById('productType').value = button.dataset.type;
    document.getElementById('categoryId').value = button.dataset.categoryId;
    document.getElementById('teamId').value = button.dataset.teamId;
    document.getElementById('productPrice').value = button.dataset.price;
    document.getElementById('productDescription').value = button.dataset.description;
}

document.getElementById('productModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('productModalLabel').textContent = 'Add New Product';
    document.getElementById('productForm').reset();
    document.getElementById('productId').value = '';
});
</script>

<?php echo view('templates/main'); ?>
