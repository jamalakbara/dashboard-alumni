<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-menu-user img-radius" src="/files/assets/images/avatar-4.jpg" alt="User-Profile-Image" />
                <div class="user-details">
                    <p id="more-details">
                        John Doe<i class="feather icon-chevron-down m-l-10"></i>
                    </p>
                </div>
            </div>
            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="user-profile.html">
                            <i class="feather icon-user"></i>View Profile
                        </a>
                        <a href="#!">
                            <i class="feather icon-settings"></i>Settings
                        </a>
                        <a href="auth-normal-sign-in.html">
                            <i class="feather icon-log-out"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pcoded-navigation-label">Menu</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="<?php if ($title == 'Rekapitulasi') { ?>active<?php } ?>">
                <a href="/dashboard" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-folder"></i>
                    </span>
                    <span class="pcoded-mtext">Rekapitulasi</span>
                </a>
            </li>
            <li class="<?php if ($title == 'Bidang') { ?>active<?php } ?>">
                <a href="/bidang" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-briefcase"></i>
                    </span>
                    <span class="pcoded-mtext">Bidang</span>
                </a>
            </li>
            <li class="<?php if ($title == 'Alumni') { ?>active<?php } ?>">
                <a href="/alumni" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-award"></i>
                    </span>
                    <span class="pcoded-mtext">Alumni</span>
                </a>
            </li>
            <li class="<?php if ($title == 'Upload') { ?>active<?php } ?>">
                <a href="/upload" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-upload"></i>
                    </span>
                    <span class="pcoded-mtext">Upload</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- [ navigation menu ] end -->