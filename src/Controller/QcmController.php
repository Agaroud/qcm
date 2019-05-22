<?php

namespace App\Controller;

use DateTime;
use App\Entity\Reponse;
use App\Entity\Question;
use App\Entity\Proposition;
use App\Repository\QuestionRepository;
use App\Repository\PropositionRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class QcmController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        return $this->render('qcm/home.html.twig');
    }

    /**
     * @Route("/qcm", name="qcm")
     */
    public function index(QuestionRepository $repo, Request $request)
    {
        $questions= $repo->findAll();
        dump($questions);      
        return $this->render('qcm/index.html.twig', [/*
        'controller_name' => 'QcmController',*/
        'questions'=>$questions]); 
               
    }

    /**
     * @Route("/qcm/resultat", name="traitement_qcm")
     */
    public function traitement(Request $request, ObjectManager $manager){
    
    $quest = $request->request->all();
    //$prop = $request->request->keys();   
    $user=$this->getUser();
    foreach($quest as $prop=>$qst){
        $reponse= new Reponse();
        $reponse->setQuestionId($qst);
        $reponse->setIdProposition($prop);
        $reponse->setCreatedAt(new \DateTime());
        $manager->persist($reponse);
        $manager->flush();
    }

    $repository = $this->getDoctrine()->getRepository(Proposition::class);

    $null = $repository->findAllNull();
    $mistakes = $repository->findMistakes();
    dump($mistakes);
    $note = 5-($null)-($mistakes);
    if($note < 0 ){
        $note = 0;
    }


    
    /*SELECT *
FROM proposition 
LEFT JOIN reponse ON proposition.id = reponse.id_proposition
WHERE proposition.vrai = '1'*/
    
    
return $this->render('qcm/resultat.html.twig', ['note'=>$note]);
    
    }


    /**
     * @Route("/qcm", name="qcm")
     */
    /*public function create(){
        this->render ('qcm/index.html.twig');
    }
  

    /**
     * @Route("/qcm/{idQuestion}", name="qcm")
     */

    /*public function propo(Propositions $propositions)
    {
        $repo = $this->getDoctrine()->getRepository(Proposition::class);        
        return $this->render('qcm/index.html.twig', ['propositions'=> $propositions]);
    }*/
}
