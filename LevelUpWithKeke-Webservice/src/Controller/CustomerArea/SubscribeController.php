<?php

namespace App\Controller\CustomerArea;

use App\Entity\CMSWebsite;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Mailer\Mailer;
use App\Service\Executer\Executer;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Customer;
use DateTimeImmutable;


class SubscribeController extends AbstractController
{



    private EntityManagerInterface $entityManager;
    private  Mailer $mailer;
    private  Executer $executer;

public function __construct(EntityManagerInterface $entityManager, Mailer $mailer, Executer $executer)
{
    $this->entityManager = $entityManager;
    $this->mailer =  $mailer;
    $this->executer =  $executer;
}



    #[Route('/inscription', name: 'cuid_subscribe')]
    public function index(): Response
    {
       

        $message="";
        $error=0;
        $entity = new Customer;
        $today = new DateTimeImmutable();



        if (isset($_POST["login"])) {


            $loginexist = $this->entityManager->getRepository(Customer::class)->findByEmailOrLoginSubscribe($_POST["login"], $_POST["email"]);

            
        if(is_null($loginexist) == 1){


            if($_POST["confirm_password"] == $_POST["password"]){


                if($_POST["firstname"]==""){

                    $message="Bitte geben Sie Ihren Vornamen ein";
                    $error=1;

                    return $this->render('popup.html.twig', [

                        'formmessage' =>$message,
                        'error'=>$error
            
                    ]);

                    exit;

                }

                
                if($_POST["surname"]==""){

                    $message="Bitte geben Sie Ihren Vornamen ein";
                    $error=1;

                    return $this->render('popup.html.twig', [

                        'formmessage' =>$message,
                        'error'=>$error
            
                    ]);

                    exit;

                }

            
            $entity->setFirstname($_POST["firstname"]);   
            $entity->setSurname($_POST["surname"]);   
            $entity->setEmail($_POST["email"]);   
            $entity->setTelephone($_POST["telephone"]); 
            $entity->setLogin($_POST["login"]);
            $hashpassword = md5($_POST["password"]);
            $entity->setPassword($hashpassword);
            $entity->setMainLocation("");
            $activationCode=$this->executer->generateRandomString();
            $entity->setActivationCode($activationCode);
            $entity->setCreationDate($today);
            $entity->setState(0);
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
            $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);

            $code = $entity->getActivationCode();
            $emailmessage=str_replace("%LOGIN%",$entity->getLogin(),$this->mailer->GetEmailConfirmation());
            $emailmessage=str_replace("%LINK%",""."https://".$_SERVER['SERVER_NAME']."/confirmation/0/".$code,$emailmessage);
            $emailmessageforadmin = $this->mailer->GetEmailCustomerInfos($entity);
            $this->mailer->sendEmail($_POST["email"], 14, $emailmessage);
            $this->mailer->sendEmail($website->getEmail(), 15, $emailmessageforadmin);
            
            $message="
            L'inscription est enregistrée, un email de confirmation vous a été envoyé ".$_POST["email"]." pour terminer votre inscription";
            
            }else{

                $message="Vos deux mots de passe ne sont pas identiques";
                $error=1;

            }


        }else{

            $message="Cet identifiant ou cette adresse email existe déjà";
                $error=1;

        }


        return $this->render('popup.html.twig', [

            'formmessage' =>$message,
            'error'=>$error

        ]);


        }


        return $this->render('subscribe.html.twig');

    }
}
