<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render("homepage/home.html.twig", [
            'posts' => $this->postRepository->getPosts(1, 5),
        ]);
    }

    /**
     * @Route("/load_more/{page}", name="post_load_more", requirements={"page": "\d+"})
     */
    public function loadMore(int $page)
    {
        return $this->render("homepage/post.html.twig", [
            'posts' => $this->postRepository->getPosts($page, 5),
        ]);
    }
}
