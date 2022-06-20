<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= get_route() == '/admin' ? 'active' : '' ?>" aria-current="page" href="<?= make_url('/admin') ?>">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(get_route(), '/admin/users') === false ? '' : 'active' ?>" href="<?= make_url('/admin/users') ?>">
                    <span data-feather="users"></span>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(get_route(), '/admin/categories') === false ? '' : 'active' ?>" href="<?= make_url('/admin/categories') ?>">
                    <span data-feather="book-open"></span>
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(get_route(), '/admin/skills') === false ? '' : 'active' ?>" href="<?= make_url('/admin/skills') ?>">
                    <span data-feather="link"></span>
                    Skills
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= strpos(get_route(), '/admin/jobs') === false ? '' : 'active' ?>" href="<?= make_url('/admin/jobs') ?>">
                    <span data-feather="briefcase"></span>
                    Jobs
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Account pages</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="<?= make_url('/logout') ?>">
                    <span data-feather="log-out"></span>
                    Sign Out
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= make_url('/login') ?>">
                    <span data-feather="log-in"></span>
                    Sign In
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= make_url('/register') ?>">
                    <span data-feather="user-plus"></span>
                    Sign UP
                </a>
            </li>
        </ul>
    </div>
</nav>