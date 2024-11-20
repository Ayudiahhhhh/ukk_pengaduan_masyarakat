<?php
 
if (isset($_SESSION['user_type'])) {
 

  if($_SESSION['user_type'] != "admin"){
    header("Location:  ".BASE_URL."/");
  }
}else{
  header("Location:  ".BASE_URL."/");

}

?>
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="#" class="text-nowrap logo-img">
        <img src="<?= BASE_URL ?>/assets/images/logos/aside.png" width="180" alt="" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= BASE_URL ?>/admin/dashboard/" aria-expanded="false">
            <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">User Management</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= BASE_URL ?>/admin/masyarakat/" aria-expanded="false">
            <span>
              <i class="ti ti-user-plus"></i>
            </span>
            <span class="hide-menu">Data Masyarakat</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= BASE_URL ?>/admin/petugas/" aria-expanded="false">
            <span>
            <i class="ti ti-user-check"></i>
            </span>
            <span class="hide-menu">Data Petugas</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="<?= BASE_URL ?>/admin/pengaduan/" aria-expanded="false">
            <span>
            <i class="ti ti-user-check"></i>
            </span>
            <span class="hide-menu">Data Aduan</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>