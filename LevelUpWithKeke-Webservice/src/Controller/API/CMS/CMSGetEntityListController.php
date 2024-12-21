<?php

namespace App\Controller\API\CMS;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Executer\Executer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use DateTimeImmutable;
use App\Entity\CMSUser;
use App\Entity\Candidate;
use App\Entity\CMSarticle;
use App\Entity\CMSarticleCategory;
use App\Entity\CMSgallery;
use App\Entity\CMSgraphics;
use App\Entity\CMSHomepage;
use App\Entity\CMSMedia;
use App\Entity\CMSmenu;
use App\Entity\CMSPage;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSsubmenu;
use App\Entity\CMStestimonials;
use App\Entity\CMSWebsite;
use App\Entity\Event;
use App\Entity\Faq;
use App\Entity\Performance;
use Doctrine\Common\Util\ClassUtils;

class CMSGetEntityListController extends AbstractController
{

    private $entityManager;
    private $executer;



    public function __construct(EntityManagerInterface $entityManager,Executer $executer) {
    
        $this->entityManager = $entityManager;
        $this->executer = $executer;

    }


    #[Route('/api/data/get/list/{entity}', name: 'api_data_get_list')]
    public function apiGetDataList($entity): Response
    {
        
        if($entity=="page" ||  $entity=="page-exe"){

            $className=CMSPage::class;

        }

        if($entity=="workshop" ||  $entity=="workshop-exe"){

            $className=CMSarticle::class;

            $category = $this->entityManager->getRepository(CMSarticleCategory::class)->find(3);


        }

        if($entity=="advice" ||  $entity=="advice-exe"){

            $className=CMSarticle::class;

            $category = $this->entityManager->getRepository(CMSarticleCategory::class)->find(1);

        }

        if($entity=="lesson" ||  $entity=="lesson-exe"){

            $className=CMSarticle::class;

            $category = $this->entityManager->getRepository(CMSarticleCategory::class)->find(2);

        }

        if($entity=="lesson-event" ||  $entity=="lesson-event-exe"){

            $className=Event::class;

            $category = $this->entityManager->getRepository(CMSarticleCategory::class)->find(2);

        }

        if($entity=="homepage" ||  $entity=="homepage-exe"){

            $className=CMSHomepage::class;

        }

        if($entity=="testimonials" ||  $entity=="testimonials-exe"){

            $className=CMStestimonials::class;

        }

        if($entity=="performance" ||  $entity=="performance-exe"){

            $className=Performance::class;

        }

        if($entity=="website" ||  $entity=="website-exe"){

            $className=CMSWebsite::class;

        }


        if($entity=="graphics" ||  $entity=="graphics-exe"){

            $className=CMSgraphics::class;

        }


        if($entity=="faq" ||  $entity=="faq-exe"){

            $className=Faq::class;

        }

        
        if($entity=="socials" ||  $entity=="socials-exe"){

            $className=CMSsocialmedia::class;

        }


        if($entity=="menu" ||  $entity=="menu-exe"){

            $className=CMSmenu::class;

        }


        
        if($entity=="gallery" ||  $entity=="gallery-exe"){

            $className=CMSgallery::class;
            $gallery = $this->entityManager->getRepository($className)->find(4);
            $entitydata = $gallery->getPictures();
            $entitydata = $entitydata->toArray();
            $className=CMSMedia::class;


        }else{

            if($entity=="workshop" ||  $entity=="workshop-exe" || $entity=="advice" ||  $entity=="advice-exe" || $entity=="lesson" ||  $entity=="lesson-exe"  || $entity=="lesson-event" ||  $entity=="lesson-event-exe"){

                $entitydata = $this->entityManager->getRepository($className)->findByCategory($category);

            }else{

                $entitydata = $this->entityManager->getRepository($className)->findAll();

            }


        }

        

        $counter = count($entitydata);

// Get the reflection class for the entity
$reflectionClass = new \ReflectionClass($className);

// Get all properties of the entity
$properties = $reflectionClass->getProperties();

for($i=0;$i<$counter;$i++){
// Loop through each property
foreach ($properties as $property) {
    // Get the property name


    $propertyName = $property->getName();

    $propertyType = $property->getType()->getName();


    if($propertyType == "bool"){

        $prefix = 'is';

    }else{

        $prefix = 'get';

    }
    
    $method = $prefix.ucfirst($propertyName);




        $array[$propertyName] = $entitydata[$i]->$method();

        if($entity=="socials" ||  $entity=="socials-exe"){


            $array["name"]=$entitydata[$i]->getSocialMediaType()->getName();
    
    
        }

        if(str_contains($entity,'event')){


            $date = $entitydata[$i]->getEventDate();

            $hour = date("H",$date->getTimestamp());

            $minute = date("m",$date->getTimestamp());

            $date = date("d/m/Y",$date->getTimestamp());

            $array["date"]=$date;
            $array["hour"]=$hour;
            $array["minute"]=$minute;
    
        }

        if($entity=="advice" ||  $entity=="advice-exe" || $entity=="workshop" ||  $entity=="workshop-exe"){


            $array["tag"]=$entitydata[$i]->getTag()->getTitle();

            $date = $entitydata[$i]->getPublishDate();

            $date = date("d/m/Y",$date->getTimestamp());

            $array["date"]=$date;
    
    
        }

        if($entity=="graphics" ||  $entity=="graphics-exe"){


            $array["fontTitle"] = $entitydata[$i]->getFontTitle()->getName();
            $array["fontText"] = $entitydata[$i]->getFontText()->getName();    

            $array["fontTitleWeight"] = $entitydata[$i]->getFontTitleWeight()->getName();
            $array["fontTextWeight"] = $entitydata[$i]->getFontTextWeight()->getName();    
    
    
        }


    if($entity=="menu" ||  $entity=="menu-exe"){

        $submenus = $this->entityManager->getRepository(CMSsubmenu::class)->findByMenu($entitydata[$i]->getId());
        $submenudata = [];
        $submenusdata = [];


        foreach ($submenus as $submenu){

            $submenudata = [

                "id"=>$submenu->getId(),
                "title"=>$submenu->getTitle(),
                "url"=>$submenu->getUrl()
            ];


            $submenusdata[] = $submenudata;
            
        }

        $array["submenus"] = $submenusdata;
    
            }

    }



        $arraydata[] = $array;

                }

                if(strpos($entity, '-exe')){


                    $entity = str_replace("-exe", "", $entity);

                    
                                                    if($entity=="graphics"){
                                                    // Base URL
                                                    $baseUrl2 = 'http://localhost:3000/style_manager';
                                                    }else{

                                                        $baseUrl2 = NULL;          

                                                    }

                                                    $baseUrl = 'http://localhost:3000/json_manager';
                         
                                                    

                            
                                                    // Query parameters or JSON data
                                                    $data = $arraydata;
                                                    

                                                    $counter = count($data);

                                                    

                                                    if($counter>1){

                                                        $mode = "multi";
                                                    }else{

                                                        $mode = "unique";                                                    
                                                    }


                                                    for($counting = 0;$counting<$counter;$counting++ ){
                                                    
                                                    // Encode the parameters
                                                    $queryString = http_build_query($data[$counting]);
                                                    
                                                    // Append the query string to the URL

                                                        $jsonName = $entity;


                                                    if($baseUrl2 != NULL){

                                                        $url = $baseUrl2 . '?mode='.$mode.'&count='.$counting.'&maxcount='.$counter.'&style_name='.$jsonName.'&'.$queryString;                

                                                        file_get_contents($url);


                                                    }else{

                                                        $url = $baseUrl . '?mode='.$mode.'&count='.$counting.'&maxcount='.$counter.'&json_name='.$jsonName.'&'.$queryString;
                                                    
                                                        file_get_contents($url);

                                                    }
                                                    
                                                    // Make the request


                                                        
                                                    }
                                                                                            // Check for errors
                                                   
                                             }

                $json = $this->json($arraydata);

                
                return $json;

    

    }


}

        
    