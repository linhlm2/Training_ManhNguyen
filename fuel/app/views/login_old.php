<?php echo Asset::css('bootstrap.css'); ?>
<div class="container">    
  <div id="loginbox" style="display:none; margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
    <div class="panel panel-info" >
      <div class="panel-heading">
          <div class="panel-title">Sign In</div>
          <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#" onclick="$('#signupbox').hide(); $('#loginbox').hide(); $('#forgotpassword').show();">Forgot password?</a></div>
      </div>     

      <div style="padding-top:30px" class="panel-body" >
        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12">
          
        </div>
        <!-- <form id="loginform" class="form-horizontal" role="form" action="login"> -->
        <?php echo Form::open(array('class'=> 'login-form')); ?>
          <?php echo Form::csrf(); ?>
          <?php if (isset($_GET['destination'])): ?>
            <?php echo Form::hidden('destination', $_GET['destination']); ?>
          <?php endif; ?>

          <?php //if (isset($login_error)): ?>
            <!-- <div class="error"><?php //echo $login_error; ?></div> -->
          <?php //endif; ?>
          
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

          <!-- <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">                                        
          </div> -->
            
          <div class="form-group <?php echo ! $val->error('email') ?: 'has-error' ?>" style="margin-bottom: 25px">
            <label for="email">Email or Username:</label>
            <?php echo Form::input('email', Input::post('email'), array('class' => 'form-control', 'placeholder' => 'Email or Username', 'autofocus')); ?>

            <?php if ($val->error('email')): ?>
              <span class="control-label"><?php echo $val->error('email')->get_message('You must provide a username or email'); ?></span>
            <?php endif; ?>
          </div>
                            
          <!-- <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
          </div> -->

          <div class="form-group <?php echo ! $val->error('password') ?: 'has-error' ?>" style="margin-bottom: 25px">
            <label for="password">Password:</label>
            <?php echo Form::password('password', null, array('class' => 'form-control', 'placeholder' => 'Password')); ?>

            <?php if ($val->error('password')): ?>
              <span class="control-label"><?php echo $val->error('password')->get_message(':label cannot be blank'); ?></span>
            <?php endif; ?>
          </div>
                                
          <div class="input-group">
            <div class="checkbox">
              <label><input id="login-remember" type="checkbox" name="remember" value="1"> Remember me</label>
            </div>
          </div>

          <div style="margin-top:10px" class="form-group">
            <div class="col-sm-12 controls">
              <!-- <a id="btn-login" href="#" class="btn btn-success">Login</a> -->
              <button id="btn-login" class="btn btn-success" type="submit" value="login">Login</button>
            </div>
          </div>

          <div class="form-group">
              <div class="col-md-12 control">
                  <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                      Don't have an account! 
                  <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                      Sign Up Here
                  </a>
                  </div>
              </div>
          </div>
        <?php echo Form::close(); ?>  
        <!-- </form>  -->    
      </div>                     
    </div>  
  </div>

  <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="panel-title">Sign Up</div>
          <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show(); $('#forgotpassword').hide();">Sign In</a></div>
        </div>  
        <div class="panel-body" >
          <form id="signupform" class="form-horizontal" role="form">

            <div id="signupalert" style="display:none" class="alert alert-danger">
              <p>Error:</p>
              <span></span>
            </div>
                              
            <div class="form-group">
                <label for="email" class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="email" placeholder="Email Address">
                </div>
            </div>
                              
            <div class="form-group">
                <label for="firstname" class="col-md-3 control-label">First Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="firstname" placeholder="First Name">
                </div>
            </div>

            <div class="form-group">
                <label for="lastname" class="col-md-3 control-label">Last Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-md-3 control-label">Password</label>
                <div class="col-md-9">
                    <input type="password" class="form-control" name="passwd" placeholder="Password">
                </div>
            </div>

            <div class="form-group">
                <!-- Button -->                                        
                <div class="col-md-offset-3 col-md-9">
                    <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                </div>
            </div>

          </form>
        </div>
      </div>
    </div> 
  </div>

  <div id="forgotpassword" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="panel-title">Forgot Password</div>
          <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show(); $('#forgotpassword').hide();">Sign In</a></div>
        </div>  
        <div class="panel-body" >
          <form id="forgotpwform" class="form-horizontal" role="form">

            <div id="signupalert" style="display:none" class="alert alert-danger">
              <p>Error:</p>
              <span></span>
            </div>
                              
            <div class="form-group">
                <label for="email" class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="email" placeholder="Email Address">
                </div>
            </div>
                              
            <div class="form-group">
                <label for="firstname" class="col-md-3 control-label">Username</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="firstname" placeholder="Username">
                </div>
            </div>

            <div class="form-group">
                <!-- Button -->                                        
                <div class="col-md-offset-3 col-md-9">
                    <button id="btn-forgotpw" type="button" class="btn btn-info"><i class="icon-hand-right"></i> Submit</button>
                </div>
            </div>

          </form>
        </div>
      </div>
    </div> 
  </div>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>