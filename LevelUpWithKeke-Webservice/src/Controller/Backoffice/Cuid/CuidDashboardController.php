<?php

namespace App\Controller\Backoffice\Cuid;

use App\Entity\Booking;
use App\Entity\CMSarticle;
use App\Entity\CMSgallery;
use App\Entity\CMSgraphics;
use App\Entity\CMSitemSettings;
use App\Entity\CMSjobOffer;
use App\Entity\CMSmail;
use App\Entity\CMSMedia;
use App\Entity\CMSmenu;
use App\Entity\CMSPage;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSUser;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Entity\Decision;
use App\Entity\Event;
use App\Entity\Faq;
use App\Entity\Form;
use App\Entity\FormItemListSettings;
use App\Entity\Notarize;
use App\Entity\NotarizeType;
use App\Entity\Performance;
use App\Entity\VisaType;
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
use App\Service\Finder\Finder;
use App\Service\Form\Connection;
use App\Controller\API\CMS\CMSGetEntityListController;
use App\Controller\API\CMS\CMSGetEntityController;
use DateTimeImmutable;


            class CuidDashboardController extends AbstractController {


                private $security;
                private $submitform;
                private $mailer;
                private $entityManager;
                private $executer;
                private $finder;
                private $getListData;
            
                public function __construct(Security $security, SubmitForm $submitform, Mailer $mailer , EntityManagerInterface $entityManager,Executer $executer, Finder $finder, CMSGetEntityListController $getListData  ) {
            
                    $this->security = $security;
                    $this->submitform = $submitform;
                    $this->mailer = $mailer;
                    $this->entityManager = $entityManager;
                    $this->executer = $executer;
                    $this->finder = $finder;
                    $this->getListData = $getListData;
            
                }


                #[Route('/cuid/dashboard/{section}', name: 'cuid_admin_user_dashboard')]
                public function index($section,SessionInterface $session): Response
                {


                /*  Start All Pages with this CODE */   $this->security->SecurityCheckCMS($session); 

                $today = new DateTimeImmutable();


                 $this->executer->UpgradeStatistic($today);

                if($section == NULL || $section == "" ){

                    $section="home";
                }



             /*   

                if(isset($_POST["bookingId"])){

                    $booking = $this->entityManager->getRepository(Booking::class)->find($_POST["bookingId"]);

                    


                    if($_POST["hour"]!=NULL){

                        $metric=$_POST["hour"];
                        $booking->setHour($metric);
                        
                    }else{

                        $metric=$_POST["surface"];
                        $booking->setSurface($metric);

                    }
                    
                    $booking->setHourlyRate($_POST["hourlyRate"]);

                    $cost = $metric * $_POST["hourlyRate"];
                    $booking->setCost($cost);
                    $booking->setCompanyConfirmation(TRUE);
                    $this->entityManager->persist($booking);
                    $this->entityManager->flush();
                 }
                
                 */
            
                 $part="admin";
                 $user=$session->get("user");
                 $website = $this->entityManager->getRepository(CMSWebsite::class)->find("1");
                 $userid=$user->getId();
                 $entity = NULL;



                 $getterMethod = 'get'.ucfirst($section).'Data';

                 $sectionmod = str_replace("add","",$section);


                 $setterMethod = 'set'.ucfirst($sectionmod).'Data';

                    $data=$this->finder->$getterMethod($user,$website,$part);

                    if(isset($_POST[$section."_data"])){

                        if(count($_FILES)!=0){


                            $directory=$this->getParameter($section.'_directory');

                            $idresult = $this->submitform->$setterMethod($_POST,$directory);



                        }else{

                            $idresult = $this->submitform->$setterMethod($_POST,$entity);


                        }

                        if (str_contains($section, "add")) {
                            

                            return $this->redirectToRoute('cuid_admin_user_dashboard_edit',['section' => $sectionmod , 'id' => $idresult] );

                        }else{


                            return $this->redirectToRoute('cuid_admin_user_dashboard',['section' => $section]);


                        }



   
                    }




                    return $this->render('backoffice/cuid/admin/'.$section.'.html.twig',$data);
                }

                #[Route('/cuid/dashboard/edit-{section}/{id}', name: 'cuid_admin_user_dashboard_edit')]
                public function edit($section,$id,SessionInterface $session): Response
                {

                /*  Start All Pages with this CODE */   $this->security->SecurityCheckCMS($session); 

                $user=$session->get("user");

                $part="admin";
                $user=$session->get("user");
                $website = $this->entityManager->getRepository(CMSWebsite::class)->find("1");
                $userid=$user->getId();


                if($section == "page"){

                    $entity = $this->entityManager->getRepository(CMSPage::class)->find($id);

                }

                if($section == "event"){

                    $entity = $this->entityManager->getRepository(Event::class)->find($id);

                }

                if($section == "faq"){

                    $entity = $this->entityManager->getRepository(Faq::class)->find($id);

                }

                if($section == "user"){


                    $entity = $this->entityManager->getRepository(CMSUser::class)->find($id);


                }

                if($section == "article"){

                    $entity = $this->entityManager->getRepository(CMSarticle::class)->find($id);
     
                }

                elseif($section == "form"){

                    $entity = $this->entityManager->getRepository(Form::class)->find($id);

                }

                elseif($section == "notarizetype"){

                    $entity = $this->entityManager->getRepository(NotarizeType ::class)->find($id);

                }

                elseif($section == "social"){

                    $entity = $this->entityManager->getRepository(CMSsocialmedia ::class)->find($id);

                }

                elseif($section == "graphic"){

                    $entity = $this->entityManager->getRepository(CMSgraphics ::class)->find($id);

                }

                                
                elseif($section == "mail"){

                    $entity = $this->entityManager->getRepository(CMSmail ::class)->find($id);

                }


                elseif($section == "performance"){

                    $entity = $this->entityManager->getRepository(Performance::class)->find($id);

                }
                
                
                elseif($section == "service"){

                    $entity = $this->entityManager->getRepository(Notarize::class)->find($id);

                }

                elseif($section == "visa"){

                    $entity = $this->entityManager->getRepository(VisaType::class)->find($id);

                }


                elseif($section == "socialmedia"){

                    $entity = $this->entityManager->getRepository(CMSsocialmedia::class)->find($id);

                }

                elseif($section == "list"){

                    $entity = $this->entityManager->getRepository(FormItemListSettings::class)->find($id);

                }

                elseif($section == "gallery"){

                    $entity = $this->entityManager->getRepository(CMSgallery::class)->find($id);

                }

                elseif($section == "job"){

                    $entity = $this->entityManager->getRepository(CMSjobOffer::class)->find($id);

                }

                
                $getterMethod = 'get'.ucfirst($section).'Data';

                $sectionmod = str_replace("addpage","page",$section);
                $sectionmod = str_replace("addlist","list",$section);
                $sectionmod = str_replace("addform","form",$section);

                $setterMethod = 'set'.ucfirst($sectionmod).'Data';



                   $data=$this->finder->$getterMethod($user,$website,$part,$entity);


                   if(isset($_POST[$section."_data"]) || isset($_POST["formItemSettings_data"]) ){



                    if(isset($_POST["formItemSettings_data"])){

                        $targetsection="form";

                    }else{

                        $targetsection=$section;
                    }


                    if(count($_FILES)!=0){


                        $directory=$this->getParameter($section.'_directory');

                        $result = $this->submitform->$setterMethod($_POST,$directory);
                        $data [] = ["submitresult" => $result] ;

                    }else{



                        $result = $this->submitform->$setterMethod($_POST,$entity);

                        $data [] = ["submitresult" => $result] ;

                    }

                    
                }


                

                return $this->render('backoffice/cuid/admin/edit-'.$section.'.html.twig',$data);

            }


            
            #[Route('/cuid/dashboard/job-candidates/{id}', name: 'cuid_admin_user_dashboard_job_candidates')]
            public function candidates($id,SessionInterface $session): Response
            {

            /*  Start All Pages with this CODE */   $this->security->SecurityCheckCMS($session); 

            $user=$session->get("user");

            $part="admin";
            $user=$session->get("user");
            $website = $this->entityManager->getRepository(CMSWebsite::class)->find("1");
            $userid=$user->getId();

            $entity = $this->entityManager->getRepository(CMSjobOffer::class)->find($id);

               $data=$this->finder->getCandidatesData($user,$website,$part,$entity);


            return $this->render('backoffice/cuid/admin/candidates.html.twig',$data);

        }

            
        #[Route('/cuid/dashboard/customer/{id}', name: 'cuid_admin_user_dashboard_customer')]
        public function customer($id,SessionInterface $session): Response
        {

        /*  Start All Pages with this CODE */   $this->security->SecurityCheckCMS($session); 

        $user=$session->get("user");

        $part="admin";
        $user=$session->get("user");
        $website = $this->entityManager->getRepository(CMSWebsite::class)->find("1");
        $userid=$user->getId();

        $entity = $this->entityManager->getRepository(Customer::class)->find($id);

           $data=$this->finder->getCustomerData($user,$website,$part,$entity);


        return $this->render('backoffice/cuid/admin/customer.html.twig',$data);

    }



                #[Route('/cuid/tutorial', name: 'cuid_admin_user_tutorial')]
                public function tutorial(SessionInterface $session): Response
                {

                /*  Start All Pages with this CODE */   $this->security->SecurityCheckCMS($session); 

                $user=$session->get("user");

                    return $this->render('backoffice/cuid/tutorial.html.twig',['user'=>$user]);
                }

                

                #[Route('/cuid/confirm/{action}/{section}/{id}', name: 'cuid_confirm_action')]
                public function confirm($action,$section,$id,SessionInterface $session): Response

                {

                                   /*  Start All Pages with this CODE */   $this->security->SecurityCheckCMS($session); 

                    $actionanme="";

                    if($action=="delete"){

                        $actionanme="supprimer";
                    }

                    if($action=="copy"){

                        $actionanme="copier";
                    }

                    if($action=="hide"){

                        $actionanme="masquer";
                    }

                    if($action=="read"){

                        $actionanme="Lire";
                    }

                    if($action=="choose"){

                        $actionanme="Choisir";


                    }

                    if($action=="cancel"){

                        $actionanme="Annuler";

                        
                    }

                    if($section == "page"){


                        $entity = $this->entityManager->getRepository(CMSPage::class)->find($id);
                        $confirmmessage = "Voulez-vous, $actionanme la page suivante : ".$entity->getTitle();
    
    
                    }


                    if($section == "user"){


                        $entity = $this->entityManager->getRepository(CMSUser::class)->find($id);
                        $confirmmessage = "Voulez-vous, $actionanme l'utilisateur suivante : ".$entity->getLogin();
    
    
                    }
    
                    if($section == "media"){
    
    
                        $entity = $this->entityManager->getRepository(CMSMedia::class)->find($id);
                        $confirmmessage = "Voulez-vous, $actionanme le média suivant : ".$entity->getName();
    
                    }
    
                    if($section == "article"){
    
                        $entity = $this->entityManager->getRepository(CMSarticle::class)->find($id);
                        $confirmmessage = "Voulez-vous, $actionanme l'artcile suivant : ".$entity->getTitle();
                    }
    
    
                    elseif($section == "form"){
    
                        $entity = $this->entityManager->getRepository(Form::class)->find($id);
                        $confirmmessage = "Voulez-vous, $actionanme le formulaire suivant : ".$entity->getTitle();
                    }
    
    
                    elseif($section == "notarizetype"){
    
                        $entity = $this->entityManager->getRepository(NotarizeType ::class)->find($id);
                        $confirmmessage = "Voulez-vous, $actionanme le service suivant : ".$entity->getFRName();
                    }
    
    
                    elseif($section == "socialmedia"){
    
                        $entity = $this->entityManager->getRepository(CMSsocialmedia ::class)->find($id);
                        $confirmmessage = "Voulez-vous, $actionanme le réseau social suivant : ".$entity->getSocialMediaType()->getName();
                    }
    
                    
    
                    elseif($section == "service"){
    
                        $entity = $this->entityManager->getRepository(Notarize::class)->find($id);
                        $confirmmessage = "Voulez-vous, $actionanme la demande de client code : ".$entity->getNumberId();
    
                    }

                    elseif($section == "event"){
    
                        $entity = $this->entityManager->getRepository(Event::class)->find($id);
                        $confirmmessage = "Voulez-vous, $actionanme l'évènement suivant : ".$entity->getTitle();
    
                    }

                    elseif($section == "performance"){
    
                        $entity = $this->entityManager->getRepository(Performance::class)->find($id);
                        $confirmmessage = "Voulez-vous, $actionanme la prestation suivante : ".$entity->getName();
    
                    }

                    elseif($section == "visa"){
    
                        $entity = $this->entityManager->getRepository(VisaType::class)->find($id);
                        $confirmmessage = "Voulez-vous, $actionanme le type de visa suivant : ".$entity->getFRName();
    
                    }


                    elseif($section == "booking"){
    
                        $entity = $this->entityManager->getRepository(Booking::class)->find($id);

                        if($action=="choose"){
                        $confirmmessage = "Confirmez-vous , votre présence pour le rendez-vous suivant : ".$entity->getCode();
                        }else{
                        
                            $confirmmessage = "Voulez-vous, $actionanme le rendez-vous : ".$entity->getCode();

                        }
    
                    }
    


                    return $this->render('backoffice/cuid/confirm.html.twig',["confirmmessage"=>$confirmmessage,"action"=>$action,"section"=>$section,"id"=>$id,"data"=>$entity]);

                }


                #[Route('/cuid/set/{action}/{section}/{id}', name: 'cuid_set_action')]
                public function delete($section,$id,$action,SessionInterface $session)

                {


                    $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);                                             

                    
                if($section == "page"){


                    $entity = $this->entityManager->getRepository(CMSPage::class)->find($id);


                }

                if($section == "media"){


                    $entity = $this->entityManager->getRepository(CMSMedia::class)->find($id);


                }

                if($section == "article"){

                    $entity = $this->entityManager->getRepository(CMSarticle::class)->find($id);
     
                }


                elseif($section == "form"){

                    $entity = $this->entityManager->getRepository(Form::class)->find($id);

                }


                elseif($section == "notarizetype"){

                    $entity = $this->entityManager->getRepository(NotarizeType ::class)->find($id);

                }


                elseif($section == "socialmedia"){

                    $entity = $this->entityManager->getRepository(CMSsocialmedia ::class)->find($id);

                }


                
                elseif($section == "graphic"){

                    $entity = $this->entityManager->getRepository(CMSgraphics ::class)->find($id);

                }

                                
                elseif($section == "mail"){

                    $entity = $this->entityManager->getRepository(CMSmail ::class)->find($id);

                }
                

                elseif($section == "booking"){

                    $entity = $this->entityManager->getRepository(Booking ::class)->find($id);

                }


                elseif($section == "user"){

                    $entity = $this->entityManager->getRepository(CMSUser ::class)->find($id);

                }

                elseif($section == "event"){

                    $entity = $this->entityManager->getRepository(Event ::class)->find($id);

                }

                elseif($section == "performance"){

                    $entity = $this->entityManager->getRepository(Performance ::class)->find($id);

                }


                elseif($section == "visa"){

                    $entity = $this->entityManager->getRepository(VisaType ::class)->find($id);

                }
                
                

                elseif($section == "service"){

                    $entity = $this->entityManager->getRepository(Notarize::class)->find($id);

                }

                if($action == "delete"){

                    $message="Suppression confirmée !</br>";

                if($entity != NULL){

                    
                    if($section == "media"){

                        $filename = $entity->getName();
                        $file = $entity->getLink();

                    if (file_exists($file)) {
                        if (unlink($file)) {
                            $message = "Le fichier $filename a bien été suprrimer";
                        }
                    }


                    

                }

                    $this->entityManager->remove($entity);
                    $this->entityManager->flush();


                }
            }

            
            if($action == "choose"){

                $decision = $this->entityManager->getRepository(Decision::class)->find(3);

                $entity->setDecision($decision);


                $this->entityManager->persist($entity);
                $this->entityManager->flush();

                $emailmessage=$this->mailer->GetEmailBooking($entity);
                
                $this->mailer->sendEmail($entity->getCustomer()->getEmail(), 12 , $emailmessage);

                $message="Votre décision a été confirmée !</br>";

            }


            if($action == "cancel"){

                $decision = $this->entityManager->getRepository(Decision::class)->find(1);

                $entity->setDecision($decision);
                $entity->setCancelled(TRUE);
                $message="Annulation confirmée !</br>";

                $this->entityManager->persist($entity);
                $this->entityManager->flush();

                $emailmessage=$this->mailer->GetEmailBooking($entity);
                
    
                $this->mailer->sendEmail($entity->getCustomer()->getEmail(), 9 , $emailmessage);

            }


            if($action == "report"){

                $decision = $this->entityManager->getRepository(Decision::class)->find(4);

                $entity->setDecision($decision);

                if($section == "booking"){


                    $newformat = new DateTimeImmutable($_POST["date"]);

                    $entity->setBookingDate($newformat);
                }

                $this->entityManager->persist($entity);
                $this->entityManager->flush();

                $emailmessage=$this->mailer->GetEmailBooking($entity);
                
    
                $this->mailer->sendEmail($entity->getCustomer()->getEmail(), 12 , $emailmessage);

                $message="Report confirmée !</br>";

            }
            
            $this->getListData->apiGetDataList($section."-exe");

            return $this->render('backoffice/cuid/done.html.twig',["message"=>$message]);



                }

                
            }
