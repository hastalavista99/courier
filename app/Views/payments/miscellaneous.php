<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>



<?= $this->section('content') ?>


<div class="col-12">
    <div class="card my-4">

        <div class="container">
            <?php
            if (!empty(session()->getFlashdata('success'))) {
            ?>
                <div class="alert alert-success text-white alert-dismissible fade show">
                    <span class="alert-icon align-middle">
                        <span class="material-icons text-md">
                            thumb_up
                        </span>
                    </span>
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
            } else if (!empty(session()->getFlashdata('fail'))) {
            ?>
                <div class="alert alert-danger text-white alert-dismissible fade show">
                    <span class="alert-icon align-middle">
                        <span class="material-icons text-md">
                            warning
                        </span>
                    </span>
                    <?= session()->getFlashdata('fail') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="d-flex justify-content-between">
            <div class="row card-header col-md-7 p-0 mx-3 z-index-2 mt-3" style="height: 25px;">
                <div class="pt-1 pb-1">
                    <h4 class="row text-capitalize ps-3"><?= esc($title) ?></h4>
                </div>
            </div>

        </div>
        <div class="card-body px-0 pb-2">
            
        </div>
    </div>
</div>
</div>


<?= $this->endSection() ?>