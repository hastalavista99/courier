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
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0" id="table">
          <thead>
            <tr>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">parcel id</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">sender</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">sender mobile</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">recipient</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">recipient mobile</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">origin</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">destination</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">status</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">fee</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">time</th>
              <th class="text-secondary opacity-7"></th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($packages)) {  ?>
              <?php foreach ($packages as $package) : ?>

                <tr>
                  <td class="text-center"><a href="<?= site_url('packages/view?pid='.$package['id'].'&origin='.$package['origin_name'].'&destination='.$package['destination_name'])?>"><?= esc($package['unique_id']) ?></a></td>
                  <td class="text-center"><?= esc($package['sender']) ?></td>
                  <td class="text-center"><?= esc($package['sender_mobile']) ?></td>
                  <td class="text-center"><?= esc($package['recipient']) ?></td>
                  <td class="text-center"><?= esc($package['recipient_mobile']) ?></td>
                  <td class="text-center"><?= esc($package['origin_name']) ?></td>
                  <td class="text-center"><?= esc($package['destination_name']) ?></td>
                  <td class="text-center"><?= esc($package['status']) ?></td>
                  <td class="text-center"><?= esc($package['pay_amount']) ?></td>
                  <td class="text-center"><?= esc($package['time']) ?></td>
                  <td class="text-center">
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <?= esc($package['button_text'])?>
                    </button>
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

 <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Package UID: <?=esc($package['unique_id'])?></h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="d-flex flex-column">
              <p><span class="text-bold">Sender: </span><?=esc( $package['sender']) ?></p>
              <p><span class="text-bold">Mobile: </span><?=esc( $package['sender_mobile']) ?></p>
              <p><span class="text-bold">Recipient: </span><?= esc( $package['recipient']) ?></p>
              <p><span class="text-bold">Mobile: </span><?= esc( $package['recipient_mobile']) ?></p>
              <p><span class="text-bold">From: </span><?=esc( $package['origin_name']) ?></p>
              <p><span class="text-bold">To: </span><?=esc( $package['destination_name']) ?></p>
              <p><span class="text-bold">Fee: </span>Ksh <?=esc( $package['pay_amount']) ?></p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            <a href="<?= site_url('incomingPackage?id='.$package['id'])?>" class="btn bg-gradient-primary">Process</a>
          </div>
        </div>
      </div>
    </div>




<?= $this->endSection() ?>