<?php echo view('templates/header'); ?>

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-lg">
                <div class="card-header bg-warning">
                    <h3 class="card-title text-dark mb-0">Edit Product</h3>
                </div>

                <div class="card-body p-4">
                    <!-- Validation Errors -->
                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h5>Validation Errors:</h5>
                            <ul class="mb-0">
                                <?php foreach ($validation->getErrors() as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Success Message -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($product)): ?>
                        <!-- Product Form -->
                        <form action="<?= base_url('admin/edit-product/' . $product['id']) ?>" method="POST" enctype="multipart/form-data" id="productForm">
                            <!-- Basic Information Section -->
                            <div class="section-divider mb-4">
                                <h5 class="text-dark mb-3">
                                    <i class="fas fa-cube"></i> Basic Information
                                </h5>

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name" 
                                           placeholder="e.g., R-15 Tactical Rifle" required 
                                           value="<?= htmlspecialchars($product['name'] ?? '') ?>">
                                    <small class="text-muted">3-255 characters required</small>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="type" class="form-label fw-bold">Product Type <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-lg" id="type" name="type" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="subscription" <?= ($product['type'] ?? '') === 'subscription' ? 'selected' : '' ?>>Subscription</option>
                                            <option value="course" <?= ($product['type'] ?? '') === 'course' ? 'selected' : '' ?>>Course</option>
                                            <option value="firearms" <?= ($product['type'] ?? '') === 'firearms' ? 'selected' : '' ?>>Firearms</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="price" class="form-label fw-bold">Price <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" id="price" name="price" 
                                                   placeholder="0.00" step="0.01" min="0" required 
                                                   value="<?= htmlspecialchars($product['price'] ?? '') ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label fw-bold">Product Description</label>
                                    <textarea class="form-control" id="description" name="description" 
                                              rows="5" placeholder="Describe your product..." maxlength="1000"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                                    <small class="text-muted">Max 1000 characters</small>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Classification Section -->
                            <div class="section-divider mb-4">
                                <h5 class="text-dark mb-3">
                                    <i class="fas fa-folder-open"></i> Classification
                                </h5>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="category_id" class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-lg" id="category_id" name="category_id" required>
                                            <option value="">-- Select Category --</option>
                                            <?php if (!empty($categories) && is_array($categories)): ?>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?= $category['id'] ?>" 
                                                            <?= ($product['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($category['name'] ?? 'Unnamed') ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="team_id" class="form-label fw-bold">Team <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-lg" id="team_id" name="team_id" required>
                                            <option value="">-- Select Team --</option>
                                            <?php if (!empty($teams) && is_array($teams)): ?>
                                                <?php foreach ($teams as $team): ?>
                                                    <option value="<?= $team['id'] ?>" 
                                                            <?= ($product['team_id'] ?? '') == $team['id'] ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($team['name'] ?? 'Unnamed') ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Image Upload Section -->
                            <div class="section-divider mb-4">
                                <h5 class="text-dark mb-3">
                                    <i class="fas fa-image"></i> Product Image
                                </h5>

                                <?php if (!empty($product['image'])): ?>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Current Image</label>
                                        <div>
                                            <img src="<?= base_url('assets/images/products/' . htmlspecialchars($product['image'])) ?>" 
                                                 alt="Current Product Image" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="image" class="form-label fw-bold">Upload New Product Image</label>
                                    <input type="file" class="form-control form-control-lg" id="image" name="image" 
                                           accept="image/*">
                                    <small class="text-muted">Leave blank to keep current image. Accepted formats: JPG, PNG, GIF, WebP. Max 5MB recommended.</small>
                                </div>

                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <label class="form-label fw-bold">New Image Preview</label>
                                    <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Product Meta Information -->
                            <div class="section-divider mb-4">
                                <h5 class="text-dark mb-3">
                                    <i class="fas fa-info-circle"></i> Product Information
                                </h5>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <p><strong>Product ID:</strong> <code><?= $product['id'] ?></code></p>
                                        <p><strong>Created At:</strong> <?= date('M d, Y H:i', strtotime($product['created_at'] ?? 'now')) ?></p>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Form Actions -->
                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-arrow-left"></i> Back to Products
                                </a>
                                <button type="reset" class="btn btn-outline-warning btn-lg">
                                    <i class="fas fa-redo"></i> Reset Changes
                                </button>
                                <button type="submit" class="btn btn-warning btn-lg">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                                <a href="<?= base_url('admin/delete-product/' . $product['id']) ?>" 
                                   class="btn btn-danger btn-lg" 
                                   onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.');">
                                    <i class="fas fa-trash"></i> Delete Product
                                </a>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            <h5>Product Not Found</h5>
                            <p>The product you're trying to edit does not exist or has been deleted.</p>
                            <a href="<?= base_url('admin/products') ?>" class="btn btn-primary">Go Back to Products</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Help Section -->
            <div class="card mt-4 bg-light">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fas fa-info-circle text-info"></i> Tips for Editing
                    </h6>
                    <ul class="small mb-0">
                        <li><strong>Product Name:</strong> Make changes that reflect current product offerings</li>
                        <li><strong>Price:</strong> Update pricing as needed, changes are effective immediately</li>
                        <li><strong>Image:</strong> Replace with a new image or leave blank to keep the current one</li>
                        <li><strong>Categories & Teams:</strong> Reassign as needed for better organization</li>
                        <li><strong>Delete:</strong> Use the delete button carefully - this action cannot be undone</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .section-divider {
        background-color: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.5rem;
        border-left: 4px solid #ffc107;
    }

    .form-control-lg, .form-select-lg {
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }

    .card {
        border: none;
    }

    .card-header {
        border-bottom: 2px solid #dee2e6;
        padding: 1.5rem;
    }
</style>

<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewImg').src = event.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreview').style.display = 'none';
        }
    });

    // Form validation
    document.getElementById('productForm').addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const type = document.getElementById('type').value;
        const price = parseFloat(document.getElementById('price').value);
        const categoryId = document.getElementById('category_id').value;
        const teamId = document.getElementById('team_id').value;

        if (name.length < 3) {
            e.preventDefault();
            alert('Product name must be at least 3 characters long');
            return false;
        }

        if (!type) {
            e.preventDefault();
            alert('Please select a product type');
            return false;
        }

        if (price <= 0 || isNaN(price)) {
            e.preventDefault();
            alert('Please enter a valid price greater than 0');
            return false;
        }

        if (!categoryId) {
            e.preventDefault();
            alert('Please select a category');
            return false;
        }

        if (!teamId) {
            e.preventDefault();
            alert('Please select a team');
            return false;
        }
    });
</script>

<?php echo view('templates/footer'); ?>
