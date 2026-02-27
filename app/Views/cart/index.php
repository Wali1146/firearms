<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Shopping Cart</h1>
    </div>
</div>

<?php if (empty($cart_items)): ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Your cart is empty</h3>
                    <p class="text-muted">Add some products to get started!</p>
                    <a href="/products" class="btn btn-primary">Browse Products</a>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="/cart/update" method="post">
                        <?= csrf_field() ?>
                        <div class="table-responsive">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart_items as $item): ?>
                                    <tr>
                                        <td>
                                            <strong><?= esc($item['name']) ?></strong>
                                            <br><small class="text-muted"><?= esc($item['description']) ?></small>
                                        </td>
                                        <td>$<?= number_format($item['price'], 2) ?></td>
                                        <td>
                                            <input type="number" name="quantities[<?= $item['product_id'] ?>]"
                                                   value="<?= $item['quantity'] ?>" min="0" max="99"
                                                   class="form-control form-control-sm" style="width: 80px;">
                                        </td>
                                        <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                        <td>
                                            <a href="/cart/remove/<?= $item['product_id'] ?>" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i> Remove
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-primary">Update Cart</button>
                            <a href="/cart/clear" class="btn btn-outline-danger"
                               onclick="return confirm('Are you sure you want to clear your cart?')">Clear Cart</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>$<?= number_format($total, 2) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span>Calculated at checkout</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total:</strong>
                        <strong>$<?= number_format($total, 2) ?></strong>
                    </div>
                    <a href="/checkout" class="btn btn-success w-100">Proceed to Checkout</a>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <a href="/products" class="btn btn-outline-primary w-100">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>