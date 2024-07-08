<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?><?= esc($title)?><?= $this->endSection() ?>



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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#destinationModal">
              <i class="material-icons opacity-10 me-2">add_location_alt</i>
              Add
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
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">destination</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">mobile</th>
                
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
            <?php if (!empty($destinations)) {  ?>
              <?php foreach ($destinations as $destination) : ?>

                <tr>
                  <td class="text-center"><?= esc($destination['id']) ?></td>
                  
                  <td class="text-center"><u><a href="<?= site_url('viewDestination?destination='.$destination['id'])?>"><?= esc($destination['destination']) ?></a></u></td>
                  <td class="text-center"><?= esc($destination['mobile']) ?></td>
                  
                  <td class="text-center">
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


<!-- new tenant modal -->
<div class="modal" id="destinationModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="width: 150%">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">New Destination</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <form action="<?= site_url('createDestination') ?>" method="post">
          <?= csrf_field() ?>
          <div class="row g-3 my-1">

            <div class="input-group input-group-dynamic my-3 col-md-6">
              <label for="destination" class="form-label">Name:</label>
              <input type="text" class="form-control ps-2" id="destination" name="destination" autocomplete="off">
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-dynamic my-3">
                <label for="desMobile" class="form-label">Mobile:</label>
                <input type="number" class="form-control ps-2" id="desMobile" name="mobile" autocomplete="off">
              </div>
            </div>

            <div class="col-12 d-flex align-content-end justify-content-end">
              <input type="submit" value="Create" class="btn btn-primary"></button>
            </div>
        </form>
      </div>
    </div>


  </div>
</div>


<?= $this->endSection() ?>