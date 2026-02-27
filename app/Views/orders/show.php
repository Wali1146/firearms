<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/orders">My Orders</a></li>
                <li class="breadcrumb-item active">Order #<?= $order['id'] ?></li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Order Details</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Order Number:</strong> #<?= $order['id'] ?>
                    </div>
                    <div class="col-md-6">
                        <strong>Order Date:</strong> <?= date('M j, Y g:i A', strtotime($order['created_at'])) ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Status:</strong>
                        <span class="badge bg-<?= $this->getStatusColor($order['status']) ?>">
                            <?= ucfirst($order['status']) ?>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <strong>Total Amount:</strong> $<?= number_format($order['total'], 2) ?>
                    </div>
                </div>

                <h6 class="mt-4">Items Ordered:</h6>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order['items'] as $item): ?>
                            <tr>
                                <td><?= esc($item['product_name']) ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td>$<?= number_format($item['price'], 2) ?></td>
                                <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Shipping Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> <?= esc($order['shipping_name']) ?></p>
                <p><strong>Email:</strong> <?= esc($order['shipping_email']) ?></p>
                <p><strong>Address:</strong><br>
                <?= esc($order['shipping_address']) ?><br>
                <?= esc($order['shipping_city']) ?>, <?= esc($order['shipping_state']) ?> <?= esc($order['shipping_zip']) ?></p>
            </div>
        </div>

        <?php if ($is_admin): ?>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Admin Actions</h5>
            </div>
            <div class="card-body">
                <form action="/orders/update-status/<?= $order['id'] ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="status" class="form-label">Update Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending" <?= ($order['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                            <option value="processing" <?= ($order['status'] == 'processing') ? 'selected' : '' ?>>Processing</option>
                            <option value="shipped" <?= ($order['status'] == 'shipped') ? 'selected' : '' ?>>Shipped</option>
                            <option value="completed" <?= ($order['status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
                            <option value="cancelled" <?= ($order['status'] == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php
// Helper function for status colors
$this->getStatusColor = function($status) {
    return match($status) {
        'pending' => 'warning',
        'processing' => 'info',
        'shipped' => 'primary',
        'completed' => 'success',
        'cancelled' => 'danger',
        default => 'secondary'
    };
};
?>
<?= $this->endSection() ?>