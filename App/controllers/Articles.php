<?php

class Articles extends Controller {

    # The list of articles
    public function index() {
        $articleModel = $this->model('Article');
        $articles = $articleModel->selectAllArticles();

        # Passing all articles into a view
        $this->view('articles/index', [
            'articles' => $articles
        ]);
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

}

























