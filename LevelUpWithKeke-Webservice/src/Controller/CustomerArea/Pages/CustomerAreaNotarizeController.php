<?php

namespace App\Controller\CustomerArea\Pages;

use App\Entity\Booking;
use App\Entity\CMSgraphics;
use App\Entity\CMSmenu;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Entity\Decision;
use App\Entity\Notarize;
use App\Entity\NotarizeType;
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


            class CustomerAreaNotarizeController extends AbstractController {
                private $security;
                private $entityManager;
                private $submitform;
                private $mailer;
            
                public function __construct(Security $security,EntityManagerInterface $entityManager,SubmitForm $submitform, Mailer $mailer ) {
            
                    $this->security = $security;
                    $this->entityManager = $entityManager;
                    $this->submitform = $submitform;
                    $this->mailer = $mailer;
            
                }
            
                #[Route('/service-en-ligne/nouvelle-demande', name: 'cuid_customer_area_new_notarize')]
                public function index(Request $request,SessionInterface $session): Response
                {
                   /*  Start All Pages with this CODE */   $this->security->SecurityCheck($session); 
            
                 $part="customer-area";
                 $user=$session->get("user");
                 $userid=$user->getId();
                 $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();
                 $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
                 $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);
                 $notarizetypes = $this->entityManager->getRepository(NotarizeType::class)->findAll();
                 $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);   
                 $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();                 
                 
                 $sent = 0;
                 $formmessage = "";

            
        if(isset($_POST["notarizeType"])){

            $type =  $this->entityManager->getRepository(NotarizeType::class)->find($_POST["notarizeType"]);

            $checkalready = $this->entityManager->getRepository(Notarize::class)->findByTypeCustomerAndCurrent($_POST["notarizeType"],$customer);

            if($checkalready == null){
                     $directory=$this->getParameter('upload_directory');

                     $code = $this->submitform->randomizeCode($customer);

                     $documentlinks = "";

                     $entity = $this->submitform->createNotarizeForCustomer("",$_POST,$customer,$code);

      // Define your target directory
      $targetDir = $directory."/notarize/".$customer->getId()."/".$code;

      // Ensure that the target directory exists
      if (!is_dir($targetDir)) {
          mkdir($targetDir, 0777, true);
      }
  
      // Count total files
      $totalFiles = count($_FILES["notarizeFile"]['name']);


      // Loop through each file
      for($i=0; $i<$totalFiles; $i++) {
          $fileName = basename($_FILES["notarizeFile"]['name'][$i]);
          $targetFilePath = $targetDir ."/". $fileName;
  
          // Check if file is selected and then proceed to move it to the target directory
          if (!empty($_FILES["notarizeFile"]['name'][$i])) {
              // You can add more validations here (file size, file type, etc.)
              if(move_uploaded_file($_FILES["notarizeFile"]['tmp_name'][$i], $targetFilePath)){

                  echo "The file ".$fileName. " has been uploaded.";
              } else{
                  echo "Sorry, there was an error uploading your file.";
              }
          }


          $this->submitform->storeFilesForDocument($fileName,$entity,$code,$customer);
          
          $documentlinks .="<a href='".$website->getLink()."cuid/document/notarize/".$customer->getId()."/".$code."/".$fileName."'><li>".$fileName."</li></a>";
      }
                     $path=$directory."/";

                     

            $formmessage="Votre demande a bien été enregistré, un mail de confirmation a été envoyé à :<br>".$customer->getEmail();

            $emailmessage=$this->mailer->GetEmailNotarize($entity);
            $emailmessagforcompany=$this->mailer->GetEmailNotarizeForCompany($entity);

            $this->mailer->sendEmail($customer->getEmail(),1, $emailmessage);
            $this->mailer->sendEmail($website->getEmail(),2, $emailmessagforcompany);

            $sent = 1;

    }else{


        $formmessage="Une demande pour ".$type->getFRName()." est actuellement en cours veuillez attendre sa finalisation";

        $sent = 1;
    }



        }

            return $this->render($part.'/pages/notarize.html.twig',[

                'part' => $part,
                'sent' => $sent,
                'formmessage' => $formmessage,
                'description'=>"Authentifer un document",             
                'title' => "Service en ligne - Authentifer un document",
                'menu'=>$menu,
                "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                'graphics'=>$graphics,
                'customer' => $customer,
                'socials' => $socialmedia,
                'notarizeTypes'=>$notarizetypes
    
            ]);

        
            
                }


                #[Route('/service-en-ligne/infos-maquantes/{notarizeid}', name: 'cuid_customer_area_notarize_missing')]
                public function missing($notarizeid,Request $request,SessionInterface $session): Response
                {
                   /*  Start All Pages with this CODE */   $this->security->SecurityCheck($session); 
            
                 $part="customer-area";
                 $user=$session->get("user");
                 $userid=$user->getId();
                 $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();
                 $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
                 $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);
                 $notarizetypes = $this->entityManager->getRepository(NotarizeType::class)->findByAuthentication(TRUE);
                 $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
                 $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();                 
                 
                 $sent = 0;
                 $formmessage = "";

                 $entity = $this->entityManager->getRepository(Notarize::class)->find($notarizeid);

                 $code = $entity->getNumberId();

            
        if(isset($_POST["notarizeType"])){

            $entity->setDecision($this->entityManager->getRepository(Decision::class)->find(2));

                     $directory=$this->getParameter('upload_directory');




                     $documentlinks = "";



      // Define your target directory
      $targetDir = $directory."/notarize/".$customer->getId()."/".$code;

      // Ensure that the target directory exists
      if (!is_dir($targetDir)) {
          mkdir($targetDir, 0777, true);
      }
  
      // Count total files
      $totalFiles = count($_FILES["notarizeFile"]['name']);


      // Loop through each file
      for($i=0; $i<$totalFiles; $i++) {
          $fileName = basename($_FILES["notarizeFile"]['name'][$i]);
          $targetFilePath = $targetDir ."/". $fileName;
  
          // Check if file is selected and then proceed to move it to the target directory
          if (!empty($_FILES["notarizeFile"]['name'][$i])) {
              // You can add more validations here (file size, file type, etc.)
              if(move_uploaded_file($_FILES["notarizeFile"]['tmp_name'][$i], $targetFilePath)){

                  echo "The file ".$fileName. " has been uploaded.";
              } else{
                  echo "Sorry, there was an error uploading your file.";
              }
          }


          $this->submitform->storeFilesForDocument($fileName,$entity,$code,$customer);
          
          $documentlinks .="<a href='".$website->getLink()."cuid/document/notarize/".$customer->getId()."/".$code."/".$fileName."'><li>".$fileName."</li></a>";
      }
                     $path=$directory."/";

                     

            $formmessage="Votre demande a bien été actualisée, un mail de notification a été envoyé à :<br>".$customer->getEmail();

            $emailmessage=$this->mailer->GetEmailNotarize($entity);
            $emailmessagforcompany=$this->mailer->GetEmailNotarizeForCompany($entity);

            $this->mailer->sendEmail($customer->getEmail(),1, $emailmessage);
            $this->mailer->sendEmail($website->getEmail(),2, $emailmessagforcompany);

            $sent = 1;



        }

            return $this->render($part.'/pages/notarize-missing.html.twig',[

                'part' => $part,
                'sent' => $sent,
                'formmessage' => $formmessage,
                'description'=>"Authentifer un document",             
                'title' => "Service en ligne - Authentifer un document",
                'menu'=>$menu,
                'notarizeTypes'=>$notarizetypes,
                'graphics' => $graphics,
                'customer' => $customer,
                "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                'socials' => $socialmedia,
                'notarize'=>$entity
    
            ]);

        
            
                }


                
            }
