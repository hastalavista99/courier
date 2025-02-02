<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="col-12">
    <div class="card my-4">
        <div class="d-flex justify-content-between">
            <div class="row card-header col-md-7 p-0 mx-3 z-index-2 mt-3" style="height: 25px;">
                <div class="pt-1 pb-1">
                    <h4 class="row text-capitalize ps-3"><?= esc($title) ?></h4>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pb-2">
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

                <form class="row g-3 my-1" action="<?= site_url('outgoingAdd?stage=' . $userInfo['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="col-md-3">
                        <div class="input-group input-group-dynamic">
                            <label for="" class="form-label">Sender</label>
                            <input type="text" name="sender" id="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class=" input-group input-group-dynamic">
                            <label for="" class="form-label">Sender Mobile</label>
                            <input type="text" name="senderMobile" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-3 input-group input-group-dynamic">
                            <label for="" class="form-label">Recipient</label>
                            <input type="text" name="recipient" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class=" input-group input-group-dynamic">
                            <label for="" class="form-label">Recipient Mobile</label>
                            <input type="text" name="recipientMobile" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-static">
                            <label for="exampleFormControlSelect1" class=" ms-0">Destination</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="destination">
                                <option value=""></option>
                                <?php foreach ($destinations as $destination) : ?>
                                    <option value="<?= $destination['id'] ?>"><?= esc($destination['username']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-dynamic">
                            <textarea class="form-control" rows="2" placeholder="Package description" name="description" spellcheck="false"></textarea>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class=" input-group input-group-dynamic">
                            <label for="" class="form-label">Parcel Fee</label>
                            <input type="number" name="fee" id="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" name="paid" type="checkbox" value="paid" id="checkPayment">
                            <label class="form-check-label" for="checkPayment">
                                Paid
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" name="senderSms" type="checkbox" value="senderSms" id="checkPayment">
                            <label class="form-check-label" for="checkPayment">
                                SMS sender
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" name="recipientSms" type="checkbox" value="recipientSms" id="checkPayment">
                            <label class="form-check-label" for="checkPayment">
                                SMS recipient
                            </label>
                        </div>
                    </div>
                    <div class="d-flex align-content-between justify-content-between me-3">
                        <a class="btn btn-success" href="outgoing">
                            <i class="material-icons opacity-10">chevron_left</i>
                            Back
                        </a>

                        <input type="submit" value="Submit" id="submitAssign" class="btn btn-primary">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>