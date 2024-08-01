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
            <div class="col-md-2 pt-3">
                <div>
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span class="btn-inner--icon"><i class="fa fa-plus me-2"></i></span>
                        <span class="btn-inner--text">New</span>
                    </button>
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

                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="table">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">message</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">mobile</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">date</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($complaints)) { ?>
                                <?php foreach ($complaints as $complaint) : ?>
                                    <tr>
                                        <td class="text-center"><?= esc($complaint['id']) ?></td>
                                        <td class="text-center"><?= esc($complaint['message']) ?></td>
                                        <td class="text-center"><?= esc($complaint['mobile']) ?></td>
                                        <td class="text-center"><?= esc($complaint['name']) ?></td>
                                        <td class="text-center"><?= esc($complaint['date']) ?></td>
                                        <td class="text-center">

                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php } else {
                                $this->include('partials/no_records');
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3 my-1" action="<?= site_url('packages/complaints/new') ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- <div class="col-md-3">
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
                    </div> -->

                    <div class="col-md-12">
                        <div class="input-group input-group-dynamic">
                            <textarea class="form-control" rows="2" placeholder="Message" name="message" spellcheck="false"></textarea>
                        </div>
                    </div>

                    <div class="d-flex align-content-end justify-content-end me-3">
                        <input type="submit" value="Submit" id="submitAssign" class="btn btn-primary">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>