<?php echo Form::open(array('method' => 'POST', 'enctype' => 'multipart/form-data')); ?>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
<?php echo Form::close(); ?>