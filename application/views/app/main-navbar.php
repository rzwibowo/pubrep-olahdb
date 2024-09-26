<nav class="navbar navbar-light navbar-glass navbar-top sticky-kit navbar-expand-lg">
    <button class="btn navbar-toggler-humburger-icon navbar-toggler mr-1 mr-sm-3" type="button" data-toggle="collapse" data-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
    <a class="navbar-brand mr-1 mr-sm-3" href="#">
        <div class="d-flex align-items-center"><img class="mr-2" src="<?php echo base_url(); ?>/assets/img/illustrations/golden.png" alt="" height="30" />
            <!-- <span class="text-sans-serif">falcon</span> -->
        </div>
    </a>

    <ul class="navbar-nav navbar-nav-icons ml-auto flex-row align-items-center">
        <li class="nav-item mr-2 text-right nama-op" 
            data-toggle='tooltip' data-placement='bottom' 
            title='<?php echo $this->session->nama_operator ?>' 
            style="text-overflow:ellipsis;white-space:nowrap;overflow:hidden;">
            <?php echo $this->session->nama_operator ?>
        </li>
        <li class="nav-item dropdown dropdown-on-hover">
            <a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-xl">
                    <img class="rounded-circle" src="<?php echo base_url(); ?>/assets/<?php echo isset($this->session->foto_operator) && $this->session->foto_operator != 'no_gambar.jpg' ? 'gambar/operator/' . $this->session->foto_operator : 'img/team/avatar.png' ?>" alt="" />
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownUser">
                <div class="bg-white rounded-soft py-2">

                    <a class="dropdown-item" href="pages/profile.html">Profile &amp; account</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>app/logout">Logout</a>
                </div>
            </div>
        </li>
    </ul>
</nav>