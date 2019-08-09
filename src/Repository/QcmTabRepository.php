<?php

namespace App\Repository;

use App\Entity\QcmTab;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QcmTab|null find($id, $lockMode = null, $lockVersion = null)
 * @method QcmTab|null findOneBy(array $criteria, array $orderBy = null)
 * @method QcmTab[]    findAll()
 * @method QcmTab[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QcmTabRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QcmTab::class);
    }

    // /**
    //  * @return QcmTab[] Returns an array of QcmTab objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QcmTab
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
