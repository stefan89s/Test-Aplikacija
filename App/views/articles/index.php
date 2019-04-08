<?php

# Storing all articles into a new article variable
$articles = $data['articles'];

?>

<h2>All Articles:</h2>

<!-- Looping through all articles -->
<?php foreach($articles as $article) : ?>
    <h3><a href="<?php echo ROOT_PATH ?>articles/show/<?php echo $article['slug']; ?>"><?php echo $article['title']; ?></a></h3>
    <h5>Author: <?php echo $article['username']; ?></h5>
<?php endforeach; ?>


























