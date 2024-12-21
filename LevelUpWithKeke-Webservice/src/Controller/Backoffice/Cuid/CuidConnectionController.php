<?php

namespace App\Controller\Backoffice\Cuid;

use App\Entity\CMSitemSettings;
use App\Entity\CMSmenu;
use App\Entity\CMSUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\Security;
use App\Service\Form\SubmitForm;
use App\Service\Mailer\Mailer;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Executer\Executer;
use App\Service\Form\Connection;
use DateTimeImmutable;

class CuidConnectionController extends AbstractController
{

    private $security;
    private $submitform;
    private $mailer;
    private $entityManager;
    private $executer;

    public function __construct(Security $security, SubmitForm $submitform, Mailer $mailer , EntityManagerInterface $entityManager,Executer $executer  ) {

        $this->security = $security;
        $this->submitform = $submitform;
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
        $this->executer = $executer;

    }

    #[Route('/cuid/connection', name: 'cuid_admin_connection')]
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
            

                $class = CMSUser::class;
                $classstring = "user";


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

                        
                        return $this->redirectToRoute('cuid_admin_'.$classstring.'_tutorial');


                    }else{

                        return $this->redirectToRoute('cuid_admin_'.$classstring.'_dashboard',['section' => "home"]);

                    }

                }

            }else{

                $this->executer->startConnection($entity,$today,$token);
                $this->entityManager->flush();
                $session->set('user', $entity);
                $firstconnection=$this->security->FirstTimeCheck($session);

                    /*Tester si c'est la première connexion de l'utilisateur */

                if($firstconnection == TRUE){

                        
                    return $this->redirectToRoute('cuid_admin_'.$classstring.'_tutorial');


                }else{

                    return $this->redirectToRoute('cuid_admin_'.$classstring.'_dashboard',['section' => "home"]);

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

        return $this->render('backoffice/cuid/connection.html.twig', [
            'form' => $form->createView(),
            'error_connection' => $error_connection
        ]);
    }


    



}
