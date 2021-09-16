<?php

declare(strict_types = 1);

namespace App\Repository\Book;

use App\Entity\Book\Format;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method \App\Entity\Book\Format|null find($id, $lockMode = null, $lockVersion = null)
 * @method \App\Entity\Book\Format|null findOneBy(array $criteria, array $orderBy = null)
 * @method \App\Entity\Book\Format[] findAll()
 * @method \App\Entity\Book\Format[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormatRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Format::class);
    }

}
