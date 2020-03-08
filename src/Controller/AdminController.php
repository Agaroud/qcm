<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Reponse;
use App\Entity\Question;
use App\Entity\Proposition;
use App\Entity\QuestionQcm;
use App\Entity\QcmTab;
use App\Form\QuestionType;
use App\Form\PropositionType;
use App\Repository\UserRepository;
use App\Repository\ReponseRepository;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PropositionRepository;
use App\Repository\QuestionQcmRepository;
use App\Repository\QcmTabRepository;
use App\Repository\AlertSalarieRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AdminController extends AbstractController
{
    /**
     * @Route("/admin" , name="admin_homepage")
     */
    public function index(UserRepository $repo) {
        $salaries=$repo->findAll();
        return $this->render('qcm/admin.html.twig', ['salaries'=>$salaries]);
    }

   /**
     * @Route("/admin/employeScores/{idUser}/{firstNameUser}/{nameUser}" , name="employe_scores")
     */
    public function scoreList(QcmTabRepository $reposit,$idUser, $firstNameUser, $nameUser) {
        $scores=$reposit->findByidUser(array($idUser), array('createdAt' => 'desc'));        
        return $this->render('qcm/employeScores.html.twig', ['scores'=>$scores , 'firstName'=>$firstNameUser, 'name'=>$nameUser]);
    }

    /**
     * @Route("/admin/newQuestion" , name="admin_newquestion")
     */
    public function nouvelleQuestion(Request $request, ObjectManager $manager){
        $question= new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){            
            
            $manager->persist($question);
            $manager->flush(); 
            
            return $this->redirectToRoute('admin_questions');    
           }

        return $this-> render('qcm/newQuestion.html.twig', ['form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/admin/questions" , name="admin_questions")
     */

    public function questions(QuestionRepository $repo, Request $request, ObjectManager $manager) {
        $question= new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);
        $questions=$repo->findAll();
        

        if($form->isSubmitted() && $form->isValid()){            
            
            $manager->persist($question);
            $manager->flush(); 
            
            return $this->redirectToRoute('admin_questions');    
        }

        return $this->render('qcm/questions.html.twig', ['questions'=>$questions, 'formQuestion'=> $form->createView()]);

        }

    /**
     * @Route("/admin/propositions/{id}" , name="propositions_list")
     */
    public function propositionList( Request $request, ObjectManager $manager, QuestionRepository $repo, $id) {
        
        $question=$repo->find($id); 
        

        //new proposition form//
        $proposition= new Proposition();
        $form = $this->createForm(PropositionType::class, $proposition);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){            
            $proposition->setQuestion($question);
            $manager->persist($proposition);
            $manager->flush(); 
            
            return $this->redirectToRoute('propositions_list' , ['id'=> $id]);    
           }   
        return $this->render('qcm/propositions.html.twig', ['question'=>$question, 'formProposition'=> $form->createView()]);
        
        
    }

/**
 * @Route("/admin/question/{id}/delete", name="question_delete")
 */
public function questionRemove(ObjectManager $manager, QuestionRepository $repo, $id)
{
    

    $question=$repo->find($id); 
    $manager->remove($question);
    $manager->flush();

    // Suggestion: add a message in the flashbag

    // Redirect to the table page
    return $this->redirectToRoute('admin_questions'); 
}

/**
 * @Route("/admin/propositions/{pid}/{id}/delete", name="proposition_delete")
 */
public function propositionRemove(ObjectManager $manager, PropositionRepository $repo, $pid, $id)
{
    

    $proposition=$repo->find($pid); 
    $manager->remove($proposition);
    $manager->flush();

    // Suggestion: add a message in the flashbag

    // Redirect to the table page
    return $this->redirectToRoute('propositions_list', ['id'=> $id]); 
}

/**
 * @Route("/admin/user/{id}/delete", name="user_delete")
 */
public function userRemove(ObjectManager $manager, UserRepository $repo, $id)
{
    

    $user=$repo->find($id); 
    $manager->remove($user);
    $manager->flush();

    // Suggestion: add a message in the flashbag

    // Redirect to the table page
    return $this->redirectToRoute('admin_homepage'); 
}

/**
 * @Route("/admin/user/{id}/enable", name="user_enable")
 */
public function userEnable(ObjectManager $manager, UserRepository $repo, $id)
{ 

    $activer = $repo->activerUser($id);
    return $this->redirectToRoute('admin_homepage'); 
}


    /**
     * @Route("/newProposition" , name="admin_newproposition")
     */
    /*public function nouvelleProposition(Request $request, ObjectManager $manager){
        $proposition= new Proposition();
        $form = $this->createForm(PropositionType::class, $proposition);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){            
            
            $manager->persist($proposition);
            $manager->flush(); 
            
            return $this->redirectToRoute('propositions_list');    
           }

        return $this-> render('qcm/newProposition.html.twig', ['form'=> $form->createView()
        ]);
    }*/


        
}

