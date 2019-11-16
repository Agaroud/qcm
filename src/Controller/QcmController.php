<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\QcmTab;
use App\Entity\Reponse;
use App\Entity\Question;
use App\Entity\Proposition;
use App\Entity\QuestionQcm;
use App\Entity\AlertSalarie;
use App\Repository\UserRepository;
use App\Repository\ReponseRepository;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PropositionRepository;
use App\Repository\QuestionQcmRepository;
use App\Repository\AlertSalarieRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/deconnexion", name="deconnect")
     */
    public function deconnect()
    {
        return $this->render('qcm/deconnexion.html.twig');
    }


    
    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil(Request $request)
    {
        $user=$this->getUser();
        $session=$request->getSession();  
        //$session->remove('mesReponses');
        dump($session->get('mesReponses'));   
               
        return $this->render('qcm/accueil.html.twig', ['user'=>$user]);
    }

      

    /**
     * @Route("/qcm", name="qcm")
     */
    public function index(QuestionQcmRepository $reposit, QuestionRepository $repo, Request $request, ObjectManager $manager)
    {
        $session=$request->getSession();  
        
            $user=$this->getUser();

        
        
            if ($session->has('monQcm')){
                $questions=$session->get('monQcm');
                return $this->render('qcm/index.html.twig', ['questions'=>$questions]); 
            }
        
            else {
                $questions= $repo->findQuestions();         
                $session->set('monQcm', $questions); 
                dump($questions);
              
             
                foreach($questions as $questionCurrent){            
                    $id=$questionCurrent->getId();
                    $questionQcm= new QuestionQcm();
                    $questionQcm->setQuestionId($id); 
                    $questionQcm->setUser($user); 
                    $questionQcm->setCreatedAt(new \DateTime());          
                    $manager->persist($questionQcm);
                    $manager->flush();
                }
                return $this->render('qcm/index.html.twig', ['questions'=>$questions]); 
            }
              
    }

    /**
     * @Route("/resultat", name="traitement_qcm")
     */
    public function traitement(UserRepository $reposite, QuestionQcmRepository $reposit, ReponseRepository $repo,Request $request, ObjectManager $manager)
    {

        $session=$request->getSession();
        $user=$this->getUser();

        if ($session->has('mesReponses')){
            $session->invalidate(); 
            $session->clear(); 
            return $this->redirectToroute('security_logout'); 
        } 

        else {        
            dump($_POST);
            $quest = $request->request->all(); 
            $session->set('mesReponses', $quest);  
            $questions=$session->get('monQcm');           
        
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

            $null = $repository->findAllNull($user);
            $mistakes = $repository->findMistakes($user);
            //$toutBons =$repository->bravo($user);
            //dump($mistakes);
            $note = 3-($null)-($mistakes);

            if($note < 0 ){
            $note = 0;
            }            
        
            $qcmTab= new QcmTab();                      
            $qcmTab->setIdUser($user);
            $qcmTab->setNote($note);
            $qcmTab->setCreatedAt(new \DateTime());
            $manager->persist($qcmTab);
            $manager->flush();
        
            
            $userId = $this->getUser('session')->getId();

            $derniereNote = $reposite->derniereNote($userId,$note);
            $questions=$session->get('monQcm');
            $reset= $reposit->reset($user);
            $resete= $repo->reset($user);  
            return $this->render('qcm/resultat.html.twig', ['questions'=>$questions, 'user'=>$user, 'note'=>$note ]);            
        }    
           
           
    }    

}
