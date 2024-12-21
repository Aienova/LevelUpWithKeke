<?php
        namespace App\Controller\CustomerArea;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Form\Connection;
use App\Entity\Candidate;
use App\Entity\Customer;
use App\Entity\Recruiter;
use App\Service\Executer\Executer;
use App\Service\Security\Security;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use DateTimeImmutable;



class RendezVousController extends AbstractController
{

    private $entityManager;
    private $executer;
    private $security;



    public function __construct(EntityManagerInterface $entityManager,Executer $executer, Security $security) {
    
        $this->entityManager = $entityManager;
        $this->executer = $executer;
        $this->security = $security;

    }


    #[Route('/rendez-vous', name: 'cuid_rdv')]
    public function index(Request $request,SessionInterface $session): Response
    {

        $form = $this->createForm(Connection::class);
        $form->handleRequest($request);
   
        $error_connection=0;
        $today = new DateTimeImmutable();
        $token = $this->executer->GenerateToken($today);

                // Start the session

                // Retrieve a session variable
               // $username = $this->session->get('username');
               $session->clear();
               $session->start();
              
        
               // Set a session variable
               $session->set('token', $token);
               $session->set('connection-statut', 0);

        if ($form->isSubmitted() && $form->isValid()) {



            $session->set('connection-statut', 1);
            


                $class = Customer::class;
                $classstring = "customer";


            $login=$_POST["connection"]["login"];
            $hashpassword=md5($_POST["connection"]["password"]);
            $entity = $this->entityManager->getRepository($class)->findByLoginAndPassword($hashpassword,$login);
            $session->set('user', $entity);
      
            

           
            if($entity==NULL){

                $entity = $this->entityManager->getRepository($class)->findByEmailAndPassword($hashpassword,$login);


                if($entity==NULL){

                    $error_connection=1;
  
                }else{

                    $this->executer->startConnection($entity,$today,$token);
                    $this->entityManager->flush();
                    $firstconnection=$this->security->FirstTimeCheck($session);
                    


                    /*Tester si c'est la première connexion de l'utilisateur */

                    
                    if($firstconnection == TRUE){

                        
                        return $this->redirectToRoute('cuid_'.$classstring.'_area_first_time');


                    }else{

                        return $this->redirectToRoute('cuid_'.$classstring.'_area_home');

                    }

                }

            }else{

                $this->executer->startConnection($entity,$today,$token);
                $this->entityManager->flush();
                $session->set('user', $entity);
                $firstconnection=$this->security->FirstTimeCheck($session);

                    /*Tester si c'est la première connexion de l'utilisateur */

                if($firstconnection == TRUE){

                        
                    return $this->redirectToRoute('cuid_'.$classstring.'_area_home');


                }else{

                    return $this->redirectToRoute('cuid_'.$classstring.'_area_home');

                }

            }

                // ...
                // Redirect or render success page
                // return $this->redirectToRoute('success_route');
        }


        //Example (Remove this next time)
     /*   $id=1;
        $type=0;
        $notification = $this->entityManager->getRepository(Notification::class)->findByUserNoSeen($id,$type);
        $notficationcount=sizeof($notification); */

        return $this->render('rendez-vous.html.twig', [
            'form' => $form->createView(),
            'error_connection' => $error_connection
        ]);
    }
}

        
    