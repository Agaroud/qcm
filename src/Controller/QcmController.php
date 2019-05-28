<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Reponse;
use App\Entity\Question;
use App\Entity\Proposition;
use App\Entity\QuestionQcm;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PropositionRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function index(QuestionRepository $repo, Request $request, ObjectManager $manager)
    {
        $questions= $repo->findQuestions(); 
        //$id=$questions->getId();
        //$quest= $questions->values();      
        dump($questions);
        //dump($questions[0].id);
        //dump($questions[0]['id']);
        foreach($questions as $questionCurrent){            
            $id=$questionCurrent->getId();
            $questionQcm= new QuestionQcm();
            $questionQcm->setIdQuestion($id);
            $manager->persist($questionQcm);
            $manager->flush();
        }
        return $this->render('qcm/index.html.twig', ['questions'=>$questions]); 
              
    }

    /**
     * @Route("/qcm/resultat", name="traitement_qcm")
     */
    public function traitement(Request $request, ObjectManager $manager)
    {
    
        $quest = $request->request->all();
        
        //$prop = $request->request->keys();   
        $user=$this->getUser();
        
        foreach($quest as $prop=>$qst){
            $reponse= new Reponse();
            $reponse->setQuestionId($qst);
            $reponse->setIdProposition($prop);
            $reponse->setCreatedAt(new \DateTime());
            $reponse->setUser($user);
            $manager->persist($reponse);
            $manager->flush();
        }   

        $repository = $this->getDoctrine()->getRepository(Proposition::class);

        $null = $repository->findAllNull();
        $mistakes = $repository->findMistakes();
        dump($mistakes);
        $note = 3-($null)-($mistakes);
        if($note < 0 ){
            $note = 0;
        }    
    
        /*$repo = $this->getDoctrine()->getRepository(Reponse::class);
        $bReponse = $repo->findBonnesReponses();
        dump($bReponse);*/
        return $this->render('qcm/resultat.html.twig', ['user'=>$user, 'note'=>$note ]);
    
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
