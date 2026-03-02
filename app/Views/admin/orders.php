<?php echo view('templates/header'); ?>
<div class="container-fluid mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Orders Management</h2>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal">
                <i class="fas fa-plus"></i> Add New Order
            </button>
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

    <!-- Orders Table -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">ID</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Shipping Address</th>
                        <th>Created At</th>
                        <th style="width: 15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders) && is_array($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= $order['id'] ?></td>
                                <td><?= $order['user_id'] ?></td>
                                <td><?= htmlspecialchars($order['shipping_email']) ?></td>
                                <td>$<?= number_format($order['total'], 2) ?></td>
                                <td>
                                    <span class="badge bg-<?= getStatusColor($order['status']) ?>">
                                        <?= ucfirst($order['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <small><?= htmlspecialchars($order['shipping_address']) ?><br>
                                    <?= htmlspecialchars($order['shipping_city']) ?>, <?= htmlspecialchars($order['shipping_state']) ?> <?= htmlspecialchars($order['shipping_zip']) ?></small>
                                </td>
                                <td><?= date('M d, Y H:i', strtotime($order['created_at'])) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#orderDetailsModal"
                                            data-order-id="<?= $order['id'] ?>" data-user-id="<?= $order['user_id'] ?>"
                                            data-total="<?= $order['total'] ?>" data-status="<?= $order['status'] ?>"
                                            data-shipping-name="<?= htmlspecialchars($order['shipping_name']) ?>"
                                            data-shipping-email="<?= htmlspecialchars($order['shipping_email']) ?>"
                                            data-shipping-address="<?= htmlspecialchars($order['shipping_address']) ?>"
                                            data-shipping-city="<?= htmlspecialchars($order['shipping_city']) ?>"
                                            data-shipping-state="<?= htmlspecialchars($order['shipping_state']) ?>"
                                            data-shipping-zip="<?= htmlspecialchars($order['shipping_zip']) ?>"
                                            onclick="viewOrderDetails(this)">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#orderModal"
                                            data-order-id="<?= $order['id'] ?>" data-user-id="<?= $order['user_id'] ?>"
                                            data-total="<?= $order['total'] ?>" data-status="<?= $order['status'] ?>"
                                            data-shipping-name="<?= htmlspecialchars($order['shipping_name']) ?>"
                                            data-shipping-email="<?= htmlspecialchars($order['shipping_email']) ?>"
                                            data-shipping-address="<?= htmlspecialchars($order['shipping_address']) ?>"
                                            data-shipping-city="<?= htmlspecialchars($order['shipping_city']) ?>"
                                            data-shipping-state="<?= htmlspecialchars($order['shipping_state']) ?>"
                                            data-shipping-zip="<?= htmlspecialchars($order['shipping_zip']) ?>"
                                            onclick="editOrder(this)">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <a href="<?= base_url('admin/delete-order/' . $order['id']) ?>" class="btn btn-sm btn-danger"
                                       onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <p class="text-muted">No orders found</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Order Modal -->
<div class="modal fade" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Add New Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/save-order') ?>" method="POST" id="orderForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="orderId" value="">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="userId" class="form-label">User ID</label>
                            <input type="number" class="form-control" id="userId" name="user_id" required>
                            <div class="invalid-feedback" id="userIdError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="orderTotal" class="form-label">Total Amount</label>
                            <input type="number" class="form-control" id="orderTotal" name="total" step="0.01" required>
                            <div class="invalid-feedback" id="orderTotalError"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="orderStatus" class="form-label">Status</label>
                        <select class="form-select" id="orderStatus" name="status" required>
                            <option value="">Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <div class="invalid-feedback" id="orderStatusError"></div>
                    </div>

                    <hr>
                    <h6 class="mb-3">Shipping Information</h6>

                    <div class="mb-3">
                        <label for="shippingName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="shippingName" name="shipping_name" required>
                        <div class="invalid-feedback" id="shippingNameError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="shippingEmail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="shippingEmail" name="shipping_email" required>
                        <div class="invalid-feedback" id="shippingEmailError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="shippingAddress" class="form-label">Street Address</label>
                        <input type="text" class="form-control" id="shippingAddress" name="shipping_address" required>
                        <div class="invalid-feedback" id="shippingAddressError"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="shippingCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="shippingCity" name="shipping_city" required>
                            <div class="invalid-feedback" id="shippingCityError"></div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="shippingState" class="form-label">State</label>
                            <input type="text" class="form-control" id="shippingState" name="shipping_state" required>
                            <div class="invalid-feedback" id="shippingStateError"></div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="shippingZip" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" id="shippingZip" name="shipping_zip" required>
                            <div class="invalid-feedback" id="shippingZipError"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Order Details Modal (View Only) -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Order ID:</strong> <span id="detailOrderId"></span></p>
                        <p><strong>User ID:</strong> <span id="detailUserId"></span></p>
                        <p><strong>Total Amount:</strong> $<span id="detailTotal"></span></p>
                        <p><strong>Status:</strong> <span id="detailStatus"></span></p>
                    </div>
                </div>

                <hr>
                <h6>Shipping Information</h6>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> <span id="detailShippingName"></span></p>
                        <p><strong>Email:</strong> <span id="detailShippingEmail"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Address:</strong> <span id="detailShippingAddress"></span></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>City:</strong> <span id="detailShippingCity"></span></p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>State:</strong> <span id="detailShippingState"></span></p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>ZIP:</strong> <span id="detailShippingZip"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
function editOrder(button) {
    document.getElementById('orderModalLabel').textContent = 'Edit Order';
    document.getElementById('orderId').value = button.dataset.orderId;
    document.getElementById('userId').value = button.dataset.userId;
    document.getElementById('orderTotal').value = button.dataset.total;
    document.getElementById('orderStatus').value = button.dataset.status;
    document.getElementById('shippingName').value = button.dataset.shippingName;
    document.getElementById('shippingEmail').value = button.dataset.shippingEmail;
    document.getElementById('shippingAddress').value = button.dataset.shippingAddress;
    document.getElementById('shippingCity').value = button.dataset.shippingCity;
    document.getElementById('shippingState').value = button.dataset.shippingState;
    document.getElementById('shippingZip').value = button.dataset.shippingZip;
}

function viewOrderDetails(button) {
    document.getElementById('detailOrderId').textContent = button.dataset.orderId;
    document.getElementById('detailUserId').textContent = button.dataset.userId;
    document.getElementById('detailTotal').textContent = button.dataset.total;
    document.getElementById('detailStatus').textContent = button.dataset.status;
    document.getElementById('detailShippingName').textContent = button.dataset.shippingName;
    document.getElementById('detailShippingEmail').textContent = button.dataset.shippingEmail;
    document.getElementById('detailShippingAddress').textContent = button.dataset.shippingAddress;
    document.getElementById('detailShippingCity').textContent = button.dataset.shippingCity;
    document.getElementById('detailShippingState').textContent = button.dataset.shippingState;
    document.getElementById('detailShippingZip').textContent = button.dataset.shippingZip;
}

document.getElementById('orderModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('orderModalLabel').textContent = 'Add New Order';
    document.getElementById('orderForm').reset();
    document.getElementById('orderId').value = '';
});

function getStatusColor(status) {
    const colors = {
        'pending': 'warning',
        'processing': 'info',
        'shipped': 'primary',
        'completed': 'success',
        'cancelled': 'danger'
    };
    return colors[status] || 'secondary';
}
</script>

<?php echo view('templates/footer'); ?>

<?php
function getStatusColor($status) {
    $colors = [
        'pending' => 'warning',
        'processing' => 'info',
        'shipped' => 'primary',
        'completed' => 'success',
        'cancelled' => 'danger'
    ];
    return $colors[$status] ?? 'secondary';
}
?>
