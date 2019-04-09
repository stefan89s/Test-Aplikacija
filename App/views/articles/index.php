<?php

# Storing all articles into a new article variable
$articles = $data['articles'];

# Articles per single page 
$articlesPerPage = $data['articlesPerPage'];

# Setting values for the pagination
$numberOfResults = count($articles);

if(!isset($_GET['page'])) {
    $page = 1;
    $pageMin = 1;
} else {
    $page = $_GET['page'];
    $pageMin = $_GET['page'];
}

$resultPerPage = 4;
$thisPageFirstResult = ($page - 1) * $resultPerPage;

$numbersOfPages = ceil($numberOfResults/$resultPerPage);


if($numbersOfPages > 5) {
    $pageMax = $pageMin + 5;
    if($numbersOfPages < $pageMax) {
        $pageMax = $numbersOfPages;
    }
} else {
    $pageMax = $numbersOfPages;
}

?>

<h2>All Articles:</h2>

<!-- Looping through articles per page -->
<div class="row">
<?php foreach($articlesPerPage as $article) : ?>
    <div class="col-md-3 article-box">
    <h3><a href="<?php echo ROOT_PATH ?>articles/show/<?php echo $article['slug']; ?>"><?php echo $article['title']; ?></a></h3>
    <h5>Author: <?php echo $article['username']; ?></h5>
    </div>
<?php endforeach; ?>
</div>

<div class="pagination">

<?php if($pageMin > 1) : ?>
    <a class="pagination-links" href="<?php echo ROOT_URL ?>articles?page=<?php echo $_GET['page'] - 1; ?>"><<</a>
<?php endif; ?>

<?php if($pageMin > 2 && $_GET['page'] <= $numbersOfPages) : ?>
    
    <?php if($pageMax <= $pageMin + 5) : ?>
    <?php 
        
        $pageMin2 = $_GET['page'] - 2; 
        $pageMax = $pageMin + 3; 
        if($pageMin + 3 > $numbersOfPages) {
            $pageMax = $numbersOfPages;
            $pageMin2 = $numbersOfPages - 5;
        }
    ?>
    <?php for($currPage = $pageMin2; $currPage <= $pageMax; $currPage++): ?>
    <?php if($currPage > 0) : ?>
        <a class="pagination-links" href="<?php echo ROOT_URL ?>articles?page=<?php echo $currPage; ?>"> <span <?php echo $currPage == $page ? 'class="active-page"' : '' ?>> <?php echo $currPage; ?> </span> </a>
    <?php endif; ?>
    <?php endfor; ?>
    <?php endif; ?>

<?php elseif($pageMin > 1 && $_GET['page'] < $numbersOfPages - 1) : ?>
    
    <?php if($pageMax <= $pageMin + 5) : ?>
    <?php 
        $pageMin = $pageMin - 1; 
        $pageMax = $numbersOfPages; 
        if($pageMax > 6) {
            $pageMax = $pageMin + 5;
        }
    ?>
    <?php for($currPage = $pageMin - 1; $currPage <= $pageMax; $currPage++): ?>
        <?php if($currPage > 0) : ?>
        <a class="pagination-links" href="<?php echo ROOT_URL ?>articles?page=<?php echo $currPage; ?>"> <span <?php echo $currPage == $page ? 'class="active-page"' : '' ?>> <?php echo $currPage; ?> </span> </a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php endif; ?>
    
<?php else : ?>
    <?php for($currPage = $pageMin - $numbersOfPages; $currPage <= $pageMax; $currPage++): ?>
        <?php if($currPage > 0) : ?>
        <a class="pagination-links" href="<?php echo ROOT_URL ?>articles?page=<?php echo $currPage; ?>"> <span <?php echo $currPage == $page ? 'class="active-page"' : '' ?>> <?php echo $currPage; ?> </span> </a>
        <?php endif; ?>
    <?php endfor; ?>
<?php endif; ?>

<?php if($page < $numbersOfPages) : ?>
    <a class="pagination-links" href="<?php echo ROOT_URL ?>articles?page=<?php echo $_GET['page'] + 1; ?>">>></a>
<?php endif; ?>

</div>























