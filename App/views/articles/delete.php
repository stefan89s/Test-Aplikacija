<?php

$article = $data['article'];

$articleController = new Articles;

?>

<h2>Are You Sure you want to delete article: <strong><?php echo $article['title'] ?></strong></h2>

<div class="row mt-4">
    <div class="col-md-4">
        <a href="<?php echo ROOT_PATH ?>articles/show/<?php echo $article['slug']; ?>" class="btn btn-success btn-block">Cancel</a>
    </div>
    <div class="col-md-4 offset-md-1">
        <form action="<?php $articleController->destroy(); ?>" method="POST">
            <input type="hidden" name="article-id" value="<?php echo $article['id']; ?>">
            <button type="submit" name="delete-article" class="btn btn-danger btn-block">Delete</button>
        </form>
    </div>
</div>


















