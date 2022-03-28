<?= $this->extend('Layout/H&F'); ?>

<?= $this->section('Content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <br>
            <h3 class="mt-1 mb-4">Comic list</h3>
            <a href="/Comics/create" class="btn btn-primary mt-2 mb-3">Add Comic</a>
            <?php if (session()->getFlashData('Message')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('Message'); ?>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($Comics as $C) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/Images/<?= $C['cover']; ?>" alt="" class="Cover"></td>
                            <td><?= $C['title']; ?></td>
                            <td>
                                <a href="/Comics/<?= $C['slug']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>