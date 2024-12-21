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

class RecoverCustomerController extends AbstractController
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



    #[Route('/recover-customer', name: 'cuid_recover_customer')]
    public function index(Request $request): Response
    {


        $message="";
        $error=0;



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

            $this->mailer->sendEmail($email, "Oneted : Confirmer votre inscription", $emailmessage);
            $message="Votre demande de réinitialsiation de mot de passe a été envoyé à votre adresse email ".$email.", veuillez consulter vos mails pour procéder à création d'un nouveau de passe";
            
            }else{

                $message="Ce login ou cette email n'existe pas";
                $error=1;

            }

                // ...
                // Redirect or render success page
                // return $this->redirectToRoute('success_route');
        }


        return $this->render('forms/recoverAccount.html.twig', [

            'message' =>$message,
            'usertype'=>0,
            'error'=>$error
        ]);
    }
}
