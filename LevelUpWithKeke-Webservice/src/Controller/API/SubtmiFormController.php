<?php

namespace App\Controller\API;

use App\Entity\CMSWebsite;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Executer\Executer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use DateTimeImmutable;
use App\Entity\Document;
use App\Service\Form\SubmitForm;
use App\Service\Form\UploadDocument;
use App\Service\Form\UploadImage;
use App\Service\Mailer\Mailer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SubtmiFormController extends AbstractController
{

    private $entityManager;
    private $executer;
    private $submitform;
    private $mailer;

    public function __construct(EntityManagerInterface $entityManager,Executer $executer,SubmitForm $submitform, Mailer $mailer) {
    
        $this->entityManager = $entityManager;
        $this->executer = $executer;
        $this->submitform = $submitform;
        $this->mailer = $mailer;
    }


    #[Route('/api/data/submit/{action}', name: 'api_data_submit')]
    public function submitForm(Request $request, $action): Response
    {

        $postData = json_decode($request->getContent(), true);
        $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);

        if($action=="booking"){

            $newbooking = $this->submitform->createBooking($postData);

            $email = $postData["email"];

            $emailmessage=$this->mailer->GetEmailBooking($newbooking,$email,$newbooking->getVisitor());
            $emailmessageforcompany=$this->mailer->GetEmailBookingForCompany($newbooking,$email,$newbooking->getVisitor());

            $this->mailer->sendEmail($email, 3 , $emailmessage);
            $this->mailer->sendEmail($website->getEmail(), 4 , $emailmessageforcompany);
        }

        $message="Votre rendez-vous a bien été enregistré";

        return $this->json(['message' => $message]);
    }
}


        
    