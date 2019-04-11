<?php

class Articles extends Controller {

    # The list of articles
    public function index() {
        $articleModel = $this->model('Article');
        $articles = $articleModel->selectAllArticles();
        $articlesPerPage = $articleModel->articlesPerPage();

        # The articles stored in JSON
        $allArticlesJSON = $articleModel->selectAllArticlesJSON();

        # Passing all articles into a view
        $this->view('articles/index', [
            'articles' => $articles,
            'articlesPerPage' => $articlesPerPage,
            'allArticlesJSON' => $allArticlesJSON
        ]);
    }

    # Returning only JSON articles
    public function articlesJSON() {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        $articleModel = $this->model('Article');
        $allArticles = $articleModel->selectAllArticles();
        return json_encode($data);
    }

    # Create the article page
    public function create() {
        $this->view('articles/create');
    }

    # Store the article
    public function store() {
        if(isset($_POST['create-article'])) {
            $title = $_POST['title'];
            $slug = $_POST['slug'];
            $userId = $_POST['user-id'];
            $article = $_POST['article'];

            $articleModel = $this->model('Article');
            $articleModel->storeArticle($title, $slug, $userId, $article);
        }
    }

    # Store decoded article from JSON
    public function storeArticleJSON() {
        $data = json_decode(file_get_contents("php://input"));
        $articleModel = $this->model('Article');
        $articleModel->storeArticleJSON($data);
    }

    # Show the single article
    public function show() {
        $articleModel = $this->model('Article');
        $article = $articleModel->selectArticle();
        $this->view('articles/show', [
            'article' => $article
        ]);
    }

    # Edit the article page
    public function edit() {
        $articleModel = $this->model('Article');
        $article = $articleModel->editArticle();
        $this->view('articles/edit', [
            'article' => $article
        ]);
    }

    # Update the article
    public function update() {
        if(isset($_POST['update-article'])) {
            $title = $_POST['title'];
            $slug = $_POST['slug'];
            $article = $_POST['article'];
            $articleId = $_POST['article-id'];

            $articleModel = $this->model('Article');
            $articleModel->updateArticle($title, $slug, $article, $articleId);
        }
    }

    # Update the decoded article from JSON
    public function updateArticleJSON() {
        $data = json_decode(file_get_contents("php://input"));
        $articleModel = $this->model('Article');
        $articleModel->updateArticleJSON($data);
    }

    # Delete the article page
    public function delete() {
        $articleModel = $this->model('Article');
        $article = $articleModel->deletePage();
        $this->view('articles/delete', [
            'article' => $article
        ]);
    }

    # Delete the article
    public function destroy() {
        if(isset($_POST['delete-article'])) {
            $articleId = $_POST['article-id'];
            $articleModel = $this->model('Article');
            $articleModel->deleteArticle($articleId);
        }
    }

    # Delete the article through JSON
    public function destroyArticleJSON() {
        $data = json_decode(file_get_contents("php://input"));
        $articleId = $data->article_id;
        $articleModel = $this->model('Article');
        $articleModel->deleteArticleJSON($articleId);
    }

}

























