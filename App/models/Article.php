<?php

class Article extends Model {

    # Select all articles
    public function selectAllArticles() {
        $query = "SELECT * FROM articles LEFT JOIN users
                  ON users.id = articles.user_id";
        $this->query($query);
        return $this->fetchAll();
    }

    # Articles per single page
    public function articlesPerPage() {
        $resultPerPage = 4;
        $numberOfResults = count($this->selectAllArticles());

        if(!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $thisPageFirstResult = ($page - 1) * $resultPerPage;

        $query = "SELECT * FROM articles LEFT JOIN users
                  ON users.id = articles.user_id LIMIT " .$thisPageFirstResult . ', ' . $resultPerPage;
        $this->query($query);
        return $this->fetchAll();
    }

    # Store the article
    public function storeArticle($title, $slug, $userId, $article) {
        # SQL Statement for storing the article
        $insertStatement = "INSERT INTO articles(title, slug, article, user_id) 
                            VALUES (:title, :slug, :article, :user_id)";

        $this->query($insertStatement);
        $this->bind(':title', $title);
        $this->bind(':slug', $slug);
        $this->bind(':article', $article);
        $this->bind(':user_id', $userId);
        $this->execute();

        header('Location: ' . ROOT_PATH . 'articles');
    }

    # Select single article
    public function selectArticle() {
        $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        $slug = $url[2];

        # Query for a single article
        $query = "SELECT * FROM users LEFT JOIN articles
                  ON articles.user_id = users.id WHERE slug = :slug";

        $this->query($query);
        $this->bind(':slug', $slug);
        return $this->fetchSingle();
    }

    # Select the article for editing
    public function editArticle() {
        $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        $articleId = $url[2];

        # Query the article
        $query = "SELECT * FROM articles WHERE id = :id";

        $this->query($query);
        $this->bind(':id', $articleId);
        return $this->fetchSingle();
    }

    # Update the article
    public function updateArticle($title, $slug, $article, $articleId) {
        # SQL Statement for updating the article
        $updateStatement = "UPDATE articles SET title = :title, slug = :slug,
        article = :article WHERE id = :id";

        $this->query($updateStatement);
        $this->bind(':title', $title);
        $this->bind(':slug', $slug);
        $this->bind(':article', $article);
        $this->bind(':id', $articleId);
        $this->execute();

        header('Location: ' . ROOT_PATH . 'articles/show/' . $slug);
    }

    # Page for deleting article
    public function deletePage() {
        $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        $articleId = $url[2];

        # Query the article
        $query = "SELECT * FROM articles WHERE id = :id";

        $this->query($query);
        $this->bind(':id', $articleId);
        return $this->fetchSingle();
    }

    # Delete article
    public function deleteArticle($articleId) {
        #Statement for deleting article
        $deleteStatement = "DELETE FROM articles WHERE id = :id";
        
        $this->query($deleteStatement);
        $this->bind(':id', $articleId);
        $this->execute();

        header('Location: ' . ROOT_PATH . 'articles');
    }

}
























