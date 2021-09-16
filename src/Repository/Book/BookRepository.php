<?php

declare(strict_types = 1);

namespace App\Repository\Book;

use App\Entity\Book\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method \App\Entity\Book\Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method \App\Entity\Book\Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method \App\Entity\Book\Book[] findAll()
 * @method \App\Entity\Book\Book[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

}
