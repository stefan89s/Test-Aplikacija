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
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo ROOT_PATH; ?>articles/create">List of Articles <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo ROOT_PATH ?>users">Log In</a>
      </li>
    </ul>
  </div>
</nav>