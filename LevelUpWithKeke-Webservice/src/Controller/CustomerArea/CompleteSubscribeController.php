<?php

namespace App\Controller\CustomerArea;

use App\Entity\Booking;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Mailer\Mailer;
use App\Service\Executer\Executer;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Customer;
use DateTimeImmutable;


class CompleteSubscribeController extends AbstractController
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



    #[Route('/weiter-registrierung/{tempCode}', name: 'cuid_complete_subscribe')]
    public function index($tempCode): Response
    {
       

        $message="";
        $error=0;
        $entity = $this->entityManager->getRepository(Customer::class)->findByTempCode($tempCode);
        $today = new DateTimeImmutable();
        $customer = $entity;



        if (isset($_POST["login"])) {


            $loginexist = $this->entityManager->getRepository(Customer::class)->findByEmailOrLogin($_POST["login"], $_POST["email"]);


        if(is_null($loginexist) == 1){


            if($_POST["confirm_password"] == $_POST["password"]){

                $bookingofcustomer = $this->entityManager->getRepository(Booking::class)->findOneByCustomer($entity);

                            
            $entity->setFirstname($_POST["firstname"]);   
            $entity->setSurname($_POST["surname"]);   
            $entity->setEmail($_POST["email"]);   
            $entity->setTelephone($_POST["telephone"]); 
            $entity->setLogin($_POST["login"]);
            $hashpassword = md5($_POST["password"]);
            $entity->setPassword($hashpassword);
            $entity->setMainLocation($bookingofcustomer->getLocation());
            $activationCode=$this->executer->generateRandomString();
            $entity->setActivationCode($activationCode);
            $entity->setCreationDate($today);
            $entity->setSignedUp(1);
            $entity->setState(0);
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
            $link="https://".$_SERVER['SERVER_NAME']."/connexion";

            $code = $entity->getActivationCode();

            $emailmessage=str_replace("%LOGIN%",$_POST["login"],$this->mailer->GetEmailConfirmation());
            $emailmessage=str_replace("%FIRSTNAME%",$_POST["firstname"],$emailmessage);
            $emailmessage=str_replace("%LINK%",$link,$emailmessage);

            $this->mailer->sendEmail($_POST["email"], "ProcleanReinigung : Ihr Konto wurde erstellt", $emailmessage);
            $message="Ihr Kundenkonto wurde registriert. Melden Sie sich an, um es anzuzeigen";
            
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
            'error'=>$error,
            
            

        ]);


        }


        return $this->render('completeSubscribe.html.twig',['customer'=>$customer]);




    }
}
