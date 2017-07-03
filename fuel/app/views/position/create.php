<h2>New <span class='muted'>Position</span></h2>
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

<?php echo render('position/_form'); ?>


<p><?php echo Html::anchor('position', 'Back'); ?></p>
