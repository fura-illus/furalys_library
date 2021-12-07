<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render("homepage/home.html.twig", [
            'posts' => $postRepository->getPosts(1, 5),
        ]);
    }
}
