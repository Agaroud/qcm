<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use App\Entity\Proposition;
use App\Repository\PropositionRepository;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

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
    public function index(QuestionRepository $repo)
    {
        $questions= $repo->findAll();        
        return $this->render('qcm/index.html.twig', [
        'controller_name' => 'QcmController',
        'questions'=>$questions]);
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
