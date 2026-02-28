<?= $this->extend('templates/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <h1 class="mb-4">About Rhys Firearms</h1>
    </div>
</div>

<!-- Company Overview -->
<div class="row mb-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-primary mb-3">Our Story</h2>
                <p>Founded in 2015, Rhys Firearms has become a leading provider of premium firearms and professional training services. Our mission is to promote responsible firearm ownership through education, quality products, and exceptional service.</p>
                <p>With a commitment to excellence and customer satisfaction, we've built a reputation as a trusted partner for firearms enthusiasts, hunters, sport shooters, and law enforcement professionals.</p>
            </div>
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="row mb-5">
    <div class="col-12">
        <h2 class="text-center mb-4">Meet Our Team</h2>
    </div>
</div>

<div class="row">
    <?php foreach ($teams as $team): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <img src="<?= base_url('assets/img/team/' . strtolower(str_replace(' ', '-', $team['name'])) . '.jpg') ?>"
                        alt="<?= esc($team['name']) ?>"
                        class="img-fluid rounded-circle mb-3"
                        style="width: 150px; height: 150px; object-fit: cover;">
                    <h5 class="card-title"><?= esc($team['name']) ?></h5>
                    <p class="text-muted">Team Member</p>
                    <p class="card-text">Experienced professional dedicated to providing exceptional service and expertise.</p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Company Values -->
<div class="row mt-5">
    <div class="col-12">
        <h2 class="text-center mb-4">Our Values</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                <h5>Safety</h5>
                <p class="text-muted">Safety is our top priority in all operations and training programs.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-star fa-3x text-primary mb-3"></i>
                <h5>Quality</h5>
                <p class="text-muted">We deliver superior quality products and services to all our customers.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-handshake fa-3x text-primary mb-3"></i>
                <h5>Integrity</h5>
                <p class="text-muted">Honesty and integrity guide every decision we make.</p>
            </div>
        </div>
    </div>
</div>

<!-- Company Timeline -->
<div class="row mt-5">
    <div class="col-12">
        <h2 class="text-center mb-4">Our Journey</h2>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 text-center border-end">
                        <h6 class="text-primary mb-1">2015</h6>
                        <p class="small text-muted">Founded Rhys Firearms</p>
                    </div>
                    <div class="col-md-3 text-center border-end">
                        <h6 class="text-primary mb-1">2017</h6>
                        <p class="small text-muted">Expanded Training Programs</p>
                    </div>
                    <div class="col-md-3 text-center border-end">
                        <h6 class="text-primary mb-1">2019</h6>
                        <p class="small text-muted">Opened Premium Range</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <h6 class="text-primary mb-1">2023</h6>
                        <p class="small text-muted">Launched Online Store</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>