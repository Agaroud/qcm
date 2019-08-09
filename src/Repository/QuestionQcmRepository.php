<?php

namespace App\Repository;

use App\Entity\QuestionQcm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QuestionQcm|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionQcm|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionQcm[]    findAll()
 * @method QuestionQcm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionQcmRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QuestionQcm::class);
    }


    public function reset($user)
    {       
               
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            "DELETE FROM App\Entity\QuestionQcm q WHERE q.user=:var ")->setParameter('var',$user);            
            $result= $query->execute();
            return $result;
    }

    // /**
    //  * @return QuestionQcm[] Returns an array of QuestionQcm objects
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
    public function findOneBySomeField($value): ?QuestionQcm
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
