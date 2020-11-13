<?php
include_once 'classes/Database.php';
include_once APP_PATH . '/classes/Update.php';
include_once APP_PATH . '/classes/Utils.php';
include_once APP_PATH . '/logic/installLogic.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once 'components/meta.php';?>
  <title><?php echo APP_NAME; ?> - Installation</title>
  <?php include_once 'components/css.php';?>
</head>

<body class="bg-dark">
  <div class="container pt-3">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Install</div>
      <div class="card-body">
        <form method="POST">
          <?php if (isset($msg)): ?>
            <?php $utils->show_alert("Panel has been installed.", "success", "check-circle");?>
          <?php endif;?>

          <?php if (!isset($_POST['install'])): ?>
          <div class="alert alert-primary text-center border-primary">
              <b>
                <div>
                PHP Version: <?php echo PHP_VERSION; ?>
                <br />
                <?php foreach ($required_libs as $common_name => $lib_name): ?>
                <?php echo $common_name . ": ", extension_loaded($lib_name) ? "OK" : "Missing", "<br />"; ?>
                <?php array_push($is_installed, extension_loaded($lib_name));?>
                <?php endforeach;?>
                <?php foreach ($writable_folders as $folder_name): ?>
                <?php echo $folder_name . ": ", is_writable($folder_name) ? "Writable" : "Not Writable", "<br />"; ?>
                <?php array_push($is_writable, is_writable($folder_name));?>
                <?php endforeach;?>
                </div>
              </b>
          </div>
          <?php endif;?>

          <h3 class="text-center">Create an admin user</h3>

          <div class="form-group">
            <div class="form-label-group">
              <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
              <label for="username">Username</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input class="form-control" type="password" id="password" name="password" placeholder="Password" required>
              <label for="password">Password</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-label-group">
              <input class="form-control" type="email" id="email" name="email" placeholder="Email Address" required>
              <label for="email">Email Address</label>
            </div>
          </div>

          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="EULA" name="EULA" required>
              <label class="custom-control-label" for="EULA">I agree to <a href="https://github.com/FarisCode511/BlackNET/blob/main/EULA.md">EULA</a></label>
            </div>
          </div>

          <?php if (in_array(false, $is_installed) || in_array(false, $is_writable) || PHP_VERSION_ID < 70200): ?>
          <button type="submit" class="btn btn-primary btn-block" name="install" disabled>Start Installation</button>
          <?php else: ?>
          <button type="submit" class="btn btn-primary btn-block" name="install">Start Installation</button>
          <?php endif;?>
        </form>
      </div>
    </div>
  </div>
  <?php include_once 'components/js.php';?>

</body>

</html>
