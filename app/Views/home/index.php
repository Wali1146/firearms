<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="hero-section text-center py-5" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('/img/hero/hero-bg.jpg'); background-size: cover; background-position: center; color: white;">
            <h1 class="display-4 fw-bold">Premium Firearms & Accessories</h1>
            <p class="lead">Expert craftsmanship and professional training services</p>
            <a href="/products" class="btn btn-primary btn-lg">Shop Now</a>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12">
        <h2 class="text-center mb-4">Featured Products</h2>
    </div>
</div>

<div class="row">
    <?php foreach ($featured_products as $product): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title"><?= esc($product['name']) ?></h5>
                <img src="<?= base_url('assets/img/products/' . (isset($product['image']) && !empty($product['image']) ? $product['image'] : 'placeholder.jpg')) ?>" 
                    alt="<?= esc($product['name']) ?>" class="img-fluid mb-3">
                <p class="card-text text-muted"><?= esc($product['type']) ?> - <?= esc($product['description']) ?></p>
                <p class="card-text fw-bold text-primary">$<?= number_format($product['price'], 2) ?></p>
                <a href="/products/<?= $product['id'] ?>" class="btn btn-primary">View Details</a>
                <?php if (session()->get('user_id')): ?>
                    <form action="/cart/add/<?= $product['id'] ?>" method="post" class="d-inline">
                        <button type="submit" class="btn btn-outline-primary ms-2">Add to Cart</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="row mt-5">
    <div class="col-12">
        <h2 class="text-center mb-4">Our Services</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-4 text-center">
        <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
        <h4>Firearm Safety Training</h4>
        <p>Comprehensive safety courses for responsible gun ownership</p>
    </div>
    <div class="col-md-4 text-center">
        <i class="fas fa-tools fa-3x text-primary mb-3"></i>
        <h4>Gunsmith Services</h4>
        <p>Professional maintenance and customization services</p>
    </div>
    <div class="col-md-4 text-center">
        <i class="fas fa-certificate fa-3x text-primary mb-3"></i>
        <h4>Certifications</h4>
        <p>Concealed carry and advanced training certifications</p>
    </div>
</div>
<?= $this->endSection() ?>