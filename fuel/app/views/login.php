
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tooltest</title>

    <!-- Bootstrap -->
    <?php echo Asset::css('bootstrap.min.css'); ?>

    <!-- Font Awesome -->
    <?php echo Asset::css('font-awesome.css'); ?>
    
    <!-- NProgress -->
    <?php echo Asset::css('nprogress.css'); ?>

    <?php echo Asset::css('animate.css'); ?>
    
    <!-- Custom Theme Style -->
    <?php echo Asset::css('custom.min.css'); ?>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php echo Form::open(array('action' => 'login'), array('class'=> 'login-form')); ?>
            <!-- <form> -->
              <h1>Login Form</h1>
              <?php echo Form::csrf(); ?>
              <?php if (isset($_GET['destination'])): ?>
                <?php echo Form::hidden('destination', $_GET['destination']); ?>
              <?php endif; ?>

              <?php if (isset($login_error)): ?>
                <div class="error"><?php echo $login_error; ?></div>
              <?php endif; ?>
              
              <?php if (Session::get_flash('success')): ?>
                <div class="alert alert-success alert-dismissable">
                  <p>
                  <?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
                  </p>
                </div>
              <?php endif; ?>
              <?php if (Session::get_flash('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                  <p>
                  <?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
                  </p>
                </div>
              <?php endif; ?>
             <!--  <div>
                <input type="text" class="form-control" placeholder="Username or Email" required="" />
              </div> -->

              <div class="form-group <?php echo ! $val->error('email') ?: 'has-error' ?>" style="margin-bottom: 25px">
                <!-- <label for="email">Email or Username:</label> -->
                <?php echo Form::input('email', Input::post('email'), array('class' => 'form-control', 'placeholder' => 'Email or Username', 'autofocus')); ?>

                <?php if ($val->error('email')): ?>
                  <span class="control-label"><?php echo $val->error('email')->get_message('You must provide a username or email'); ?></span>
                <?php endif; ?>
              </div>

              <!-- <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div> -->
  
              <div class="form-group <?php echo ! $val->error('password') ?: 'has-error' ?>" style="margin-bottom: 25px">
                <!-- <label for="password">Password:</label> -->
                <?php echo Form::password('password', null, array('class' => 'form-control', 'placeholder' => 'Password')); ?>

                <?php if ($val->error('password')): ?>
                  <span class="control-label"><?php echo $val->error('password')->get_message(':label cannot be blank'); ?></span>
                <?php endif; ?>
              </div>

              <div>
                <button class="btn btn-default submit" type="submit">Log in</button>
                <a class="reset_pass" href="forgotpassword">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            <!-- </form> -->
            <?php echo Form::close(); ?>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
              <?php if (isset($login_error)): ?>
                <div class="error"><?php echo $login_error; ?></div>
              <?php endif; ?>
              
              <?php if (Session::get_flash('success')): ?>
                <div class="alert alert-success alert-dismissable">
                  <p>
                  <?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
                  </p>
                </div>
              <?php endif; ?>
              <?php if (Session::get_flash('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                  <p>
                  <?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
                  </p>
                </div>
              <?php endif; ?>
            <?php echo Form::open(array('action' => 'register'), array('class'=> 'register-form')); ?>
            <?php echo Form::csrf(); ?>
            <!-- <form> -->
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" name="username" placeholder="Username" required="" id="register_username" />
              </div>
              <div>
                <input type="email" class="form-control" name="email" placeholder="Email" required="" id="register_email"/>
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" id="register_password"/>
              </div>
              <div>
                <input type="password" class="form-control" name="password_comfirm" placeholder="Confirm Password" required="" id="register_password_confirm"/>
              </div>
              <div>
                <button class="btn btn-default submit" type="submit" value="register" href="register">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            <!-- </form> -->
            <?php echo Form::close(); ?>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
