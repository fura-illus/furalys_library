<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Repository\PostRepository;

class HomepageController extends AbstractController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(PostRepository $postRepository): Response
    {
        return new Response($this->twig->render("homepage/home.html.twig", [
            'posts' => $postRepository->getPosts(1, 5),
        ]));
    }
}
