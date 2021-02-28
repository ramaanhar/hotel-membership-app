<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user') ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-hotel"></i>
        </div>
        <div class="sidebar-brand-text mx-4">Citarum Hotel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!--Query menu -->
    <?php
    $idrole = $this->session->userdata('idrole');
    $queryMenu = "select distinct `roles`.`idrole`, `role`
                    from `roles` join `useraccess`
                      on `roles`.`idrole` = `useraccess`.`idrole`
                   where `useraccess`.`idrole` = $idrole
                order by `useraccess`.`idrole` asc 
    
    ";
    $menu = $this->db->query($queryMenu)->result_array();

    ?>

    <!-- Looping menu -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['role']; ?>
        </div>

        <!-- sub menu -->
        <?php
        $idmenu = $m['idrole'];
        $querySubMenu = "select *
                    from `usermenu` join `roles`
                      on `usermenu`.`idrole` = `roles`.`idrole`
                   where `usermenu`.`idrole` = $idmenu
                     and `usermenu`.`isactive` = 1 
    
    ";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>
        <?php foreach ($subMenu as $sm) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
            </li>
        <?php endforeach; ?>
        <hr class="sidebar-divider">

    <?php endforeach; ?>





    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<!-- End of Sidebar -->