
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="collapse navbar-collapse" id="navbarsExample03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo ROOT_PATH; ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo ROOT_PATH; ?>articles">List of Articles <span class="sr-only">(current)</span></a>
      </li>
      <!-- This link will be available only if the user is loged in -->
      <?php if(isset($_SESSION['user-info'])) : ?>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo ROOT_PATH; ?>articles/create">Create an Article <span class="sr-only">(current)</span></a>
      </li>
      <?php endif; ?>
    </ul>

    <!-- Show log in link if the user is not logged in -->
    <?php if(!isset($_SESSION['user-info'])) : ?>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo ROOT_PATH ?>users">Log In</a>
      </li>
    </ul>
    <?php else: ?>
      <?php
        # Creating new user's object
        if(!class_exists('Users')) {
          require 'App/controllers/Users.php';
          $user = new Users;
        } else {
          $user = new Users;
        }
      ?>
      <h5 class="nav-item nav-item-color1">Hello <?php echo $_SESSION['user-info']['username']; ?></h5>
      <form action="<?php $user->logout(); ?>" method="POST" class="form-inline ml-4">
        <button name="user-logout" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Log Out</button>
      </form>
    <?php endif; ?>
  </div>
</nav>