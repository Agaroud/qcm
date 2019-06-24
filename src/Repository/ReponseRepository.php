<?php

namespace App\Repository;

use App\Entity\Reponse;
use App\Entity\Proposition;
use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Reponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reponse[]    findAll()
 * @method Reponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReponseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Reponse::class);
    }

    public function reset($user)
    {       
               
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            "DELETE FROM App\Entity\Reponse r WHERE r.user=:var")->setParameter('var',$user);            
            $result= $query->execute();
            return $result;
    }

    /*public function findBonnesReponses()//:array
    {
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery(
        "SELECT p AS bonne
         FROM App\Entity\Proposition p
         JOIN App\Entity\Reponse r 
         WITH p.id=r.idProposition   
         WHERE p.vrai = '1'");

    // returns an array of Product objects
    $result= $query->execute();    
    return $result['bonne'];
    }*/
    // /**
    //  * @return Reponse[] Returns an array of Reponse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reponse
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
