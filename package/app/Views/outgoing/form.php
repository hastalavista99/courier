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
                    <a class="btn btn-success" href="outgoing">
                        <i class="material-icons opacity-10">chevron_left</i>
                        Back
                    </a>
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

                <form class="row g-3 my-1" action="<?= site_url('assignTenant?id=') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="col-md-3">
                        <div class="input-group input-group-dynamic">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class=" input-group input-group-dynamic">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-3 input-group input-group-dynamic">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group input-group-dynamic">
                            <label for="exampleFormControlSelect1" class=" form-label ms-0">Destination</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option value=""></option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                        </div>
                        
                    </div>

                    <div class="input-group input-group-dynamic">
                        <textarea class="form-control" rows="5" placeholder="Package description" spellcheck="false"></textarea>
                    </div>
                    <div class="d-flex align-content-end justify-content-end me-3">
                        <input type="submit" name="" value="Submit" id="submitAssign" class="btn btn-primary">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>