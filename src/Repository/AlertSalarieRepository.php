<?php

namespace App\Repository;

use App\Entity\AlertSalarie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AlertSalarie|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlertSalarie|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlertSalarie[]    findAll()
 * @method AlertSalarie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlertSalarieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AlertSalarie::class);
    }

    // /**
    //  * @return AlertSalarie[] Returns an array of AlertSalarie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AlertSalarie
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
