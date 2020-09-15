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
            <li class="<?php if ($title == 'Menu 1') { ?>active<?php } ?>">
                <a href="/dashboard" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">Menu 1</span>
                </a>
            </li>
            <li class="<?php if ($title == 'Menu 2') { ?>active<?php } ?>">
                <a href="/menu2" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">Menu 2</span>
                </a>
            </li>
            <li class="<?php if ($title == 'Menu 3') { ?>active<?php } ?>">
                <a href="/menu3" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="feather icon-home"></i>
                    </span>
                    <span class="pcoded-mtext">Menu 3</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- [ navigation menu ] end -->