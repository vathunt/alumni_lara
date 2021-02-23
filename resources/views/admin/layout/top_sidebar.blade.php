<!-- HEADER DESKTOP-->
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                &nbsp;
                <div class="header-button">
                    <div class="noti-wrap">
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <span class="quantity">27</span>
                            <div class="notifi-dropdown js-dropdown">
                                <div class="notifi__title">
                                    <p>You have 27 Notifications</p>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="zmdi zmdi-email-open"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a email notification</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c2 img-cir img-40">
                                        <i class="zmdi zmdi-account-box"></i>
                                    </div>
                                    <div class="content">
                                        <p>Your account has been blocked</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c3 img-cir img-40">
                                        <i class="zmdi zmdi-file-text"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a new file</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__footer">
                                    <a href="#">All notifications</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image fotoProfil">
                                <img src="./images/users/{{ Auth::user()->foto_profil ? Auth::user()->foto_profil : 'no-image.png' }}" alt="{{ Auth::user()->name }}" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image fotoProfil">
                                        <a href="#">
                                            <img src="./images/users/{{ Auth::user()->foto_profil ? Auth::user()->foto_profil : 'no-image.png' }}" alt="{{ Auth::user()->name }}" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#">{{ Auth::user()->name }}</a>
                                        </h5>
                                        <span class="email">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="akun">
                                            <i class="zmdi zmdi-account"></i>Akun</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <a href="#" class="logout" onclick="logout()">
                                        <i class="zmdi zmdi-power"></i>Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER DESKTOP-->

<script type="application/javascript">
    function logout(){
        const swalWithBootstrapButtons = Swal.mixin({
            buttonsStyling: true
        });

        swalWithBootstrapButtons.fire({
            title: 'Konfirmasi',
            text: "Anda Akan Keluar dari Halaman Ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-check"></i> Ya, Keluar!',
            cancelButtonText: '<i class="fa fa-ban"></i> Tidak!',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                if(result.isConfirmed){
                    $.ajax({
                        url:"{{ route('logout') }}",
                        type: 'get',
                        success:function() {
                            swalWithBootstrapButtons.fire({
                                title: 'Berhasil',
                                text: "Anda Sudah Logout",
                                icon: 'success',
                                confirmButtonText: '<i class="fa fa-check"></i> OK'
                            }).then(function() {
                                window.location.href = 'admin';
                            });
                        }
                    });
                }
            }else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: 'Batal',
                    text: "Anda Masih Belum Logout",
                    icon: 'info',
                    confirmButtonText: '<i class="fa fa-check"></i> OK'
                });
            }
        });
    }
</script>
