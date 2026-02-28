<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Contact Us</h1>
        <p class="lead text-muted">Have questions? We'd love to hear from you. Get in touch with our team.</p>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                <h5 class="card-title">Location</h5>
                <p class="card-text">
                    123 Firearms Avenue<br>
                    Springfield, IL 62701<br>
                    United States
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                <h5 class="card-title">Phone</h5>
                <p class="card-text">
                    <strong>Main:</strong> (217) 555-0123<br>
                    <strong>Sales:</strong> (217) 555-0124<br>
                    <strong>Support:</strong> (217) 555-0125
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-envelope fa-2x text-primary mb-3"></i>
                <h5 class="card-title">Email</h5>
                <p class="card-text">
                    <strong>General:</strong> info@rhysfirearms.com<br>
                    <strong>Sales:</strong> sales@rhysfirearms.com<br>
                    <strong>Support:</strong> support@rhysfirearms.com
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Contact Form -->
<div class="row mb-5">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-dark">
                <h5 class="mb-0">Send us a Message</h5>
            </div>
            <div class="card-body">
                <form action="/contact" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= old('name') ?>" required>
                        <?php if (isset($validation) && $validation->hasError('name')): ?>
                            <div class="text-danger mt-1"><?= $validation->getError('name') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= old('email') ?>" required>
                        <?php if (isset($validation) && $validation->hasError('email')): ?>
                            <div class="text-danger mt-1"><?= $validation->getError('email') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject"
                            value="<?= old('subject') ?>" required>
                        <?php if (isset($validation) && $validation->hasError('subject')): ?>
                            <div class="text-danger mt-1"><?= $validation->getError('subject') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required><?= old('message') ?></textarea>
                        <?php if (isset($validation) && $validation->hasError('message')): ?>
                            <div class="text-danger mt-1"><?= $validation->getError('message') ?></div>
                        <?php endif; ?>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Business Hours -->
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header bg-dark">
                <h5 class="mb-0">Business Hours</h5>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-6"><strong>Monday - Friday:</strong></div>
                    <div class="col-6">9:00 AM - 6:00 PM</div>
                </div>
                <div class="row mb-2">
                    <div class="col-6"><strong>Saturday:</strong></div>
                    <div class="col-6">10:00 AM - 4:00 PM</div>
                </div>
                <div class="row mb-2">
                    <div class="col-6"><strong>Sunday:</strong></div>
                    <div class="col-6">Closed</div>
                </div>
                <hr>
                <p class="small text-muted">We're here to help! Call or email us during business hours.</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>