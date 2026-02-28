<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Our Services</h1>
    </div>
</div>

<!-- Services Grid -->
<div class="row mb-5">
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-graduation-cap fa-3x text-primary mb-3"></i>
                <h4 class="card-title">Firearm Training</h4>
                <p class="card-text">Comprehensive safety courses and professional training for responsible gun ownership.</p>
                <div class="row mt-3">
                    <?php foreach ($services as $service): ?>
                        <?php if ($service['type'] === 'course'): ?>
                            <div class="col-12 mb-2">
                                <a href="/products/<?= $service['id'] ?>" class="btn btn-sm btn-primary w-100">
                                    <?= esc($service['name']) ?> - $<?= number_format($service['price'], 2) ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-tools fa-3x text-primary mb-3"></i>
                <h4 class="card-title">Gunsmith Services</h4>
                <p class="card-text">Professional maintenance, repairs, and customization services for your firearms.</p>
                <div class="row mt-3">
                    <?php foreach ($subscriptions as $service): ?>
                        <?php if (strpos(strtolower($service['name']), 'gunsmith') !== false): ?>
                            <div class="col-12 mb-2">
                                <a href="/products/<?= $service['id'] ?>" class="btn btn-sm btn-primary w-100">
                                    <?= esc($service['name']) ?> - $<?= number_format($service['price'], 2) ?>/mo
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-certificate fa-3x text-primary mb-3"></i>
                <h4 class="card-title">Range Memberships</h4>
                <p class="card-text">Unlimited access to our premium shooting range with training sessions included.</p>
                <div class="row mt-3">
                    <?php foreach ($subscriptions as $service): ?>
                        <?php if (strpos(strtolower($service['name']), 'range') !== false): ?>
                            <div class="col-12 mb-2">
                                <a href="/products/<?= $service['id'] ?>" class="btn btn-sm btn-primary w-100">
                                    <?= esc($service['name']) ?> - $<?= number_format($service['price'], 2) ?>/year
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Services Section -->
<div class="row mt-5">
    <div class="col-12">
        <h2 class="text-center mb-4">Service Details</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-dark">
                <h5 class="mb-0"><i class="fas fa-check text-primary"></i> Why Choose Our Services?</h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-star text-primary"></i>
                        <strong> Expert Instructors</strong> - Certified professionals with years of experience
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-star text-primary"></i>
                        <strong> Safety First</strong> - Comprehensive safety protocols and guidance
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-star text-primary"></i>
                        <strong> Modern Facilities</strong> - State-of-the-art training and range equipment
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-star text-primary"></i>
                        <strong> Personalized Training</strong> - Customized programs for all skill levels
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-star text-primary"></i>
                        <strong> Flexible Scheduling</strong> - Classes and services available year-round
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-dark">
                <h5 class="mb-0"><i class="fas fa-info-circle text-primary"></i> Service Information</h5>
            </div>
            <div class="card-body">
                <h6 class="mb-3">Training Courses</h6>
                <p>Our comprehensive training programs cover firearm safety, marksmanship, and tactical operations. Each course is designed to meet state requirements and industry standards.</p>

                <h6 class="mb-3 mt-4">Gunsmith Services</h6>
                <p>From basic maintenance to complex customizations, our experienced gunsmiths can handle all your firearm needs with precision and care.</p>

                <h6 class="mb-3 mt-4">Range Access</h6>
                <p>Members enjoy unlimited access to our premium shooting range, complete with professional staff and top-notch safety measures.</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>