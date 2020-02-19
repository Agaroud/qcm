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
     * @Route("/employeScores/{idUser}/{firstNameUser}/{nameUser}" , name="employe_scores")
     */
    public function scoreList(QcmTabRepository $reposit,$idUser, $firstNameUser, $nameUser) {
        $scores=$reposit->findByidUser(array($idUser), array('createdAt' => 'desc'));        
        return $this->render('qcm/employeScores.html.twig', ['scores'=>$scores , 'firstName'=>$firstNameUser, 'name'=>$nameUser]);
    }

    /**
     * @Route("/newQuestion" , name="admin_newquestion")
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
     * @Route("/questions" , name="admin_questions")
     */

    public function questions(QuestionRepository $repo) {
        $questions=$repo->findAll();
        return $this->render('qcm/questions.html.twig', ['questions'=>$questions]);
    }

    /**
     * @Route("/propositions/{id}" , name="propositions_list")
     */
    public function propositionList(QuestionRepository $repo, $id) {
        
        $question=$repo->find($id);    
        return $this->render('qcm/propositions.html.twig', ['question'=>$question]);
    }

        
}

