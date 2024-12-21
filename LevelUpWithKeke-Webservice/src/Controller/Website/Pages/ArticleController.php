<?php

namespace App\Controller\Website\Pages;

use App\Entity\CMSitemSettings;
use App\Entity\CMSmenu;
use App\Entity\CMSarticle;
use App\Entity\CMSgraphics;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Entity\Event;
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


class ArticleController extends AbstractController
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


    #[Route('/article/{articlename}', name: 'cuid_article')]
    public function index(String $articlename,SessionInterface $session): Response
    {

        $part="website";

        $user = $session->get('user');

        $templateExists = $this->container->get('twig')->getLoader()->exists($part.'/pages/article-'.$articlename.'.html.twig');

        if ($templateExists) {

            $template = $part.'/pages/article-'.$articlename.'.html.twig';

        } else {
            // Handle if template doesn't exist
            // For example, render another template or return a response
            $template = $part.'/pages/article.html.twig';
        }






     $article= $this->entityManager->getRepository(CMSarticle::class)->findByName($articlename);

     $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();

  //   $sections= $this->entityManager->getRepository(CMSitemSettings::class)->findByarticle($article);

     $maritalStatus = $this->entityManager->getRepository(MaritalStatus::class)->findAll();

     $nations = $this->entityManager->getRepository(Nation::class)->findAll();

     $genders = $this->entityManager->getRepository(Gender::class)->findAll();

     $visaTypes = $this->entityManager->getRepository(VisaType::class)->findAll();

     $nationalTypes = $this->entityManager->getRepository(NationalType::class)->findAll();

     $identityTypes = $this->entityManager->getRepository(IdentityType::class)->findAll();

     $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);

     $travelReasons = $this->entityManager->getRepository(TravelReason::class)->findAll();

     $socials = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();
     
     $website= $this->entityManager->getRepository(CMSWebsite::class)->find(1);
     $news = 0;

     $formmessage = "";

     
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
              //  'sections'=>$sections,
                'article' => $article,
                "user" => $user,
                'socials' => $socials,
                'menuselect' => $articlename,
                'newsletter'=> $news,
                "formmessage" => $formmessage,
                'travelReasons' => $travelReasons,
                'nationalTypes' => $nationalTypes,
                'graphics' => $graphics,
                'identityTypes' => $identityTypes,
                'genders' => $genders,
                'visaTypes' => $visaTypes,
                'maritalStatus'=>$maritalStatus,
                'nations'=>$nations,
                'menu' => $menu,
                'website'=>$website,                
                'title' => $article->getTitle(),
                'description' => $article->getDescription()
    
            ]);

        

        }



        #[Route('/evenement/{articlename}', name: 'cuid_event')]
        public function event(String $articlename,SessionInterface $session): Response
        {
    
            $part="website";
    
            $user = $session->get('user');
    
            $templateExists = $this->container->get('twig')->getLoader()->exists($part.'/pages/event-'.$articlename.'.html.twig');
    
            if ($templateExists) {
    
                $template = $part.'/pages/event-'.$articlename.'.html.twig';
    
            } else {
                // Handle if template doesn't exist
                // For example, render another template or return a response
                $template = $part.'/pages/event.html.twig';
            }
    
    
    
    
    
    
         $article= $this->entityManager->getRepository(Event::class)->findByTag($articlename);
    
         $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();
    
      //   $sections= $this->entityManager->getRepository(CMSitemSettings::class)->findByarticle($article);
    
         $maritalStatus = $this->entityManager->getRepository(MaritalStatus::class)->findAll();
    
         $nations = $this->entityManager->getRepository(Nation::class)->findAll();
    
         $genders = $this->entityManager->getRepository(Gender::class)->findAll();
    
         $visaTypes = $this->entityManager->getRepository(VisaType::class)->findAll();
    
         $nationalTypes = $this->entityManager->getRepository(NationalType::class)->findAll();
    
         $identityTypes = $this->entityManager->getRepository(IdentityType::class)->findAll();
    
         $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
    
         $travelReasons = $this->entityManager->getRepository(TravelReason::class)->findAll();
    
         $socials = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();
         
         $website= $this->entityManager->getRepository(CMSWebsite::class)->find(1);

         $formmessage = "";

         
     $news = 0;

     
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
                  //  'sections'=>$sections,
                    'article' => $article,
                    "user" => $user,
                    'socials' => $socials,
                    'newsletter'=> $news,
                    "formmessage" => $formmessage,
                    'menuselect' => $articlename,
                    'travelReasons' => $travelReasons,
                    'nationalTypes' => $nationalTypes,
                    'graphics' => $graphics,
                    'identityTypes' => $identityTypes,
                    'genders' => $genders,
                    'visaTypes' => $visaTypes,
                    'maritalStatus'=>$maritalStatus,
                    'nations'=>$nations,
                    'menu' => $menu,
                    'website'=>$website,                
                    'title' => $article->getTitle(),
                    'description' => $article->getDescription()
        
                ]);
    
            
    
            }





    }

