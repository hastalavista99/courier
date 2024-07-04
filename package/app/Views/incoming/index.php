<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Units<?= $this->endSection() ?>



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
        <div class="col-md-2 pt-3">
          <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#unitsModal">
              <i class="material-icons opacity-10 me-2">domain_add</i>
              Units
            </button>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0" id="table">
            <thead>
              <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Property</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unit No</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Commission</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">rent</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">deposit</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">available</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">reserved</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">occupied</th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
            <?php if (!empty($units)) {  ?>
              <?php foreach ($units as $unit) : ?>

                <tr>
                  <td class="text-center"><?= esc($unit['unit_id']) ?></td>
                  <td class="text-center"><?= esc($unit['property_name']) ?></td>
                  <td class="text-center"><u><a href="<?= site_url('viewUnit?unit='.$unit['unit_id'])?>"><?= esc($unit['unit_name']) ?></a></u></td>
                  <td class="text-center"><?= esc($unit['unit_number']) ?></td>
                  <td class="text-center"><span class="text-xxs">KES </span><?= esc($unit['commission']) ?></td>
                  <td class="text-center"><span class="text-xxs">KES </span><?= esc($unit['rent']) ?></td>
                  <td class="text-center"><span class="text-xxs">KES </span><?= esc($unit['deposit']) ?></td>
                  <td class="text-center"><?= esc($unit['available']) ?></td>
                  <td class="text-center"><?= esc($unit['reserved']) ?></td>
                  <td class="text-center"><?= esc($unit['occupied']) ?></td>
                  <td class="text-center"><a href=""><i class="fa fa-pen text-success me-2"></i></a>
                    <a href=""><i class="fa fa-trash text-danger"></i></a>
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


<?= $this->endSection() ?>