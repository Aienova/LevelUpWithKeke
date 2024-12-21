<?php

namespace App\Controller\CustomerArea\Pages;

use App\Entity\Booking;
use App\Entity\CMSgraphics;
use App\Entity\CMSmenu;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Entity\Decision;
use App\Entity\Faq;
use App\Entity\Form;
use App\Entity\FormStep;
use App\Entity\Gender;
use App\Entity\IdentityType;
use App\Entity\MaritalStatus;
use App\Entity\Nation;
use App\Entity\NationalType;
use App\Entity\Notarize;
use App\Entity\TravelReason;
use App\Entity\VisaType;
use App\Service\Form\SubmitForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;
use App\Service\Mailer\Mailer;

            class CustomerAreaHomeController extends AbstractController {
                private $security;
                private $entityManager;
                private $mailer;
                private $submitform;
            
                public function __construct(Security $security,EntityManagerInterface $entityManager, Mailer $mailer, SubmitForm $submitform  ) {
            
                    $this->security = $security;
                    $this->entityManager = $entityManager;
                    $this->mailer = $mailer;
                    $this->submitform = $submitform;
            
                }
            
                #[Route('/service-en-ligne', name: 'cuid_customer_area_home')]
                public function index(Request $request,SessionInterface $session): Response
                {
                   /*  Start All Pages with this CODE */   $this->security->SecurityCheck($session); 
            
                 $part="customer-area";
                 $user=$session->get("user");
                 if($user == NULL){

                    $userid = 1;
        
                }else{
        
                    $userid = $user->getId();
                }
                 $today = new DateTimeImmutable();

                 $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();

                 $customer = $this->entityManager->getRepository(Customer::class)->find($userid);




                 $currentNotarizes = $this->entityManager->getRepository(Notarize::class)->findByDecisionAndCustomer($customer,$this->entityManager->getRepository(Decision::class)->find(2));
                 $mustPayNotarizes = $this->entityManager->getRepository(Notarize::class)->findByCustomerValidButNotPaid($customer);
                 $booking = $this->entityManager->getRepository(Booking::class)->findByCustomerClosestDate($customer,$today);
                 $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
                 $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();                 
                 if(isset($_POST["answer"])){

                    $entity = $this->entityManager->getRepository(Booking::class)->find($_POST["booking-id"]);
        
                    if($_POST["answer"]==1 && $_POST["decision"]==1){
        
        
                        $entity->setConfirmation(TRUE);
                        $this->entityManager->persist($entity);
                        $this->entityManager->flush();
        
                        $emailmessage=str_replace("%LINK%",""."https://".$_SERVER['SERVER_NAME']."/confirmation  ",$this->mailer->GetEmailConfirmation());
        
                        $this->mailer->sendEmail($customer->getEmail(), "ProClean Reinigung : Ihre Reservierung wurde bestätigt", $emailmessage);
        
                    }
                    
                    if($_POST["answer"]==1 && $_POST["decision"]==0){
        
                        $entity->setConfirmation(FALSE);
                        $entity->setCancelled(TRUE);
                        $this->entityManager->persist($entity);
                        $this->entityManager->flush();
        
                        $emailmessage=str_replace("%LINK%",""."https://".$_SERVER['SERVER_NAME']."/confirmation  ",$this->mailer->GetEmailConfirmation());
        
                        $this->mailer->sendEmail($customer->getEmail(), "ProClean Reinigung : Ihre Reservierung wurde bestätigt", $emailmessage);
        
                    }
        
        
                }

                if(isset($_POST["stars"])){


                    $aiecoins=$customer->getAiecoins()+(10*$_POST["stars"]);

                    $customer->setOpinionRate($_POST["stars"]);
                    $customer->setAiecoins($aiecoins);
                    $customer->setOpinionComment($_POST["comment"]);

                    $this->entityManager->persist($customer);
                    $this->entityManager->flush();
                    return $this->redirectToRoute('cuid_customer_area_home');

                }

                 $user=$session->set("user",$customer);
            
                    return $this->render($part.'/pages/homepage.html.twig',[
            
                        'part' => $part,
                        'customer' => $customer,
                        "website"=> $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                        'booking' => $booking,
                        'graphics' => $graphics,
                        'socials' => $socialmedia,
                        'currentNotarizes' => $currentNotarizes,
                        'mustPayNotarizes' => $mustPayNotarizes,
                        'title' => "Service en ligne",
                        'description' => "Service en ligne",
                        'menu'=> $menu,
            
                    ]);
            
                }


                           
                #[Route('/infos-service-en-ligne', name: 'cuid_customer_area_infos')]
                public function infos(Request $request,SessionInterface $session): Response
                {


                    $part = "customer-area";
                    $formmessage = "";
                    $user=$session->get("user");

                
                    $pagename="visa";
                    $sent = 0;
                    $documentlinks = "";
                    $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);
                    $form = $this->entityManager->getRepository(Form::class)->findByName($pagename);
                    $passports = NULL;

                    if($user==NULL){
                        $userid = 1;

                    }else{

                        $userid=$user->getId();

                    }

                    $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
                    $code = $this->submitform->randomizeCode($customer);
                    $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
                    $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();                 
                    if (isset($_POST["formType"])) {
            
            
            
            
                        if ($_POST["formType"] == 1) {
            
            
            
                            $visa = $this->submitform->createVisa($_POST,$customer);
            
                            $notarize = $this->submitform->createNotarizeForCustomerFormData($documentlinks,$customer,$code,$form);
            
                            $notarize->setVisa($visa);
                            $notarize->setPassport($visa->getPassport());
                            $notarize->setPerson($visa->getPerson());
            
                            $this->entityManager->persist($notarize);
                            $this->entityManager->flush();
            
                            
                        $formmessage="Votre demande de visa a bien été enregistré, un mail de confirmation a été envoyé à :<br>".$customer->getEmail();
            
                        $emailmessage=$this->mailer->GetEmailNotarize($notarize);
                        $emailmessagforcompany=$this->mailer->GetEmailNotarizeForCompany($notarize);
            
                        $this->mailer->sendEmail($customer->getEmail(),1, $emailmessage);
                        $this->mailer->sendEmail($website->getEmail(),2, $emailmessagforcompany);
                        $sent = 1;
            
                        }
            
            
                        if ($_POST["formType"] == 2) {
            
                            $person = $this->submitform->createPerson($_POST,$customer);
            
                            $notarize = $this->submitform->createNotarizeForCustomerFormData($documentlinks,$customer,$code,$form);
                            $notarize->setPerson($person);
            
                            $this->entityManager->persist($notarize);
                            $this->entityManager->flush();
            
                            
                        $emailmessage=$this->mailer->GetEmailNotarize($notarize);
                        $emailmessagforcompany=$this->mailer->GetEmailNotarizeForCompany($notarize);
            
                        $this->mailer->sendEmail($customer->getEmail(),1, $emailmessage);
                        $this->mailer->sendEmail($website->getEmail(),2, $emailmessagforcompany);
                        $sent = 1;
                        $formmessage="Votre demande d'enregistrement a bien été enregistré, un mail de confirmation a été envoyé à :<br>".$customer->getEmail();
                        
                    }
            
            
            
            
            
                        if ($_POST["formType"] == 0) {
            
            
            
                            $notarizeentity = $this->submitform->createNotarizeForCustomerFormData($documentlinks, $customer, $code, $form);
            
                            $directory = $this->getParameter('upload_directory');
            
            
                            $filename = array_keys($_FILES);
            
            
                            // Define your target directory
                            $targetDir = $directory . "/notarize/" . $customer->getId() . "/" . $code;
            
                            // Ensure that the target directory exists
                            if (!is_dir($targetDir)) {
                                mkdir($targetDir, 0777, true);
                            }
            
                            // Count total files
                            $totalFiles = count($filename);
            
            
                            // Loop through each file
                            for ($i = 0; $i < $totalFiles; $i++) {
            
            
                                $fileName = $_FILES[$filename[$i]]["name"];
            
                                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            
                                $fileName = "document_" . $form->getName() . "_" . $user->getFirstname() . "_" . $user->getSurname() . "_" . $i . "." . $extension;
            
                                $targetFilePath = $targetDir . "/" . $fileName;
            
                                // Get the current protocol
                                $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
            
                                // Get the main URL domain
                                $domain = $protocol . $_SERVER['HTTP_HOST'];
            
                                $link = $domain . "/cuid/document/notarize/" . $customer->getId() . "/" . $code . "/" . $fileName;
            
                                // Check if file is selected and then proceed to move it to the target directory
                                if (!empty($_FILES[$filename[$i]]['name'])) {
                                    // You can add more validations here (file size, file type, etc.)
                                    if (move_uploaded_file($_FILES[$filename[$i]]['tmp_name'], $targetFilePath)) {
            
                                        echo "The file " . $fileName . " has been uploaded.";
                                        $this->submitform->uploadDocument($link, $fileName, $customer, $notarizeentity);
                                    } else {
                                        echo "Sorry, there was an error uploading your file.";
                                    }
                                }
            
                                $documentlinks .= "<a href='" . $targetFilePath . "'><li>" . $fileName . "</li></a>";
                            }
            
                            $this->submitform->createFormData($_POST, $customer, $form, $notarizeentity);
            
                            $formmessage="Votre demande a bien été enregistré, un mail de confirmation a été envoyé à :<br>".$customer->getEmail();
                
                            $emailmessage=$this->mailer->GetEmailNotarize($notarizeentity);
                            $emailmessagforcompany=$this->mailer->GetEmailNotarizeForCompany($notarizeentity);
                
                            $this->mailer->sendEmail($customer->getEmail(),1, $emailmessage);
                            $this->mailer->sendEmail($website->getEmail(),2, $emailmessagforcompany);
                            $sent = 1;
                        }
            
            
            
            
                    }

                 $today = new DateTimeImmutable();

                 
                 $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();

                 $page = $this->entityManager->getRepository(Form::class)->findByName($pagename);


                 $steps = $this->entityManager->getRepository(FormStep::class)->findByForm($page->getId());
         
                 $menu = $this->entityManager->getRepository(CMSmenu::class)->findAll();

                 $faqs = $this->entityManager->getRepository(Faq::class)->findAll();
         
                 $maritalStatus = $this->entityManager->getRepository(MaritalStatus::class)->findAll();
         
                 $nations = $this->entityManager->getRepository(Nation::class)->findAll();
         
                 $genders = $this->entityManager->getRepository(Gender::class)->findAll();
         
                 $visaTypes = $this->entityManager->getRepository(VisaType::class)->findAll();
         
                 $nationalTypes = $this->entityManager->getRepository(NationalType::class)->findAll();
         
                 $identityTypes = $this->entityManager->getRepository(IdentityType::class)->findAll();
         
                 $travelReasons = $this->entityManager->getRepository(TravelReason::class)->findAll();

                 $previousRegisterNotarizeArray = $this->entityManager->getRepository(Notarize::class)->findByCustomerForRegister($customer);

                 if($previousRegisterNotarizeArray != NULL){
         
                     $previousRegisterNotarize = $previousRegisterNotarizeArray[0];
         
                 }else{
         
                     $previousRegisterNotarize = NULL;
                 }

            
                    return $this->render('costumer-area.html.twig',[
                        


                        'form' => $page,
                        'steps' => $steps,
                        'faqs' => $faqs,
                        'sent' => $sent,
                        "previousRegisterNotarize"=>$previousRegisterNotarize,
                        "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                        'graphics' => $graphics,
                        'formmessage' => $formmessage,
                        'travelReasons' => $travelReasons,
                        'nationalTypes' => $nationalTypes,
                        'identityTypes' => $identityTypes,
                        'passports' => $passports,
                        'genders' => $genders,
                        'visaTypes' => $visaTypes,
                        'maritalStatus' => $maritalStatus,
                        'nations' => $nations,
                        'menu' => $menu,
                        'customer' => $customer,
                        'socials' => $socialmedia,
                        'title' => "Service en ligne",
                        'description' => "Service en ligne",
                        'menu'=> $menu,
                        "user"=>$user,
                        'menuselect' => $pagename,
                        'part' => $part,
            
                    ]);
            
                }

                
            }
