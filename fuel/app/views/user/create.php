<h2>New <span class='muted'>User</span></h2>
<br>
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
<?php echo render('user/_form'); ?>


<p><?php echo Html::anchor('user', 'Back'); ?></p>
