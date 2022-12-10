<?php

function printNavigationPanel() {

    session_start();
     
    $userName = $_SESSION['nombre'];
    $userRole = $_SESSION['role'];
    $companyName = 'Asset Management S.A.';
    session_write_close();
    
    echo '<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">' . $companyName . '</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                    class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                        <form method = "POST">
                            <input type="submit" class="btn btn-info text-white" style = "margin-left: 20px" value="Log Out"
                            id="btnCerrarSesion" name="btnCerrarSesion">
                        </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Start</div>
                    <a class="nav-link" href="view_home.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        My Dashboard
                    </a>

                    ' 
                    . addTaggerFunctionalities($userRole)

                    . addAccountantFunctionalities($userRole)

                    . addAdminFuntionalities($userRole) . '

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="medium">Logged in as: ' . $userName   . '</div>
                <div class="small">Role: ' . $userRole   . '</div>
            </div>
        </nav>
    </div>';

}

function addTaggerFunctionalities($role){
    if($role == 'TAGGER'){
        return '<div class="sb-sidenav-menu-heading">ASSET MANAGEMENT</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Assets
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="view_tagger_assetList.php">Asset List</a>    
                            <a class="nav-link" href="layout-static.html">New Assets</a>
                        </nav>
                    </div>';
    } else {
        return '';
    }
}

function addAccountantFunctionalities($role){

    if($role == 'CONTADOR'){
        return '<div class="sb-sidenav-menu-heading">ACCOUNTING</div>
        <a class="nav-link" href="view_accounting_depreciation.php">
            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
            Depreciation
        </a>
        <a class="nav-link" href="view_accounting_journalsReport.php">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            Journals Report
        </a>
        <a class="nav-link" href="view_accounting_reconciliation.php">
            <div class="sb-nav-link-icon"><i class="fas fa-clipboard"></i></div>
            Reconciliation
        </a>';
    } else {
        return '';
    }
}

function addAdminFuntionalities($role){

    if($role == 'ADMIN'){
        return '
        <div class="sb-sidenav-menu-heading">ADMIN</div>   

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseLayoutsAdminUsers" aria-expanded="false" aria-controls="collapseLayoutsAdminUsers">
            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
            Users
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>

        <div class="collapse" id="collapseLayoutsAdminUsers" aria-labelledby="headingOne"
            data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="../view/view_admin_usersList.php">Users List</a>
                <a class="nav-link" href="../view/view_admin_usersCreateUser.php">Create User</a>
            </nav>
        </div>

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
            data-bs-target="#collapseLayoutsAccount" aria-expanded="false" aria-controls="collapseLayoutsAccount">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-receipt"></i></div>
            Accounts
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>

        <div class="collapse" id="collapseLayoutsAccount" aria-labelledby="headingOne"
            data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="../view/view_admin_accountList.php">Account List</a>
                <a class="nav-link" href="../view/view_admin_accountCreateAccount.php">Create Account</a>
            </nav>
        </div>

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
        data-bs-target="#collapseLayoutsClass" aria-expanded="false" aria-controls="collapseLayoutsClass">
        <div class="sb-nav-link-icon"><i class="fa-solid fa-car"></i></div>
        Classes
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>

        <div class="collapse" id="collapseLayoutsClass" aria-labelledby="headingOne"
            data-bs-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="../view/view_admin_classList.php">Classes List</a>
                <a class="nav-link" href="../view/view_admin_classCreateClass.php">Create Class</a>
                <a class="nav-link" href="../view/view_admin_classValidations.php">Class Validations</a>
            </nav>
        </div>     
        ';

    } else {
        return '';
    }
}

?>