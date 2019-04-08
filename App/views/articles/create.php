<?php

$article = new Articles();

?>

<div class="col-md-10 offset-md-1">
    <h2>Create the Article:</h2>
    <form action="<?php $article->store(); ?>" method="POST">
        <input class="form-control" type="text" name="title" placeholder="Title"><br>
        <input class="form-control" type="text" name="slug" placeholder="Slug"><br>
        <input type="hidden" name="user-id" value="<?php echo $_SESSION['user-info']['id']; ?>">
        <textarea class="form-control" name="article" id="" cols="30" rows="10"></textarea><br>
        <button class="btn btn-success btn-block" name="create-article" type="submit">Publish</button><br>
    </form>
</div>























