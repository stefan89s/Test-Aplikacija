<?php

$article = $data['article'];

?>
<div class="row mt-4">
    <div class="col-md-10">
        <h3><?php echo $article['title']; ?></h3>
        <p><?php echo $article['article']; ?></p>
        <img class="img-responsive article-image" src="<?php echo ROOT_PATH ?>App/assets/article<?php echo $article['id'] ?>.jpg" alt="">
        <div class="row">
            <div class="col-md-6">
                <p><strong><?php echo $article['username']; ?></strong></p>
            </div>
            <div class="col-md-6">
                <p class="float-right"><strong><?php echo $article['date']; ?></strong></p>
            </div>
        </div>
    </div>
    
    <?php if(isset($_SESSION['user-info']) && $_SESSION['user-info']['id'] == $article['user_id']) : ?>
    <div class="col-md-2 mt-4">
        <div class="row mb-2">
            <a href="<?php echo ROOT_PATH; ?>articles/edit/<?php echo $article['id']; ?>" class="btn btn-primary btn-block">Edit</a>
        </div>
        <div class="row mb-2">
            <a href="<?php echo ROOT_PATH; ?>articles/delete/<?php echo $article['id']; ?>" class="btn btn-danger btn-block">Delete</a>
        </div>
    </div>
    <?php endif; ?>
</div>























