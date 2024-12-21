<?php

namespace App\Controller\CustomerArea;

use App\Entity\CMSmenu;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Service\Executer\Executer;
use App\Service\Mailer\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;






            class OblivionController extends AbstractController {


                private EntityManagerInterface $entityManager;
private  Mailer $mailer;
private  Executer $executer;

public function __construct(EntityManagerInterface $entityManager, Mailer $mailer, Executer $executer)
{
$this->entityManager = $entityManager;
$this->mailer =  $mailer;
$this->executer =  $executer;
}



                #[Route('/mot-de-passe-oublie', name: 'cuid_oblivion')]
                public function index(): Response
                {


                    $message="";
                    $error=0;
                    
            $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();  
            $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();
       
            $customer = $this->entityManager->getRepository(Customer::class)->find(1);

                    
        if (isset($_POST["recover"])) {


            $entity=$this->entityManager->getRepository(Customer::class)->findByEmailOrLogin($_POST["recover"],$_POST["recover"]);

    
        if(is_null($entity) != 1){

            $this->entityManager->persist($entity);
            $recoverCode=$this->executer->generateRandomString();
            $entity->setRecoverCode($recoverCode);
            $email=$entity->getEmail();
            $this->entityManager->flush();


            $code = $entity->getRecoverCode();

            $emailmessage=str_replace("%LINK%",""."https://".$_SERVER['SERVER_NAME']."/nouveau-mot-de-passe/0/".$code,$this->mailer->GetEmailRecovering());

            $this->mailer->sendEmail($email,19, $emailmessage);

            $message="Votre demande de réinitialsiation de mot de passe a été envoyé à votre adresse email ".$email.", veuillez consulter vos mails pour procéder à création d'un nouveau de passe";
            
            }else{

                $message="Ce login ou cette email n'existe pas";
                $error=1;

            }

                // ...
                // Redirect or render success page
                // return $this->redirectToRoute('success_route');
        }

                    return $this->render('oblivion.html.twig', [

                        'message' =>$message,
                        'error'=>$error,
                        "part" => "customer-area",
                        "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                        "socials"=>$socialmedia,
                        "customer"=>$customer,
                        "menu"=>$menu
                    ]);
                }

                
            }
