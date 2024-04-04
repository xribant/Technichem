<?php

namespace App\Repository;

use App\Entity\CompanyData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyData>
 *
 * @method CompanyData|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyData|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyData[]    findAll()
 * @method CompanyData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyData::class);
    }

    //    /**
    //     * @return CompanyData[] Returns an array of CompanyData objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CompanyData
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
