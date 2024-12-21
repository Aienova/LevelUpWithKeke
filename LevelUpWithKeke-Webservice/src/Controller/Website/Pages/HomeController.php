<?php

namespace App\Controller\Website\Pages;

use App\Entity\CMSarticle;
use App\Entity\CMSgraphics;
use App\Entity\CMSitemSettings;
use App\Entity\CMSmenu;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Entity\Event;
use App\Entity\Newsletter;
use App\Entity\Performance;
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

class HomeController extends AbstractController
{

    private $security;
    private $submitform;
    private $mailer;
    private $entityManager;
    private $executer;

    public function __construct(Security $security, SubmitForm $submitform, Mailer $mailer , EntityManagerInterface $entityManager,Executer $executer  ) {

        $this->security = $security;
        $this->submitform = $submitform;
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
        $this->executer = $executer;

    }

    #[Route('/', name: 'cuid_home')]
    public function index(Request $request,SessionInterface $session): Response
    {

        header("location:/cuid/dashboard/home");
        die;

           $user = $session->get('user');
           

    $part="website";

     $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();

     $articles = $this->entityManager->getRepository(CMSarticle::class)->findByStatement(0);

     $statements = $this->entityManager->getRepository(CMSarticle::class)->findByStatement(1);

     $website= $this->entityManager->getRepository(CMSWebsite::class)->find(1);

     $socials = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();
     $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);

     $events = $this->entityManager->getRepository(Event::class)->findAll();

     $sections= $this->entityManager->getRepository(CMSitemSettings::class)->findItemsForHomepage();

     $news = 0;

     $formmessage="";

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


            return $this->render($part.'/pages/homepage.html.twig',[

                'part' => $part,              
                'title' => "Ambassade du Congo à Berlin",
                'description' => "Services en ligne de l'ambassade du Congo",
                'menu'=> $menu,
                'newsletter'=> $news,
                'graphics'=>$graphics,
                'formmessage'=>$formmessage,
                'statements'=>$statements,
                'user'=>$user,
                'events'=>$events,
                'articles'=> $articles,
                'socials'=>$socials,
                'menuselect'=>NULL,
                'sections'=>$sections,
                'website'=>$website,
    
            ]);

        

    }
}
