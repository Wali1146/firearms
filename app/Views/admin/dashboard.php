<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Admin Dashboard</h1>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-primary"><?= $total_users ?></h3>
                <p class="mb-0">Total Users</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-success"><?= $total_products ?></h3>
                <p class="mb-0">Total Products</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-warning"><?= $total_orders ?></h3>
                <p class="mb-0">Total Orders</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-danger"><?= $pending_orders ?></h3>
                <p class="mb-0">Pending Orders</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <a href="/admin/products" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-box"></i> Manage Products
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="/admin/users" class="btn btn-secondary w-100 mb-2">
                            <i class="fas fa-users"></i> Manage Users
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="/admin/orders" class="btn btn-warning w-100 mb-2">
                            <i class="fas fa-shopping-cart"></i> Manage Orders
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="/admin/products/create" class="btn btn-success w-100 mb-2">
                            <i class="fas fa-plus"></i> Add Product
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Orders</h5>
            </div>
            <div class="card-body">
                <?php if (empty($recent_orders)): ?>
                    <p class="text-muted">No recent orders found.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-dark table-sm">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_orders as $order): ?>
                                <tr>
                                    <td>#<?= $order['id'] ?></td>
                                    <td><?= esc($order['username']) ?></td>
                                    <td><?= date('M j, Y', strtotime($order['created_at'])) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $this->getStatusColor($order['status']) ?>">
                                            <?= ucfirst($order['status']) ?>
                                        </span>
                                    </td>
                                    <td>$<?= number_format($order['total'], 2) ?></td>
                                    <td>
                                        <a href="/orders/<?= $order['id'] ?>" class="btn btn-sm btn-primary">View</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <a href="/admin/orders" class="btn btn-outline-primary">View All Orders</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
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