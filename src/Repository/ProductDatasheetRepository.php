<?php

namespace App\Repository;

use App\Entity\ProductDatasheet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductDatasheet>
 *
 * @method ProductDatasheet|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductDatasheet|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductDatasheet[]    findAll()
 * @method ProductDatasheet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductDatasheetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductDatasheet::class);
    }

    //    /**
    //     * @return ProductDatasheet[] Returns an array of ProductDatasheet objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ProductDatasheet
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
