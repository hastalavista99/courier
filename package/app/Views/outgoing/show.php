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
                    <h4 class="row text-capitalize ps-3"><?= esc($title) ?> - <?= esc($package['unique_id']) ?></h4>
                </div>
            </div>

        </div>
        <div class="card-body px-0 pb-2">
            <div class="container">
                <div class="d-flex flex-column align-items-center justify-items-center">
                    <p><span class="text-bold">Sender: </span><?= esc($package['sender']) ?></p>
                    <p><span class="text-bold">Mobile: </span><?= esc($package['sender_mobile']) ?></p>
                    <p><span class="text-bold">Recipient: </span><?= esc($package['recipient']) ?></p>
                    <p><span class="text-bold">Mobile: </span><?= esc($package['recipient_mobile']) ?></p>
                    <p><span class="text-bold">From: </span><?= esc($origin) ?></p>
                    <p><span class="text-bold">To: </span><?= esc($destination) ?></p>
                    <p><span class="text-bold">Fee: </span>Ksh <?= esc($package['pay_amount']) ?></p>
                    <p><span class="text-bold">Description: </span>Ksh <?= esc($package['description']) ?></p>

                    <div class="">
                        <a href="<?= site_url('outgoing') ?>" class="btn bg-gradient-secondary">Back</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>


<?= $this->endSection() ?>