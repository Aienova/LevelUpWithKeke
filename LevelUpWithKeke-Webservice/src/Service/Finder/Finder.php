<?php

namespace App\Service\Finder;

use App\Entity\Activity;
use App\Entity\Booking;
use App\Entity\CMSarticle;
use App\Entity\CMSarticleCategory;
use App\Entity\CMSarticleTag;
use App\Entity\CMSfont;
use App\Entity\CMSfontWeight;
use App\Entity\CMSgallery;
use App\Entity\CMSgraphics;
use App\Entity\CMSHomepage;
use App\Entity\CMSitemSettings;
use App\Entity\CMSjobOffer;
use App\Entity\CMSLevel;
use App\Entity\CMSmail;
use App\Entity\CMSMedia;
use App\Entity\CMSmenu;
use App\Entity\CMSPage;
use App\Entity\CMSpayment;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSsocialmediaType;
use App\Entity\CMSstat;
use App\Entity\CMSUser;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Entity\Event;
use App\Entity\Faq;
use App\Entity\Form;
use App\Entity\FormData;
use App\Entity\FormItem;
use App\Entity\FormItemListOptionSettings;
use App\Entity\FormItemListSettings;
use App\Entity\FormStep;
use App\Entity\Nation;
use App\Entity\Notarize;
use App\Entity\NotarizeType;
use App\Entity\Performance;
use App\Entity\VisaType;
use App\Service\Executer\Executer;
use DateTimeImmutable;
use Doctrine\Common\Util\ClassUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Proxies\__CG__\App\Entity\Media;

class Finder
{
    private $entityManager;
    private $executer;

    public function __construct(


        EntityManagerInterface $entityManager,
        Executer $executer

        
        )
    {


        $this->entityManager = $entityManager;
        $this->executer = $executer;
    }

    public function getHomeData($user,$website,$part)  {

        $today = new DateTimeImmutable();

        $year = date("Y",$today->getTimestamp());

        $stat =  $this->entityManager->getRepository(CMSstat::class)->findByYear($year);

        $data =[
            
            "user"=>$user,
            "stat"=>$stat,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Accuiel",
    
                ];

        return $data;
    }


    public function getMediaData($user,$website,$part)  {

        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();

        $data =[
            
            "user"=>$user,
            "website"=>$website,
            "media"=>$media,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }

    

    public function getAddEventData($user,$website,$part)  {


        $events = $this->entityManager->getRepository(Event::class)->findAll();
        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();
        $categories = $this->entityManager->getRepository(CMSarticleCategory::class)->findAll();

        $data =[
            
            "user"=>$user,
            "events"=>$events,
            "categories"=>$categories,
            "media"=>$media,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter un évènement ",
    
                ];

        return $data;
    }


    public function getAddPerformanceData($user,$website,$part)  {


        $performances = $this->entityManager->getRepository(Performance::class)->findAll();
        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();

        $data =[
            
            "user"=>$user,
            "performances"=>$performances,
            "media"=>$media,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter un évènement ",
    
                ];

        return $data;
    }


       

    public function getAddJobData($user,$website,$part)  {


        $jobs = $this->entityManager->getRepository(CMSjobOffer::class)->findAll();
        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();

        $data =[
            
            "user"=>$user,
            "jobs"=>$jobs,
            "media"=>$media,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter un évènement ",
    
                ];

        return $data;
    }

    public function getAddgalleryData($user,$website,$part)  {


        $galleries = $this->entityManager->getRepository(CMSgallery::class)->findAll();
        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();

        $data =[
            
            "user"=>$user,
            "galleries"=>$galleries,
            "media"=>$media,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter un évènement ",
    
                ];

        return $data;
    }



    public function getAddPageData($user,$website,$part)  {


        $pages = $this->entityManager->getRepository(CMSPage::class)->findAll();

        $data =[
            
            "user"=>$user,
            "pages"=>$pages,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }

    public function getAddVisaData($user,$website,$part)  {


        $visas = $this->entityManager->getRepository(CMSPage::class)->findAll();

        $data =[
            
            "user"=>$user,
            "visas"=>$visas,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }

    public function getAddFaqData($user,$website,$part)  {


        $faqs = $this->entityManager->getRepository(Faq::class)->findAll();

        $data =[
            
            "user"=>$user,
            "faqs"=>$faqs,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une question à votre F.A.Q",
    
                ];

        return $data;
    }



    public function getAddListData($user,$website,$part)  {


        $list = $this->entityManager->getRepository(FormItemListSettings::class)->findAll();

        $data =[
            
            "user"=>$user,
            "list"=>$list,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    public function getListsData($user,$website,$part)  {


        $list = $this->entityManager->getRepository(FormItemListSettings::class)->findAll();

        $data =[
            
            "user"=>$user,
            "list"=>$list,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    
    public function getAddSocialData($user,$website,$part)  {


        $socialmediatypes = $this->entityManager->getRepository(CMSsocialmediaType::class)->findAll();

        $data =[
            
            "user"=>$user,
            "socialMediaTypes"=>$socialmediatypes,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }
    public function getAddUserData($user,$website,$part)  {


        $levels = $this->entityManager->getRepository(CMSLevel::class)->findAll();

        $data =[
            
            "user"=>$user,
            "levels"=>$levels,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }




    
    public function getAddArticleData($user,$website,$part)  {


        $articles = $this->entityManager->getRepository(CMSarticle::class)->findAll();
        $categories = $this->entityManager->getRepository(CMSarticleCategory::class)->findAll();
        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();
        $tags = $this->entityManager->getRepository(CMSarticleTag::class)->findAll();
        

        $data =[
            
            "user"=>$user,
            "tags"=>$tags,
            "articles"=>$articles,
            "categories"=>$categories,
            "website"=>$website,
            "media"=> $media,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    
    public function getAddnotarizetypeData($user,$website,$part)  {


        $notarizetypes = $this->entityManager->getRepository(NotarizeType::class)->findAll();

        $data =[
            
            "user"=>$user,
            "notarizetypes"=>$notarizetypes,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    

    public function getAddFormData($user,$website,$part)  {


        $forms = $this->entityManager->getRepository(Form::class)->findAll();
        $formitems = $this->entityManager->getRepository(FormItem::class)->findAll();
        $notarizetypes = $this->entityManager->getRepository(NotarizeType::class)->findByAuthentication(FALSE);

        $data =[
            
            "user"=>$user,
            "forms"=>$forms,
            "formItems"=>$formitems,
            "notarizetypes"=>$notarizetypes,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    

    public function getBookingsData($user,$website,$part)  {


        if(isset($_POST["filter"])){


            $bookings = $this->entityManager->getRepository(Booking::class)->findByFilter($_POST["proprety"],$_POST["value"],$_POST["decision"]);

        }else{

            $bookings = $this->entityManager->getRepository(Booking::class)->findAll();
        }


        $data =[
            
            "user"=>$user,
            "bookings"=>$bookings,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }

    
    public function getEventsData($user,$website,$part)  {


        if(isset($_POST["filter"])){

            $events = $this->entityManager->getRepository(Event::class)->findByFilter($_POST["proprety"],$_POST["value"]);

        }else{

            $events = $this->entityManager->getRepository(Event::class)->findAll();
        }

        $categories = $this->entityManager->getRepository(CMSarticleCategory::class)->findAll();


        $data =[
            "user"=>$user,
            "events"=>$events,
            "categories"=>$categories,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
                ];

        return $data;
    }

    

    
    public function getArticlesData($user,$website,$part)  {


        if(isset($_POST["filter"])){


            $articles = $this->entityManager->getRepository(CMSarticle::class)->findByFilter($_POST["proprety"],$_POST["value"]);

        }else{

        $articles = $this->entityManager->getRepository(CMSarticle::class)->findAll();

        }

        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();

        $data =[
            
            "user"=>$user,
            "articles"=>$articles,
            "website"=>$website,
            "media"=>$media,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    


    public function getFaqsData($user,$website,$part)  {


        if(isset($_POST["filter"])){


            $faqs = $this->entityManager->getRepository(Faq::class)->findByFilter($_POST["proprety"],$_POST["value"]);

        }else{

            $faqs = $this->entityManager->getRepository(Faq::class)->findAll();
        }

        $data =[
            
            "user"=>$user,
            "faqs"=>$faqs,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Votre F.A.Q ",
    
                ];

        return $data;
    }




    public function getPagesData($user,$website,$part)  {




        if(isset($_POST["filter"])){


            $pages = $this->entityManager->getRepository(CMSPage::class)->findByFilter($_POST["proprety"],$_POST["value"]);

        }else{

            $pages = $this->entityManager->getRepository(CMSPage::class)->findAll();
        }

        $data =[
            
            "user"=>$user,
            "pages"=>$pages,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    public function getCustomerData($user,$website,$part,$entity){



        $data =[
            
            "customer"=>$entity,
            "user"=>$user,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Vos offres d'emploi ",
    
                ];

        return $data;

    }



    public function getCandidatesData($user,$website,$part,$entity){


        $candidates = $entity->getCMSjobOfferCandidates();


        $data =[
            
            "job"=>$entity,
            "user"=>$user,
            "website"=>$website,
            "candidates"=>$candidates,
            "part"=>$part,
            "title"=>"Cuid - Vos offres d'emploi ",
    
                ];

        return $data;


    }

    

    public function getJobsData($user,$website,$part)  {



        if(isset($_POST["filter"])){


            $jobs = $this->entityManager->getRepository(CMSjobOffer::class)->findByFilter($_POST["proprety"],$_POST["value"]);

        }else{

            $jobs = $this->entityManager->getRepository(CMSjobOffer::class)->findAll();
        }

        $data =[
            
            "user"=>$user,
            "jobs"=>$jobs,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Vos offres d'emploi ",
    
                ];

        return $data;
    }


    public function getGalleriesData($user,$website,$part)  {


            $galleries = $this->entityManager->getRepository(CMSgallery::class)->findAll();
        

        $data =[
            
            "user"=>$user,
            "galleries"=>$galleries,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    public function getAboutData($user,$website,$part)  {




        $data =[
            
            "user"=>$user,
            "website"=>$website,
            "part"=>$part,
            "title"=>"A propos de Cuid ",
    
                ];

        return $data;
    }


    public function getMailsData($user,$website,$part)  {


        $mails = $this->entityManager->getRepository(CMSmail::class)->findAll();

        $data =[
            
            "user"=>$user,
            "mails"=>$mails,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }

    
    public function getHistoricData($user,$website,$part)  {



        $tables = $this->entityManager->getRepository(Form::class)->findAll();
        $visa = $this->entityManager->getRepository(Form::class)->find(1);
        $passport = $this->entityManager->getRepository(Form::class)->find(2);
        $visaservices = $this->entityManager->getRepository(Notarize::class)->findByForm($visa);
        $passportservices = $this->entityManager->getRepository(Notarize::class)->findByForm($passport);


        $counter = count($tables)-1;

        foreach ($tables as $table){


            $array2= $this->entityManager->getRepository(FormData::class)->findByForm($table);
            $count = count($array2)-1;

            if($count < 0 ){ $count = 0; }


            $array1= [
                
                "title" => $table->getTitle(),
                "tableid" => $table->getId(),
                "maxcount"=>$count
        
        ];



            $result = array_merge($array1, $array2);



            $data[]=$result;


        }


        $data =[
            
            "user"=>$user,
            "data"=>$data,
            "visaservices"=>$visaservices,
            "passportservices"=>$passportservices,
            "counter"=>$counter,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }



    
    public function getStatsData($user,$website,$part)  {


        $stat = $this->entityManager->getRepository(CMSstat::class)->find(1);
/*
        $object = new CMSstat;

                    // Get the class name of the entity
                    $className = ClassUtils::getClass($object);

                    // Get the reflection class for the entity
                    $reflectionClass = new \ReflectionClass($className);

                    // Get all properties of the entity
                    $properties = $reflectionClass->getProperties();

            $propertyNames = [];
            foreach ($properties as $property) {
                $property->setAccessible(true);

                $properytname = $property->getName();


                $propertyNames[] = $property->getName();
            }
*/
            $propertyNames = [

                0 => "identifiant",
                1 => "Nombre de client",
                2 => "Services en cours",
                3 => "Services annulés",
                4 => "Services terminés",
                5 => "Service le plus demandé",
                6 => "Total du meilleur service",
                7 => "Meilleur client",
                8 => "Totale de service de votre meilleur client",
                9 => "Dépense de votre meilleur client",
                10 => "Nombres de rendez-vous",
                11 => "Nombre de services effectués",
                12 => "Nombres de rendez-vous annulés",
                13 => "Nombre de rendez-vous terminés",
                14 => "Nombre de rendez-vous en cours",
                15 => "Nombres de mails en envoyés",
                16 => "L'année",
                17 => "Chiffre d'affaire totale"


            ];

            $count = count($propertyNames);

            $array = (array) $stat;

            foreach ($array as $value) {


                $propertyValues[] = $value ;
            }





        $data =[
            
            "user"=>$user,
            "statvalue"=>$propertyValues,
            "count"=>$count,
            "statname"=>$propertyNames,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }



    public function getPaymentsData($user,$website,$part)  {


        $payments = $this->entityManager->getRepository(CMSpayment::class)->findAll();

        $data =[
            
            "user"=>$user,
            "payments"=>$payments,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    public function getGraphicData($user,$website,$part,$entity)  {


        $graphics = $entity;
        $fonts = $this->entityManager->getRepository(CMSfont::class)->findAll();
        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();
        $fontweigths = $this->entityManager->getRepository(CMSfontWeight::class)->findAll();

        $data =[
            
            "user"=>$user,
            "graphics"=>$graphics,
            "media"=>$media,
            "fonts"=>$fonts,
            "fontWeights"=>$fontweigths,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }



    public function getGraphicsData($user,$website,$part)  {


        $graphics = $this->entityManager->getRepository(CMSgraphics::class)->findAll();
        $fonts = $this->entityManager->getRepository(CMSfont::class)->findAll();
        $fontweigths = $this->entityManager->getRepository(CMSfontWeight::class)->findAll();

        $data =[
            
            "user"=>$user,
            "graphics"=>$graphics,
            "fonts"=>$fonts,
            "fontWeights"=>$fontweigths,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    public function getSocialmediaData($user,$website,$part)  {


        $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();
        $socialmediatype = $this->entityManager->getRepository(CMSsocialmediaType::class)->findAll();
        

        $data =[
            
            "user"=>$user,
            "socialmedia"=>$socialmedia,
            "socialMediaTypes"=>$socialmediatype,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }




    public function getUsersData($user,$website,$part)  {


        $users = $this->entityManager->getRepository(CMSUser::class)->findAll();


        $data =[
            
            "user"=>$user,
            "users"=>$users,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }



        
    public function getCustomersData($user,$website,$part)  {


        if(isset($_POST["filter"])){


            $customers = $this->entityManager->getRepository(Customer::class)->findByFilter($_POST["proprety"],$_POST["value"]);

        }else{

            $customers = $this->entityManager->getRepository(Customer::class)->findAll();
        }


        $data =[
            
            "user"=>$user,
            "customers"=>$customers,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }
    

    
    public function getFormsData($user,$website,$part)  {


        $forms = $this->entityManager->getRepository(Form::class)->findAll();

        $data =[
            
            "user"=>$user,
            "forms"=>$forms,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }
    

    public function getListData($user,$website,$part,$entity)  {


        $list = $entity;
        $options = $this->entityManager->getRepository(FormItemListOptionSettings::class)->findByList($list);
        $count = count($options);


        foreach($options as $option){

            $listoption[] = $option;


        }


        $data =[
            
            "user"=>$user,
            "list"=>$list,
            "options"=>$listoption,
            "count"=>$count,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    public function getPageData($user,$website,$part,$entity)  {


        $page = $entity;


        $data =[
            
            "user"=>$user,
            "page"=>$page,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    
    public function getJobData($user,$website,$part,$entity)  {


        $job = $entity;


        $data =[
            
            "user"=>$user,
            "job"=>$job,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    
    public function getGalleryData($user,$website,$part,$entity)  {


        $gallery = $entity;
        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();


        $gallery =[
            
            "user"=>$user,
            "media"=>$media,
            "gallery"=>$gallery,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $gallery;
    }



    public function getVisaData($user,$website,$part,$entity)  {


        $visa = $entity;


        $data =[
            
            "user"=>$user,
            "visa"=>$visa,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }

    

    public function getEventData($user,$website,$part,$entity)  {

        $event = $entity;
        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();
        $categories = $this->entityManager->getRepository(CMSarticleCategory::class)->findAll();

        $data =[
            
            "user"=>$user,
            "event"=>$event,
            "categories"=>$categories,
            "media"=>$media,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }

    public function getPerformanceData($user,$website,$part,$entity)  {

        $performance = $entity;
        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();

        $data =[
            
            "user"=>$user,
            "performance"=>$performance,
            "media"=>$media,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }

    
    public function getFaqData($user,$website,$part,$entity)  {

        $faq = $entity;

        $data =[
            
            "user"=>$user,
            "faq"=>$faq,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }

    public function getUserData($user,$website,$part,$entity)  {


        $cuiduser = $entity;

        $levels = $this->entityManager->getRepository(CMSLevel::class)->findAll();


        $data =[
            
            "user"=>$user,
            "levels"=>$levels,
            "cuiduser"=>$cuiduser,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }




    public function getMailData($user,$website,$part,$entity)  {


        $mail = $entity;


        $data =[
            
            "user"=>$user,
            "mail"=>$mail,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    public function getSocialData($user,$website,$part,$entity)  {


        $socialmedia = $entity;
        $socialmediatypes = $this->entityManager->getRepository(CMSsocialmediaType::class)->findAll();


        $data =[
            
            "user"=>$user,
            "social"=>$socialmedia,
            "socialMediaTypes"=>$socialmediatypes,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    public function getHomepageData($user,$website,$part)  {


        $settings = $this->entityManager->getRepository(CMSitemSettings::class)->findItemsForHomepage();
        $page = $this->entityManager->getRepository(CMSHomepage::class)->find(1);
        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();


        $data =[
            
            "user"=>$user,
            "settings"=>$settings,
            "homepage"=>$page,
            "media"=>$media,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    public function getMenusData($user,$website,$part)  {



        $menus = $this->entityManager->getRepository(CMSmenu::class)->findAll();
        $pages = $this->entityManager->getRepository(CMSPage::class)->findAll();
        $menucount = count($menus) + 1;


        $data =[
            
            "user"=>$user,
            "menus"=>$menus,
            "menucount"=>$menucount,
            "pages"=>$pages,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    public function getInfosData($user,$website,$part)  {


        $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);
        $activities = $this->entityManager->getRepository(Activity::class)->findAll();
        $countries = $this->entityManager->getRepository(Nation::class)->findAll();
        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();

        $data =[
            
            "user"=>$user,
            "activities"=>$activities,
            "countries"=>$countries,
            "website"=>$website,
            "media"=>$media,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }



    
    public function getArticleData($user,$website,$part,$entity)  {


        $article = $entity;
        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();
        $categories = $this->entityManager->getRepository(CMSarticleCategory::class)->findAll();
        $tags = $this->entityManager->getRepository(CMSarticleTag::class)->findAll();


        $data =[
            
            "user"=>$user,
            "article"=>$article,
            "website"=>$website,
            "categories"=>$categories,
            "tags"=>$tags,
            "media"=>$media,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }



    public function getNotarizeTypeData($user,$website,$part,$entity)  {


        $notarizetype = $entity;

        $data =[
            
            "user"=>$user,
            "notarizetype"=>$notarizetype,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];


        return $data;
    }



    
    public function getNotarizetypesData($user,$website,$part)  {


        $notarizetypes = $this->entityManager->getRepository(NotarizeType::class)->findAll();



        $data =[
            
            "user"=>$user,
            "notarizetypes"=>$notarizetypes,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }

    public function getVisasData($user,$website,$part)  {


        $visatypes = $this->entityManager->getRepository(VisaType::class)->findAll();


        $data =[
            
            "user"=>$user,
            "visas"=>$visatypes,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }

    public function getFormData($user,$website,$part,$entity)  {


        $form = $entity;

        $lists = $this->entityManager->getRepository(FormItemListSettings::class)->findAll();


        $formitems = $this->entityManager->getRepository(FormItem::class)->findAll();
        $steps = $this->entityManager->getRepository(FormStep::class)->findByForm($form);
        $notarizetypes = $this->entityManager->getRepository(NotarizeType::class)->findByAuthentication(FALSE);

        $data =[
            
            "user"=>$user,
            "form"=>$form,
            "lists"=>$lists,
            "steps"=>$steps,
            "formItems"=>$formitems,
            "notarizetypes"=>$notarizetypes,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    public function getPerformancesData($user,$website,$part)  {


        if(isset($_POST["filter"])){


            $services = $this->entityManager->getRepository(Performance::class)->findByFilter($_POST["proprety"],$_POST["value"]);

        }else{

            $services = $this->entityManager->getRepository(Performance::class)->findAll();
        }



        $data =[
            
            "user"=>$user,
            "performances"=>$services,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Gérer votre service ",
    
                ];

        return $data;
    }


    public function getServicesData($user,$website,$part)  {


        if(isset($_POST["filter"])){


            $services = $this->entityManager->getRepository(Notarize::class)->findByFilter($_POST["proprety"],$_POST["value"],$_POST["decision"]);

        }else{

            $services = $this->entityManager->getRepository(Notarize::class)->findAll();
        }



        $data =[
            
            "user"=>$user,
            "services"=>$services,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Gérer votre service ",
    
                ];

        return $data;
    }

    public function getServiceData($user,$website,$part,$entity)  {


        $service = $entity;

        $details = $this->entityManager->getRepository(FormData::class)->findByCustomerAndNotarize($entity->getCustomer(),$entity);

        $data =[
            
            "user"=>$user,
            "service"=>$service,
            "details"=>$details,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }

    public function getThemeData($user,$website,$part)  {

        $data =[
            
            "user"=>$user,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }


    public function getSettingsData($user,$website,$part)  {

        $data =[
            
            "user"=>$user,
            "website"=>$website,
            "part"=>$part,
            "title"=>"Cuid - Ajouter une ",
    
                ];

        return $data;
    }




}
