<?php

# Article data
$articleData = $data['article'];

# Creating new object for article
$article = new Articles;

?>

<a href="<?php echo ROOT_PATH; ?>articles/show/<?php echo $articleData['slug'] ?>" class="btn btn-primary mt-2">Cancel</a>

<div class="col-md-10 offset-md-1">
    <h2>Edit the Article:</h2>
    <form action="<?php $article->update(); ?>" method="POST">
        <input class="form-control" type="text" name="title" value="<?php echo $articleData['title']; ?>"><br>
        <input class="form-control" name="slug" value="<?php echo $articleData['slug']; ?>"><br>
        <input type="hidden" name="article-id" value="<?php echo $articleData['id']; ?>">
        <textarea class="form-control" name="article" id="" cols="30" rows="10"><?php echo $articleData['article']; ?></textarea><br>
        <button class="btn btn-success btn-block" name="update-article" type="submit">Edit</button><br>
    </form>
</div>


























