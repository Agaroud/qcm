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

    public function findAllNull($user)//:array
    {
    
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery(/*COUNT (p) AS retenu*/
        "SELECT  (p.question) as mistake
         FROM App\Entity\Proposition p
         JOIN App\Entity\QuestionQcm q         
         WITH p.question=q.questionId
         AND q.user=:var         
         LEFT JOIN App\Entity\Reponse r 
         WITH p.id=r.idProposition         
         WHERE p.vrai = '1' 
         AND r.idProposition IS NULL ")->setParameter('var',$user);

    // returns an array of Product objects
    $result= $query->execute();
    dump($result); 
    return $result;   
    //return $result[0]['retenu'];        
    }

    public function findMistakes($user)//:array
    {
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery(/*COUNT (p) AS retenu*/
        "SELECT (p.question) as mistake
         FROM App\Entity\Proposition p
         JOIN App\Entity\QuestionQcm q
         WITH p.question = q.questionId
         JOIN App\Entity\Reponse r 
         WITH p.id=r.idProposition
         WHERE r.user=:var   
         AND p.vrai = '0' ")->setParameter('var',$user);


    // returns an array of Product objects
    $result= $query->execute();
    dump($result);       
    //return $result[0]['retenu'];
    return $result;
    }

    /*public function bravo($user)
    { 
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            "SELECT c FROM App\Entity\Proposition p
             JOIN App\Entity\QuestionQcm q 
             WITH p.question = q.questionId
             JOIN App\Entity\Reponse r
             WITH p.id=r.idProposition
             WHERE r.user=:var
             AND p.vrai = '1' ")->setParameter('var',$user);            
            $result= $query->execute();
            return $result;
            
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
