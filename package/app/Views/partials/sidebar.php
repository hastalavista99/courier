<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
      <img src="<?= base_url('assets/img/icons/logocourier.png') ?>" class="navbar-brand-img h-100" alt="main_logo" />
      <span class="ms-1 font-weight-bold text-white">Courier</span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2" />
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <?php
      if ($userInfo['role'] != 'customer') {
      ?>
      <li class="nav-item">
        <a class="nav-link text-white" href="<?= site_url('dashboard')?>">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white" href="<?= site_url('packages/incoming') ?>">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">input</i>
          </div>
          <span class="nav-link-text ms-1">Incoming</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="<?= site_url('packages/outgoing') ?>">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">output</i>
          </div>
          <span class="nav-link-text ms-1">Outgoing</span>
        </a>
      </li>

      <?php
      if ($userInfo['role'] == 'admin') {
      ?>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= site_url('packages/all') ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">inventory_2</i>
            </div>
            <span class="nav-link-text ms-1">All Packages</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= site_url('packages/customer/complaints') ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">forum</i>
            </div>
            <span class="nav-link-text ms-1">Complaints</span>
          </a>
        </li>
      <?php
      }
      ?>
     

      <li class="nav-item">
        <a class="nav-link text-white" href="<?= site_url('packages/history') ?>">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">notes</i>
          </div>
          <span class="nav-link-text ms-1">History</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white" href="#">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">settings</i>
          </div>
          <span class="nav-link-text ms-1">Settings</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white" href="<?= site_url('payments') ?>">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">payments</i>
          </div>
          <span class="nav-link-text ms-1">Payments</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white" href="<?= site_url('destinations') ?>">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">location_on</i>
          </div>
          <span class="nav-link-text ms-1">Destinations</span>
        </a>
      </li>
      
      <?php
      }
      ?>

      <?php
      if ($userInfo['role'] == 'customer') {
      ?>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= site_url('packages/customer') ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">inventory</i>
            </div>
            <span class="nav-link-text ms-1">My Packages</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= site_url('packages/complaints') ?>">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">forum</i>
            </div>
            <span class="nav-link-text ms-1">Complaints</span>
          </a>
        </li>
      <?php
      }
      ?>


    </ul>
  </div>
  <div class="sidenav-footer position-absolute w-100 bottom-0">
    <div class="mx-3">
      <a class="btn bg-gradient-primary w-100" href="https://www.macrologicsys.com" type="button">Macrologic Systems</a>
    </div>
  </div>
</aside>