<?php
namespace App\Controller;

class NewsController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('Admin/news_admin.html.twig');
    }
}
