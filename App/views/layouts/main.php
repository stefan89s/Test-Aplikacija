<?php

# Adding the HTML head
require 'App/views/includes/head.php';

# Adding navigation
require 'App/views/includes/navigation.php';

?>

<!--Adding the Bootstrap container-->
<div class="container">

<?php

    # Requiring the view from the method pass by the controller
    require $view;

?>

</div>

<?php

//require 'App/views/includes/footer.php';




















