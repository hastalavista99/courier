<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col-12">
  <div class="card my-4">
    <div class="container">
      <?php if (!empty(session()->getFlashdata('success'))) { ?>
        <div class="alert alert-success text-white alert-dismissible fade show">
          <span class="alert-icon align-middle">
            <span class="material-icons text-md">thumb_up</span>
          </span>
          <?= session()->getFlashdata('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php } else if (!empty(session()->getFlashdata('fail'))) { ?>
        <div class="alert alert-danger text-white alert-dismissible fade show">
          <span class="alert-icon align-middle">
            <span class="material-icons text-md">warning</span>
          </span>
          <?= session()->getFlashdata('fail') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php } ?>
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
            <?php if (!empty($packages)) { ?>
              <?php foreach ($packages as $package) : ?>
                <tr>
                  <td class="text-center"><a href="<?= site_url('packages/view?pid=' . $package['id'] . '&origin=' . $package['origin_name'] . '&destination=' . $package['destination_name']) ?>"><?= esc($package['unique_id']) ?></a></td>
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
                    <?php
                    $pack = $package['status'] == 'Received' ?
                      '<button type="button" class="btn btn-secondary" disabled>' .
                      $package['button_text'] .
                      '</button>' :
                      '<button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-id="' . $package['id'] . '"
                        data-uid="' . $package['unique_id'] . '"
                        data-sender="' . $package['sender'] . '"
                        data-sender-mobile="' . $package['sender_mobile'] . '"
                        data-recipient="' . $package['recipient'] . '"
                        data-recipient-mobile="' . $package['recipient_mobile'] . '"
                        data-origin="' . $package['origin_name'] . '"
                        data-destination="' . $package['destination_name'] . '"
                        data-fee="' . $package['pay_amount'] . '">' .
                      $package['button_text'] .
                      '</button>';
                    echo $pack;
                    ?>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Package UID: </h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex flex-column">
          <p><span class="text-bold">Sender: </span></p>
          <p><span class="text-bold">Mobile: </span></p>
          <p><span class="text-bold">Recipient: </span></p>
          <p><span class="text-bold">Mobile: </span></p>
          <p><span class="text-bold">From: </span></p>
          <p><span class="text-bold">To: </span></p>
          <p><span class="text-bold">Fee: </span>Ksh </p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <a href="#" class="btn bg-gradient-primary">Process</a>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    const exampleModal = document.getElementById('exampleModal');

    exampleModal.addEventListener('show.bs.modal', function(event) {
      // Button that triggered the modal
      var button = event.relatedTarget;

      // Extract info from data-* attributes
      var packageId = button.getAttribute('data-id');
      var uniqueId = button.getAttribute('data-uid');
      var sender = button.getAttribute('data-sender');
      var senderMobile = button.getAttribute('data-sender-mobile');
      var recipient = button.getAttribute('data-recipient');
      var recipientMobile = button.getAttribute('data-recipient-mobile');
      var origin = button.getAttribute('data-origin');
      var destination = button.getAttribute('data-destination');
      var fee = button.getAttribute('data-fee');

      // Update the modal's content.
      var modalTitle = exampleModal.querySelector('.modal-title');
      var modalBody = exampleModal.querySelector('.modal-body');
      var processButton = exampleModal.querySelector('.modal-footer a');

      modalTitle.textContent = 'Package UID: ' + uniqueId;
      modalBody.innerHTML = `
        <div class="d-flex flex-column">
          <p><span class="text-bold">Sender: </span>${sender}</p>
          <p><span class="text-bold">Mobile: </span>${senderMobile}</p>
          <p><span class="text-bold">Recipient: </span>${recipient}</p>
          <p><span class="text-bold">Mobile: </span>${recipientMobile}</p>
          <p><span class="text-bold">From: </span>${origin}</p>
          <p><span class="text-bold">To: </span>${destination}</p>
          <p><span class="text-bold">Fee: </span>Ksh ${fee}</p>
        </div>
      `;

      processButton.href = '<?= site_url('incomingPackage?id=') ?>' + packageId;
    });
  });
</script>

<?= $this->endSection() ?>