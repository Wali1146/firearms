<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/products">Products</a></li>
                <li class="breadcrumb-item active"><?= esc($product['name']) ?></li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title"><?= esc($product['name']) ?></h1>
                <img src="<?= base_url('assets/img/products/' . (isset($product['image']) && !empty($product['image']) ? $product['image'] : 'placeholder.jpg')) ?>" 
                    alt="<?= esc($product['name']) ?>" class="img-fluid mb-3">
                <p class="card-text">
                    <span class="badge bg-secondary"><?= esc($product['type']) ?></span>
                    <span class="badge bg-info"><?= esc($product['category_name']) ?></span>
                    <span class="badge bg-success">By <?= esc($product['team_name']) ?></span>
                </p>
                <p class="card-text lead"><?= esc($product['description']) ?></p>
                <h3 class="text-primary">$<?= number_format($product['price'], 2) ?></h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Purchase Options</h5>
                <?php if (session()->get('user_id')): ?>
                    <form action="/cart/add/<?= $product['id'] ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="99">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-2">Add to Cart</button>
                    </form>
                    <a href="/checkout" class="btn btn-success w-100">Buy Now</a>
                <?php else: ?>
                    <p class="text-muted">Please <a href="/login">login</a> to purchase this product.</p>
                    <div class="text-center">
                        <a href="/login" class="btn btn-primary">Login</a>
                        <a href="/register" class="btn btn-outline-primary ms-2">Register</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>