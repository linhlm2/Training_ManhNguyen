
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <?php echo Asset::css('bootstrap.min.css'); ?>

    <!-- Font Awesome -->
    <?php echo Asset::css('font-awesome.min.css'); ?>

    <!-- NProgress -->
    <?php echo Asset::css('nprogress.css'); ?>

    <!-- iCheck -->
    <?php echo Asset::css('green.css'); ?>
  
    <!-- bootstrap-progressbar -->
    <?php echo Asset::css('bootstrap-progressbar-3.3.4.css'); ?>

    <!-- JQVMap -->
    <?php echo Asset::css('jqvmap.css'); ?>

    <!-- bootstrap-daterangepicker -->
    <?php echo Asset::css('daterangepicker.css'); ?>

    <!-- Custom Theme Style -->

    <?php echo Asset::css('custom.min.css'); ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-home"></i> <span>Home</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <!-- <img src="" alt="..." class="img-circle profile_img"> -->
                <?php echo Asset::img('img.jpg', array('class' => 'img-circle profile_img')) ?>
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <?php if (Session::get('user_info')): ?>
                  <!-- <h2>John Doe</h2> -->
                  <h2><?php echo Session::get('user_info'); ?></h2>
                <?php endif; ?>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li>
                    <!-- <a href="index" id="homepage"><i class="fa fa-home"></i> Home </a> -->
                    <?php echo Html::anchor('user/index', '<i class="fa fa-home"></i> Home'); ?>
                  </li>
                  <li>
                    <!-- <a href="department" id="departmentpage"><i class="fa fa-edit"></i>  </a> -->
                    <?php echo Html::anchor('department/index', '<i class="fa fa-edit"></i> Department'); ?>
                  </li>
                  <li>
                    <?php echo Html::anchor('position/index', '<i class="fa fa-edit"></i> Position'); ?>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <!-- <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div> -->
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="images/img.jpg" alt=""> -->
                    <?php if (Session::get('user_info')): ?>
                      <!-- <h2>John Doe</h2> -->
                      <?php echo Asset::img('img.jpg', array('alt' => '')) ?><?php echo Session::get('user_info'); ?>
                    <?php endif; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <!-- <li><a href="login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li> -->
                    <li><?php echo Html::anchor('login/logout/', '<i class="fa fa-sign-out pull-right"></i> Log Out'); ?> </li>
                  </ul>
                </li>

                <!-- <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> -->
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <?php echo $content; ?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <?php echo Asset::js('jquery.min.js'); ?>

    <!-- Bootstrap -->
    <?php echo Asset::js('bootstrap.min.js'); ?>

    <!-- FastClick -->
    <?php echo Asset::js('fastclick.js'); ?>

    <!-- NProgress -->
    <?php echo Asset::js('nprogress.js'); ?>

    <!-- Chart.js -->
    <?php echo Asset::js('Chart.min.js'); ?>

    <!-- gauge.js -->
    <?php echo Asset::js('gauge.min.js'); ?>

    <!-- bootstrap-progressbar -->
    <?php echo Asset::js('bootstrap-progressbar.min.js'); ?>

    <!-- iCheck -->
    <?php echo Asset::js('icheck.min.js'); ?>

    <!-- Skycons -->
    <?php echo Asset::js('skycons.js'); ?>

    <!-- Flot -->
    <?php echo Asset::js('jquery.flot.js'); ?>
    <?php echo Asset::js('jquery.flot.pie.js'); ?>
    <?php echo Asset::js('jquery.flot.time.js'); ?>
    <?php echo Asset::js('jquery.flot.stack.js'); ?>
    <?php echo Asset::js('jquery.flot.resize.js'); ?>

    <!-- Flot plugins -->
    <?php echo Asset::js('jquery.flot.orderBars.js'); ?>
    <?php echo Asset::js('jquery.flot.spline.min.js'); ?>
    <?php echo Asset::js('curvedLines.js'); ?>

    <!-- DateJS -->
    <?php echo Asset::js('date.js'); ?>

    <!-- JQVMap -->
    <?php echo Asset::js('jquery.vmap.js'); ?>
    <?php echo Asset::js('jquery.vmap.world.js'); ?>
    <?php echo Asset::js('jquery.vmap.sampledata.js'); ?>

    <!-- bootstrap-daterangepicker -->
    <?php echo Asset::js('moment.min.js'); ?>
    <?php echo Asset::js('daterangepicker.js'); ?>

    <!-- Custom Theme Scripts -->
    <?php echo Asset::js('custom.min.js'); ?>
    
    <!-- Datepicker -->
    <?php echo Asset::js('bootstrap-datetimepicker.min.js') ?>

    <!-- CustomJS -->
    <?php echo Asset::js('personal.js') ?>

  </body>
</html>
