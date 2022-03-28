<?= $this->extend('Layout/H&F'); ?>

<?= $this->section('Content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-4 mb-4">Comic Details</h3>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/Images/<?= $Comics['cover']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title mb-3"><?= $Comics['title']; ?></h5>
                            <p class="card-text"><b>Author : </b><?= $Comics['author']; ?></p>
                            <p class="card-text"><small class="text-muted"><b>Publisher : </b><?= $Comics['publisher']; ?></small></p>

                            <a href="/Comics/edit/<?= $Comics['slug']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/Comics/<?= $Comics['id']; ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure..?');">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>