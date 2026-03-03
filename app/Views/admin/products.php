<?php echo view('templates/main'); ?>
<div class="container-fluid mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Products Management</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?= base_url('admin/create-product') ?>" class="btn btn-primary btn-lg">
            <i class="fas fa-plus"></i> Add New Product
            </a>
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
                        <th>Description</th>
                        <th>Category</th>
                        <th>Team</th>
                        <th>Price</th>
                        <th>Image</th>
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
                                <td><?= htmlspecialchars($product['description']) ?></td>
                                <td><?= $product['category_id'] ?></td>
                                <td><?= $product['team_id'] ?></td>
                                <td>$<?= number_format($product['price'], 2) ?></td>
                                <td>
                                    <?php if (!empty($product['image'])): ?>
                                        <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="Product Image" class="img-thumbnail" style="max-width: 100px;">
                                    <?php else: ?>
                                        <span class="text-muted">No image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('M d, Y', strtotime($product['created_at'])) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/edit-product/' . $product['id']) ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
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