<?php

namespace App\Repository;

use App\Entity\Post;
use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function getPosts(int $page, int $length)
    {
        $queryBuilder = $this->createQueryBuilder('p')
        ->orderBy('p.id', 'desc')
        ->setFirstResult(($page-1) * $length)
        ->setMaxResults($length)
        ;
        return $queryBuilder->getQuery()->getResult();
    }

    public function getCategoryPosts(int $page, int $length, Category $category)
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->where('c.category = :category')
            ->setParameter('category', $category)
            ->orderBy('c.id', 'desc')
            ->setFirstResult(($page-1) * $length)
            ->setMaxResults($length)
        ;
        return $queryBuilder->getQuery()->getResult();
    }
}
