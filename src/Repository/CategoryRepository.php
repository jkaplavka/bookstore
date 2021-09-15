<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method \App\Entity\Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method \App\Entity\Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method \App\Entity\Category[] findAll()
 * @method \App\Entity\Category[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

}
