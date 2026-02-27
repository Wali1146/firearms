<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">My Orders</h1>
    </div>
</div>

<?php if (empty($orders)): ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <h3>No orders found</h3>
                    <p class="text-muted">You haven't placed any orders yet.</p>
                    <a href="/products" class="btn btn-primary">Start Shopping</a>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <?php if ($is_admin): ?>
                                        <th>Customer</th>
                                    <?php endif; ?>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td>#<?= $order['id'] ?></td>
                                    <td><?= date('M j, Y', strtotime($order['created_at'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $this->getStatusColor($order['status']) ?>">
                                            <?= ucfirst($order['status']) ?>
                                        </span>
                                    </td>
                                    <td>$<?= number_format($order['total'], 2) ?></td>
                                    <?php if ($is_admin): ?>
                                        <td><?= esc($order['username']) ?> (<?= esc($order['email']) ?>)</td>
                                    <?php endif; ?>
                                    <td>
                                        <a href="/orders/<?= $order['id'] ?>" class="btn btn-sm btn-primary">
                                            View Details
                                        </a>
                                        <?php if ($is_admin): ?>
                                            <form action="/orders/update-status/<?= $order['id'] ?>" method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <select name="status" class="form-select form-select-sm d-inline-block w-auto me-1" onchange="this.form.submit()">
                                                    <option value="pending" <?= ($order['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                                                    <option value="processing" <?= ($order['status'] == 'processing') ? 'selected' : '' ?>>Processing</option>
                                                    <option value="shipped" <?= ($order['status'] == 'shipped') ? 'selected' : '' ?>>Shipped</option>
                                                    <option value="completed" <?= ($order['status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
                                                    <option value="cancelled" <?= ($order['status'] == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                                                </select>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

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