<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-center">Create Your Account</h3>
            </div>
            <div class="card-body">
                <form action="/register" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="<?= old('username') ?>" required>
                        <?php if (isset($validation) && $validation->hasError('username')): ?>
                            <div class="text-danger mt-1"><?= $validation->getError('username') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="<?= old('email') ?>" required>
                        <?php if (isset($validation) && $validation->hasError('email')): ?>
                            <div class="text-danger mt-1"><?= $validation->getError('email') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <?php if (isset($validation) && $validation->hasError('password')): ?>
                            <div class="text-danger mt-1"><?= $validation->getError('password') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <?php if (isset($validation) && $validation->hasError('confirm_password')): ?>
                            <div class="text-danger mt-1"><?= $validation->getError('confirm_password') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p>Already have an account? <a href="/login">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>