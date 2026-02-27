<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Our Products</h1>
    </div>
</div>

<!-- Filters -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="get" class="row g-3">
                    <div class="col-md-4">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-select">
                            <option value="">All Categories</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= ($current_category == $category['id']) ? 'selected' : '' ?>>
                                    <?= esc($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-select">
                            <option value="">All Types</option>
                            <option value="firearms" <?= ($current_type == 'firearms') ? 'selected' : '' ?>>Firearms</option>
                            <option value="course" <?= ($current_type == 'course') ? 'selected' : '' ?>>Courses</option>
                            <option value="subscription" <?= ($current_type == 'subscription') ? 'selected' : '' ?>>Subscriptions</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="/products" class="btn btn-outline-secondary">Clear</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Products Grid -->
<div class="row">
    <?php if (empty($products)): ?>
        <div class="col-12">
            <div class="alert alert-info">No products found matching your criteria.</div>
        </div>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><?= esc($product['name']) ?></h5>
                    <p class="card-text">
                        <span class="badge bg-secondary"><?= esc($product['type']) ?></span>
                        <span class="badge bg-info"><?= esc($product['category_name']) ?></span>
                    </p>
                    <p class="card-text text-muted">
                        <?= esc(substr($product['description'], 0, 100)) ?>...
                    </p>
                    <p class="card-text fw-bold text-primary">$<?= number_format($product['price'], 2) ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/products/<?= $product['id'] ?>" class="btn btn-primary">View Details</a>
                        <?php if (session()->get('user_id')): ?>
                            <form action="/cart/add/<?= $product['id'] ?>" method="post" class="d-inline">
                                <button type="submit" class="btn btn-outline-primary">Add to Cart</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>