<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Checkout</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <form action="/checkout" method="post">
            <?= csrf_field() ?>

            <!-- Shipping Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Shipping Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="shipping_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="shipping_name" name="shipping_name"
                                   value="<?= old('shipping_name') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('shipping_name')): ?>
                                <div class="text-danger mt-1"><?= $validation->getError('shipping_name') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="shipping_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="shipping_email" name="shipping_email"
                                   value="<?= old('shipping_email') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('shipping_email')): ?>
                                <div class="text-danger mt-1"><?= $validation->getError('shipping_email') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="shipping_address" class="form-label">Address</label>
                        <textarea class="form-control" id="shipping_address" name="shipping_address"
                                  rows="3" required><?= old('shipping_address') ?></textarea>
                        <?php if (isset($validation) && $validation->hasError('shipping_address')): ?>
                            <div class="text-danger mt-1"><?= $validation->getError('shipping_address') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="shipping_city" class="form-label">City</label>
                            <input type="text" class="form-control" id="shipping_city" name="shipping_city"
                                   value="<?= old('shipping_city') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('shipping_city')): ?>
                                <div class="text-danger mt-1"><?= $validation->getError('shipping_city') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="shipping_state" class="form-label">State</label>
                            <input type="text" class="form-control" id="shipping_state" name="shipping_state"
                                   value="<?= old('shipping_state') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('shipping_state')): ?>
                                <div class="text-danger mt-1"><?= $validation->getError('shipping_state') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="shipping_zip" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" id="shipping_zip" name="shipping_zip"
                                   value="<?= old('shipping_zip') ?>" required>
                            <?php if (isset($validation) && $validation->hasError('shipping_zip')): ?>
                                <div class="text-danger mt-1"><?= $validation->getError('shipping_zip') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Payment Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="credit_card" selected>Credit Card</option>
                        </select>
                        <?php if (isset($validation) && $validation->hasError('payment_method')): ?>
                            <div class="text-danger mt-1"><?= $validation->getError('payment_method') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        This is a demo application. No real payment processing will occur.
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-4">
        <!-- Order Summary -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Order Summary</h5>
            </div>
            <div class="card-body">
                <?php foreach ($cart_items as $item): ?>
                    <div class="d-flex justify-content-between mb-2">
                        <span>
                            <?= esc($item['name']) ?> x<?= $item['quantity'] ?>
                        </span>
                        <span>$<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                    </div>
                <?php endforeach; ?>

                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <strong>Total:</strong>
                    <strong>$<?= number_format($total, 2) ?></strong>
                </div>

                <button type="submit" form="checkout-form" class="btn btn-success w-100">
                    Place Order - $<?= number_format($total, 2) ?>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Add form attribute to the main form
document.querySelector('form').setAttribute('id', 'checkout-form');
</script>
<?= $this->endSection() ?>