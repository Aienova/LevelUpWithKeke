<?php

namespace App\Controller\Form;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Mailer\Mailer;
use App\Service\Executer\Executer;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Customer;
use DateTimeImmutable;

class CreateCustomerController extends AbstractController
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



    #[Route('/create-customer', name: 'cuid_create_candidate')]
    public function index(): Response
    {



        $message="";
        $error=0;
        $entity = new Customer;
        $today = new DateTimeImmutable();



        if (isset($_POST["login"])) {


            $loginexist = $this->entityManager->getRepository(Customer::class)->findByEmailOrLogin($_POST["login"], $_POST["email"]);


        if(is_null($loginexist) == 1){


     
            if($_POST["confirm_password"] == $_POST["password"]){

            
            $entity->setFirstname($_POST["firstname"]);   
            $entity->setSurname($_POST["surname"]);   
            $entity->setEmail($_POST["email"]);   
            $entity->setTelephone($_POST["telephone"]); 
            $entity->setLogin($_POST["login"]);
            $hashpassword = md5($_POST["password"]);
            $entity->setPassword($hashpassword);
            $entity->setMainLocation($_POST["mainlocation"]);
            $activationCode=$this->executer->generateRandomString();
            $entity->setActivationCode($activationCode);
            $entity->setCreationDate($today);
            $this->entityManager->persist($entity);
            $this->entityManager->flush();

            $code = $entity->getActivationCode();

            $emailmessage=str_replace("%LINK%",""."https://".$_SERVER['SERVER_NAME']."/confirmation/0/".$code,$this->mailer->GetEmailConfirmation());

            $this->mailer->sendEmail($_POST["email"], "Oneted : Confirmer votre inscription", $emailmessage);
            $message="Inscription enregistrée, un mail de confirmation vous a été envoyé à ".$_POST["email"]." pour finaliser votre inscription";
            
            }else{

                $message="Vos deux mot de passe ne sont pas identitques";
                $error=1;

            }


        }else{

            $message="Ce login ou cette email existe déjà";
                $error=1;

        }


        return $this->render('popup.html.twig', [

            'formmessage' =>$message,
            'error'=>$error

        ]);


        }else{



            return $this->render('popup.html.twig', [

                'formmessage' =>"Veuillez remplir le formulaire",
                'error'=>$error
    
            ]);

        }



    }
}
