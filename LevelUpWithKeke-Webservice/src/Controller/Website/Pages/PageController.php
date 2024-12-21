<?php

namespace App\Controller\Website\Pages;

use App\Entity\CMSarticle;
use App\Entity\CMSDocument;
use App\Entity\CMSgallery;
use App\Entity\CMSgraphics;
use App\Entity\CMSgraphicsType;
use App\Entity\CMSitemSettings;
use App\Entity\CMSjobOffer;
use App\Entity\CMSjobOfferCandidate;
use App\Entity\CMSmenu;
use App\Entity\CMSPage;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Entity\Gender;
use App\Entity\IdentityType;
use App\Entity\MaritalStatus;
use App\Entity\Nation;
use App\Entity\NationalType;
use App\Entity\Newsletter;
use App\Entity\Performance;
use App\Entity\TravelReason;
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
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser;


class PageController extends AbstractController
{

    private $security;
    private $submitform;
    private $mailer;
    private $entityManager;
    private $executer;

    public function __construct(Security $security, SubmitForm $submitform, Mailer $mailer, EntityManagerInterface $entityManager,Executer $executer ) {

        $this->security = $security;
        $this->submitform = $submitform;
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
        $this->executer = $executer;


    }


    #[Route('/page/{pagename}', name: 'cuid_page')]
    public function index(String $pagename,SessionInterface $session): Response
    {

        header("location:/cuid/dashboard/home");
        die;


        $part="website";

        $user = $session->get('user');

        $templateExists = $this->container->get('twig')->getLoader()->exists($part.'/pages/page-'.$pagename.'.html.twig');

        if ($templateExists) {

            $template = $part.'/pages/page-'.$pagename.'.html.twig';

        } else {
            // Handle if template doesn't exist
            // For example, render another template or return a response
            $template = $part.'/pages/page.html.twig';
        }


        if(isset($_POST["contact-us"])){

            $this->mailer->sendEmailContact($_POST["email"], $_POST["subject"] , $_POST["message"]);
            $formmessage="Votre email a bien été envoyé, nous répondrons dans les plus bref délais";
            
            return $this->render('popup.html.twig',['formmessage' => $formmessage]);
        }


        $socials = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();


     $page= $this->entityManager->getRepository(CMSPage::class)->findByName($pagename);

     $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();

     $sections= $this->entityManager->getRepository(CMSitemSettings::class)->findByPage ($page);

     $maritalStatus = $this->entityManager->getRepository(MaritalStatus::class)->findAll();

     $nations = $this->entityManager->getRepository(Nation::class)->findAll();

     $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);

     $genders = $this->entityManager->getRepository(Gender::class)->findAll();

     $visaTypes = $this->entityManager->getRepository(VisaType::class)->findAll();

     $nationalTypes = $this->entityManager->getRepository(NationalType::class)->findAll();

     $identityTypes = $this->entityManager->getRepository(IdentityType::class)->findAll();

     $travelReasons = $this->entityManager->getRepository(TravelReason::class)->findAll();

     $articles= $this->entityManager->getRepository(CMSarticle::class)->findAll();

     $website= $this->entityManager->getRepository(CMSWebsite::class)->find(1);

     $news = 0;

     $formmessage= "";

     
     if(isset($_POST["newsletter"])){


        $newsletter = new Newsletter();
        $today = new DateTimeImmutable();

        $alreadysubscribe = $this->entityManager->getRepository(Newsletter::class)->findByEmail($_POST["email"]);
        $linkedcustomer = $this->entityManager->getRepository(Customer::class)->findByEmail($_POST["email"]);



        if($alreadysubscribe==NULL){

            $newsletter->setEmail($_POST["email"]);
            $newsletter->setSubscribeDate($today);

            if($linkedcustomer != NULL){

            $newsletter->setCustomer($linkedcustomer);

            }

            $this->entityManager->persist($newsletter);
            $this->entityManager->flush();
            $formmessage="Votre email ".$_POST["email"]." a été inscrit à notre newsletter";
            $news = 1;

        }else{


            if($linkedcustomer != NULL){

                $alreadysubscribe->setCustomer($linkedcustomer);
                $this->entityManager->persist($alreadysubscribe);
                $this->entityManager->flush();

                }


            $formmessage="Cette email ".$_POST["email"]." est déjà inscrit à notre newsletter";
            $news = 1;

        }
    }



            return $this->render($template,[

                'part' => $part,
                'articles' => $articles,
                'sections'=>$sections,
                'page' => $page,
                'newsletter'=> $news,
                'menuselect' => $pagename,
                "formmessage" =>$formmessage,
                "user"=>$user,
                'graphics'=>$graphics,
                'travelReasons' => $travelReasons,
                'nationalTypes' => $nationalTypes,
                'identityTypes' => $identityTypes,
                'socials' => $socials,
                'genders' => $genders,
                'visaTypes' => $visaTypes,
                'maritalStatus'=>$maritalStatus,
                'nations'=>$nations,
                'website'=>$website,
                'menu' => $menu,                
                'title' => $page->getTitle(),
                'description' => $page->getDescription()
    
            ]);



    }



    #[Route('/galeries', name: 'cuid_galleries')]
    public function galleries(SessionInterface $session): Response
    {

        $part="website";

        $user = $session->get('user');

        $socials = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();


     $menu = $this->entityManager->getRepository(CMSmenu::class)->findAll();


     $maritalStatus = $this->entityManager->getRepository(MaritalStatus::class)->findAll();

     $nations = $this->entityManager->getRepository(Nation::class)->findAll();

     $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);

     $genders = $this->entityManager->getRepository(Gender::class)->findAll();

     $visaTypes = $this->entityManager->getRepository(VisaType::class)->findAll();

     $nationalTypes = $this->entityManager->getRepository(NationalType::class)->findAll();

     $identityTypes = $this->entityManager->getRepository(IdentityType::class)->findAll();

     $travelReasons = $this->entityManager->getRepository(TravelReason::class)->findAll();

     $articles = $this->entityManager->getRepository(CMSarticle::class)->findAll();

     $galleries = $this->entityManager->getRepository(CMSgallery::class)->findAll();

     $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);

     $news = 0;

     $formmessage= "";

     
     if(isset($_POST["newsletter"])){


        $newsletter = new Newsletter();
        $today = new DateTimeImmutable();

        $alreadysubscribe = $this->entityManager->getRepository(Newsletter::class)->findByEmail($_POST["email"]);
        $linkedcustomer = $this->entityManager->getRepository(Customer::class)->findByEmail($_POST["email"]);



        if($alreadysubscribe==NULL){

            $newsletter->setEmail($_POST["email"]);
            $newsletter->setSubscribeDate($today);

            if($linkedcustomer != NULL){

            $newsletter->setCustomer($linkedcustomer);

            }

            $this->entityManager->persist($newsletter);
            $this->entityManager->flush();
            $formmessage="Votre email ".$_POST["email"]." a été inscrit à notre newsletter";
            $news = 1;

        }else{


            if($linkedcustomer != NULL){

                $alreadysubscribe->setCustomer($linkedcustomer);
                $this->entityManager->persist($alreadysubscribe);
                $this->entityManager->flush();

                }


            $formmessage="Cette email ".$_POST["email"]." est déjà inscrit à notre newsletter";
            $news = 1;

        }
    }


            return $this->render($part."/pages/galleries.html.twig",[

                'part' => $part,
                'articles' => $articles,
                "user"=>$user,
                'graphics'=>$graphics,
                'menuselect' => NULL,
                'newsletter'=> $news,
                "formmessage" =>$formmessage,
                'travelReasons' => $travelReasons,
                'nationalTypes' => $nationalTypes,
                'identityTypes' => $identityTypes,
                'socials' => $socials,
                'genders' => $genders,
                'galleries' => $galleries,
                'visaTypes' => $visaTypes,
                'maritalStatus'=>$maritalStatus,
                'nations'=>$nations,
                'website'=>$website,
                'menu' => $menu,                
                'title' => "Galerie d'images",
                'description' => "Galerie du site web"
    
            ]);


    }


    #[Route('/galerie/{gallerytag}', name: 'cuid_gallery')]
    public function gallery($gallerytag,SessionInterface $session): Response
    {

        $part="website";

        $user = $session->get('user');

        $socials = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();


     $menu = $this->entityManager->getRepository(CMSmenu::class)->findAll();

     $maritalStatus = $this->entityManager->getRepository(MaritalStatus::class)->findAll();

     $nations = $this->entityManager->getRepository(Nation::class)->findAll();

     $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);

     $genders = $this->entityManager->getRepository(Gender::class)->findAll();

     $visaTypes = $this->entityManager->getRepository(VisaType::class)->findAll();

     $nationalTypes = $this->entityManager->getRepository(NationalType::class)->findAll();

     $identityTypes = $this->entityManager->getRepository(IdentityType::class)->findAll();

     $travelReasons = $this->entityManager->getRepository(TravelReason::class)->findAll();

     $articles = $this->entityManager->getRepository(CMSarticle::class)->findAll();

     $gallery = $this->entityManager->getRepository(CMSgallery::class)->findByTag($gallerytag);

     $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);

     $news = 0;

     $formmessage= "";

     
     if(isset($_POST["newsletter"])){


        $newsletter = new Newsletter();
        $today = new DateTimeImmutable();

        $alreadysubscribe = $this->entityManager->getRepository(Newsletter::class)->findByEmail($_POST["email"]);
        $linkedcustomer = $this->entityManager->getRepository(Customer::class)->findByEmail($_POST["email"]);



        if($alreadysubscribe==NULL){

            $newsletter->setEmail($_POST["email"]);
            $newsletter->setSubscribeDate($today);

            if($linkedcustomer != NULL){

            $newsletter->setCustomer($linkedcustomer);

            }

            $this->entityManager->persist($newsletter);
            $this->entityManager->flush();
            $formmessage="Votre email ".$_POST["email"]." a été inscrit à notre newsletter";
            $news = 1;

        }else{


            if($linkedcustomer != NULL){

                $alreadysubscribe->setCustomer($linkedcustomer);
                $this->entityManager->persist($alreadysubscribe);
                $this->entityManager->flush();

                }


            $formmessage="Cette email ".$_POST["email"]." est déjà inscrit à notre newsletter";
            $news = 1;

        }
    }


            return $this->render($part."/pages/gallery.html.twig",[

                'part' => $part,
                'articles' => $articles,
                "user"=>$user,
                "gallery"=>$gallery,
                'graphics'=>$graphics,
                'menuselect' => NULL,
                'travelReasons' => $travelReasons,
                'nationalTypes' => $nationalTypes,
                'identityTypes' => $identityTypes,
                'newsletter'=> $news,
                "formmessage" =>$formmessage,
                'socials' => $socials,
                'genders' => $genders,
                'gallery' => $gallery,
                'visaTypes' => $visaTypes,
                'maritalStatus'=>$maritalStatus,
                'nations'=>$nations,
                'website'=>$website,
                'menu' => $menu,                
                'title' => "Galerie d'images",
                'description' => "Galerie du site web"
    
            ]);


    }


    #[Route('/offres-d-emploi', name: 'cuid_jobs')]
    public function joboffers(SessionInterface $session): Response
    {

        $part="website";

        $user = $session->get('user');

        $socials = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();


     $menu = $this->entityManager->getRepository(CMSmenu::class)->findAll();


     $maritalStatus = $this->entityManager->getRepository(MaritalStatus::class)->findAll();

     $nations = $this->entityManager->getRepository(Nation::class)->findAll();

     $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);

     $genders = $this->entityManager->getRepository(Gender::class)->findAll();

     $visaTypes = $this->entityManager->getRepository(VisaType::class)->findAll();

     $nationalTypes = $this->entityManager->getRepository(NationalType::class)->findAll();

     $identityTypes = $this->entityManager->getRepository(IdentityType::class)->findAll();

     $travelReasons = $this->entityManager->getRepository(TravelReason::class)->findAll();

     $articles = $this->entityManager->getRepository(CMSarticle::class)->findAll();

     $jobs = $this->entityManager->getRepository(CMSjobOffer::class)->findAll();

     $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);

     $news = 0;

     $formmessage= "";

     
     if(isset($_POST["newsletter"])){


        $newsletter = new Newsletter();
        $today = new DateTimeImmutable();

        $alreadysubscribe = $this->entityManager->getRepository(Newsletter::class)->findByEmail($_POST["email"]);
        $linkedcustomer = $this->entityManager->getRepository(Customer::class)->findByEmail($_POST["email"]);



        if($alreadysubscribe==NULL){

            $newsletter->setEmail($_POST["email"]);
            $newsletter->setSubscribeDate($today);

            if($linkedcustomer != NULL){

            $newsletter->setCustomer($linkedcustomer);

            }

            $this->entityManager->persist($newsletter);
            $this->entityManager->flush();
            $formmessage="Votre email ".$_POST["email"]." a été inscrit à notre newsletter";
            $news = 1;

        }else{


            if($linkedcustomer != NULL){

                $alreadysubscribe->setCustomer($linkedcustomer);
                $this->entityManager->persist($alreadysubscribe);
                $this->entityManager->flush();

                }


            $formmessage="Cette email ".$_POST["email"]." est déjà inscrit à notre newsletter";
            $news = 1;

        }
    }



            return $this->render($part."/pages/jobs.html.twig",[

                'part' => $part,
                'articles' => $articles,
                "user"=>$user,
                'graphics'=>$graphics,
                "formmessage" => $formmessage,
                "newsletter" => $news,
                'menuselect' => NULL,
                'travelReasons' => $travelReasons,
                'nationalTypes' => $nationalTypes,
                'identityTypes' => $identityTypes,
                'socials' => $socials,
                'genders' => $genders,
                'jobs' => $jobs,
                'visaTypes' => $visaTypes,
                'maritalStatus'=>$maritalStatus,
                'nations'=>$nations,
                'website'=>$website,
                'menu' => $menu,                
                'title' => "Galerie d'images",
                'description' => "Galerie du site web"
    
            ]);


    }


    #[Route('/emploi/{jobtag}', name: 'cuid_job')]
    public function job($jobtag,SessionInterface $session,Request $request): Response
    {

        $part="website";

        $user = $session->get('user');

        $socials = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();


     $menu = $this->entityManager->getRepository(CMSmenu::class)->findAll();

     $maritalStatus = $this->entityManager->getRepository(MaritalStatus::class)->findAll();

     $nations = $this->entityManager->getRepository(Nation::class)->findAll();

     $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);

     $genders = $this->entityManager->getRepository(Gender::class)->findAll();

     $visaTypes = $this->entityManager->getRepository(VisaType::class)->findAll();

     $nationalTypes = $this->entityManager->getRepository(NationalType::class)->findAll();

     $identityTypes = $this->entityManager->getRepository(IdentityType::class)->findAll();

     $travelReasons = $this->entityManager->getRepository(TravelReason::class)->findAll();

     $articles = $this->entityManager->getRepository(CMSarticle::class)->findAll();

     $job = $this->entityManager->getRepository(CMSjobOffer::class)->findByTag($jobtag);

     $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);

     $today = new DateTimeImmutable();

     $formmessage = NULL;

     $sent = 0;



     if(isset($_POST["job"])){

        $candidate = new CMSjobOfferCandidate;
        $document = new CMSDocument;

        $document->setDateUploaded($today);

        $this->entityManager->persist($document);
        $this->entityManager->flush();

        $candidate->setFirstname($_POST["firstname"]);
        $candidate->setSurname($_POST["surname"]);
        $candidate->setEmail($_POST["email"]);
        $candidate->setTelephone($_POST["telephone"]);
        $candidate->setMotivation($_POST["motivation"]);


        $uploadedFile = $request->files->get('cv');

        // Your file handling logic here
        // For example, move the file to a specific directory
                                    $destination = $this->getParameter('kernel.project_dir').'/public/cuid/document/cv/'.$document->getId()."/";
                                    $filename = $uploadedFile->getClientOriginalName();

                                    $link = $website->getLink()."cuid/document/cv/".$document->getId()."/".$filename;

                                    $document->setName($filename);
                                    $document->setLink($link);

                                    $this->entityManager->persist($document);
                                    $this->entityManager->flush();

                                    $candidate->setCV($document);
                                    $candidate->addJobOffer($job);

                                    $this->entityManager->persist($candidate);
                                    $this->entityManager->flush();

                                    $uploadedFile->move($destination, $filename);

                                    $formmessage="Votre candidature a bien été envoyé , vous recevrez un mail de confirmation à <br>".$_POST["email"];
                                    $sent = 1;
     }

     
     $news = 0;

     $formmessage= "";

     
     if(isset($_POST["newsletter"])){


        $newsletter = new Newsletter();
        $today = new DateTimeImmutable();

        $alreadysubscribe = $this->entityManager->getRepository(Newsletter::class)->findByEmail($_POST["email"]);
        $linkedcustomer = $this->entityManager->getRepository(Customer::class)->findByEmail($_POST["email"]);



        if($alreadysubscribe==NULL){

            $newsletter->setEmail($_POST["email"]);
            $newsletter->setSubscribeDate($today);

            if($linkedcustomer != NULL){

            $newsletter->setCustomer($linkedcustomer);

            }

            $this->entityManager->persist($newsletter);
            $this->entityManager->flush();
            $formmessage="Votre email ".$_POST["email"]." a été inscrit à notre newsletter";
            $news = 1;

        }else{


            if($linkedcustomer != NULL){

                $alreadysubscribe->setCustomer($linkedcustomer);
                $this->entityManager->persist($alreadysubscribe);
                $this->entityManager->flush();

                }


            $formmessage="Cette email ".$_POST["email"]." est déjà inscrit à notre newsletter";
            $news = 1;

        }
    }


            return $this->render($part."/pages/job.html.twig",[

                'part' => $part,
                'articles' => $articles,
                "formmessage" => $formmessage,
                "newsletter" => $news,
                "user"=>$user,
                "job"=>$job,
                'sent' => $sent,
                'graphics'=>$graphics,
                'menuselect' => NULL,
                'travelReasons' => $travelReasons,
                'nationalTypes' => $nationalTypes,
                'identityTypes' => $identityTypes,
                'socials' => $socials,
                'genders' => $genders,
                'visaTypes' => $visaTypes,
                'maritalStatus'=>$maritalStatus,
                'nations'=>$nations,
                'website'=>$website,
                'menu' => $menu,                
                'title' => "Galerie d'images",
                'description' => "Galerie du site web"
    
            ]);


    }

}
