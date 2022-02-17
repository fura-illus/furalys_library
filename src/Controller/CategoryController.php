<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    private $categoryRepository;
    private $postRepository;

    public function __construct(CategoryRepository $categoryRepository, PostRepository $postRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * @Route("/category", name="category_show")
     */
    public function showCategories(): Response
    {
        return $this->render('category/showCategory.html.twig', [
            'categories' => $this->categoryRepository->findAll()
        ]);
    }

    /**
     * @Route("/category_posts/{id}/{page}", name="category_posts", requirements={"page": "\d+"})
     */
    public function categoryPosts(Category $category, int $page): Response
    {
        return $this->render('category/categoryPosts.html.twig', [
            'posts' => $this->postRepository->getCategoryPosts($page, 3, $category),
        ]);
    }
}
