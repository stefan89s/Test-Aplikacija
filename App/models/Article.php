<?php

class Article extends Model {

    # Select all articles
    public function selectAllArticles() {
        $query = "SELECT * FROM articles LEFT JOIN users
                  ON users.id = articles.user_id";
        $this->query($query);
        return $this->fetchAll();
    }

    # Selecting all articles and storing them in JSON
    public function selectAllArticlesJSON() {
        $query = "SELECT * FROM articles LEFT JOIN users
                  ON users.id = articles.id";

        $this->query($query);
        $allArticles = $this->fetchAll();
        return json_encode($allArticles);
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

        # Selecting the article for the current page
        $query = "SELECT * FROM users LEFT JOIN articles
        ON articles.user_id = users.id ORDER BY articles.id DESC LIMIT " .$thisPageFirstResult . ', ' . $resultPerPage;

        $this->query($query);
        return $articles = $this->fetchAll();
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

        $selectArticle = "SELECT * FROM articles WHERE slug = :slug";
        $this->query($selectArticle);
        $this->bind(':slug', $slug);
        $articleId = $this->fetchSingle();

        $this->uploadImage($articleId['id']);

        header('Location: ' . ROOT_PATH . 'articles');
    }

    # Store article through JSON
    public function storeArticleJSON($data) {
        $title = $data->title;
        $slug = $data->slug;
        $article = $data->article;
        $userId = $data->user_id;
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

    # Update article through JSON
    public function updateArticleJSON($data) {
        $title = $data->title;
        $slug = $data->slug;
        $article = $data->article;
        $articleId = $data->article_id;

        # SQL Statement for updating the article
        $updateStatement = "UPDATE articles SET title = :title, slug = :slug,
        article = :article WHERE id = :id";

        $this->query($updateStatement);
        $this->bind(':title', $title);
        $this->bind(':slug', $slug);
        $this->bind(':article', $article);
        $this->bind(':id', $articleId);
        $this->execute();
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

        # Deleting the image from the assets
        $this->deleteImage($articleId);

        header('Location: ' . ROOT_PATH . 'articles');
    }

    # Delete article from JSON
    public function deleteArticleJSON($articleId) {
        #Statement for deleting article
        $deleteStatement = "DELETE FROM articles WHERE id = :id";

        # Deleting the image from the assets
        $this->deleteImage($articleId);
        
        $this->query($deleteStatement);
        $this->bind(':id', $articleId);
        $this->execute();
    }

    # Upload image
    public function uploadImage($id) {
        # File name from the form
        $file = $_FILES['file-image'];
 
        # Inforamtions about the file
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileTemp = $file['tmp_name'];
        $fileType = $file['type'];

        # Storing the image extension
        $fileExplode = explode(".", $fileName);

        # Making sure all letters from the extension are lower letters
        $lowerType = strtolower(end($fileExplode));

        # Allowed file types for uploading the image
        $fileAllowed = array('jpg', 'jpeg', 'png');

        if (in_array($lowerType, $fileAllowed)) {
            if ($fileError === 0) {
                if ($fileSize) {
                    $newName = "article".$id.".jpg";
                    $fileDestination = ASSETS_PATH . $newName;
                    move_uploaded_file($fileTemp, $fileDestination);
                    
                } else {
                    echo "your file is too big";
                }
            } else {
                echo "you have an error";
            }
        } else {
            echo "you cannot upload this type of file";
        }
            
    }

    # Delete image
    public function deleteImage($id) {
        # File path in which the image is sotred
        $file = ASSETS_PATH . "article" . $id . ".jpg";

        # Deleting the image
        unlink($file);
    }

}
























