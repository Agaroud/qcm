<?php

namespace App\Repository;

use App\Entity\Proposition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Proposition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proposition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proposition[]    findAll()
 * @method Proposition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropositionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Proposition::class);
    }

    public function findAllNull()//:array
    {
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery(
        "SELECT COUNT (p) AS retenu
         FROM App\Entity\Proposition p
         LEFT JOIN App\Entity\Reponse r 
         WITH p.id=r.idProposition   
         WHERE p.vrai = '1' AND  r.idProposition IS NULL");

    // returns an array of Product objects
    $result= $query->execute();    
    return $result[0]['retenu'];        
    }

    public function findMistakes()//:array
    {
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery(
        "SELECT COUNT (p) AS retenu
         FROM App\Entity\Proposition p
         JOIN App\Entity\Reponse r 
         WITH p.id=r.idProposition   
         WHERE p.vrai = '0'");

    // returns an array of Product objects
    $result= $query->execute();    
    return $result[0]['retenu'];
    }
    // /**
    //  * @return Proposition[] Returns an array of Proposition objects
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
    public function findOneBySomeField($value): ?Proposition
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
