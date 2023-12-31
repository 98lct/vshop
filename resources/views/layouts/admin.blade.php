<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <title>V-shop Admin - @yield('title')</title>
    <link rel="stylesheet" href="{{asset('backend/css/timeline.css')}}">
    <link href="{{asset('backend/vendor/font-awesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/bootstrap/bootstrap.min.css')}}">
    <link href="{{asset('backend/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/vendor/jquery-ui-1.12.1/jquery-ui.css')}}"> @yield('style')
    <script type="text/javascript">
        function ChangeToSlug(){var e;e=(e=(e=(e=(e=(e=(e=(e=(e=(e=(e=(e=(e=(e=(e=(e=document.getElementById("ipt_to_slug").value.toLowerCase()).replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/g,"a")).replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/g,"e")).replace(/i|í|ì|ỉ|ĩ|ị/g,"i")).replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/g,"o")).replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/g,"u")).replace(/ý|ỳ|ỷ|ỹ|ỵ/g,"y")).replace(/đ/g,"d")).replace(/([^0-9a-z-\s])/g,"")).replace(/(\s+)/g,"-")).replace(/\-\-\-\-\-/gi,"-")).replace(/\-\-\-\-/gi,"-")).replace(/\-\-\-/gi,"-")).replace(/\-\-/gi,"-")).replace(/^-+/g,"")).replace(/-+$/g,""),document.getElementById("slug").value=e}
    </script>

</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon ">
                    <img src="{{asset('upload/user')}}/{{ Auth::user()->img }}" height="40px">
                </div>
                <div class="sidebar-brand-text mx-3">V-shop Admin<sup>2</sup></div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            </div>

            <!-- Nav Item - Pages Collapse Menu -->


            <li class="nav-item">
                <a class="nav-link" href="{{route('IndexProduct')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Product</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('IndexBrand')}}">
          <i class="fas fa-tags"></i>
          <span>Brand</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('IndexCategory')}}">
          <i class="fal fa-box-open"></i>
          <span>Category</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">

            </div>
            @if(Auth::user()->index=='3'||Auth::user()->index=='2')
            <li class="nav-item">
                <a class="nav-link" href="{{route('IndexUser')}}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>User</span></a>

            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{route('IndexOrder')}}">
          <i class="far fa-shopping-bag"></i>
          <span>Order</span></a>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('IndexContact')}}">
          <i class="far fa-sms"></i>
          <span>Contact</span></a>

            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="{{route('IndexPost')}}">
          <i class="fal fa-newspaper"></i>
          <span>Post</span></a>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('IndexTopic')}}">
          <i class="fab fa-ethereum"></i>
        <span>Topic</span></a>

            </li>
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Interface</span>
        </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Component</h6>
                        <a class="collapse-item" href="{{route('IndexSlider')}}">Slider</a>
                        <a class="collapse-item" href="{{route('IndexAdverts')}}">Adverts</a>
                        <a class="collapse-item" href="{{route('IndexMenu')}}">Menu</a>
                        <a class="collapse-item" href="{{route('IndexSites')}}">Site</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->


            <!-- Nav Item - Charts -->


            <!-- Nav Item - Tables -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
              </button>
                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                      <i class="fas fa-search fa-sm"></i>
                    </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                  </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm bg-light border-0 small" placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter">3+</span>
                  </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <!-- Counter - Messages -->
                    <span class="badge badge-danger badge-counter">7</span>
                  </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up
                                            the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this
                                            to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    <img class="img-profile rounded-circle" src="{{asset('upload/user')}}/{{ Auth::user()->img }}">
                  </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile
                    </a>
                                <a class="dropdown-item" href="#">
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Settings
                    </a>
                                <a class="dropdown-item" href="#">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                      Activity Log
                    </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" {{ __( 'Logout')
                                    }} data-toggle="modal" data-target="#logoutModal">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                     Thoát
                    </a>
                            </div>
                        </li>

                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </nav>
                <div class="container-fluid">
                    @yield('main')
                </div>
            </div>
        </div>


        <!-- Logout Modal-->
        <!--ajax-->
        <!--ajax-->
        <script src="{{asset('backend/js/jquery-3.3.1.slim.min.js')}}"></script>
{{--        {<script src="{{asset('backend/js/jquery.min.js')}}"></script>
 --}}        <script src="{{asset('backend/vendor/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{asset('backend/js/popper.min.js')}}"></script>
        <script src="{{asset('backend/vendor/bootstrap/bootstrap.bundle.min.js')}}"></script>
          <script src="{{asset('backend/vendor/datatables/jquery.dataTables.js')}}"></script>
                <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
      

        <script src="{{asset('backend/vendor/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('backend/js/sb-admin-2.js')}}"></script>

        <!-- Custom scripts for all pages-->

        <?php
  //{{--xử lý click vào hình ảnh để chọn hay thay đổi hình ảnh. hình ảnh mới sẽ xuất hiện để xem trước--}}?>
            <script>
                $("#img").click(function(){
        $("#imgipt").click();
    });
  function showimg(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#img')
        .attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }

}
            </script>
            <script>
                $(".btn-edit").click(function(){
  $("#imgold").val($(this).attr('imgo'));
    $("#imgipt").val("");
  $("#img").attr('src',"public/upload/product/"+$(this).attr('imgo'));
});
            </script>
            <script type="text/javascript">
                $(document).on('click', '#btn-add', function(){
    //$('#modal-add').modal('show');
  CKEDITOR.replace('detail');
  //tích hợp ckeditor trong modal bs4
});
            </script>
            <script type="text/javascript">
                $('.toast').toast('show')
  $(document).ready(function() {
        $('#dataTable').DataTable();

      })
            </script>

            @yield('script')
</body>

</html>
