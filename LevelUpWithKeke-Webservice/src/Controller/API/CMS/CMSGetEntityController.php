<?php

namespace App\Controller\API\CMS;

use App\Entity\CMSHomepage;
use App\Entity\CMSPage;
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
use App\Entity\CMSWebsite;
use App\Entity\NotarizeType;

class CMSGetEntityController extends AbstractController
{

    private $entityManager;
    private $executer;



    public function __construct(EntityManagerInterface $entityManager,Executer $executer) {
    
        $this->entityManager = $entityManager;
        $this->executer = $executer;

    }


    #[Route('/api/data/get/{entity}/{name}/{propertyTitle}', name: 'api_data_get')]
    public function apiGetData($name,$entity,$propertyTitle): Response
    {
    

        $getterMethod = 'get'.ucfirst($propertyTitle);

        $className=NULL;

        if($entity=="service"){

            $className=NotarizeType::class;
            $entitydata = $this->entityManager->getRepository($className)->findByName($name);

        }

        if($entity=="homepage"){

            $className=CMSHomepage::class;
            $entitydata = $this->entityManager->getRepository($className)->find(1);

        }

        if($entity=="website"){

            $className=CMSWebsite::class;
            $entitydata = $this->entityManager->getRepository($className)->find(1);

        }


        if($entity=="page"){

            $className=CMSPage::class;
            $entitydata = $this->entityManager->getRepository($className)->findByName($name);

        }


        $counter = 1;


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

                            $array[$propertyName] = $entitydata->$method();

                        }

                        }

                        $json = $this->json($array);

                    if($propertyTitle=="test"){


                                                        // Base URL
                                                        $baseUrl = 'http://localhost:3000/json_manager';
                                
                                                        // Query parameters or JSON data
                                                        $data = $array;
                                                        
                                                        // Encode the parameters
                                                        $queryString = http_build_query($data);
                                                        
                                                        // Append the query string to the URL


                                                        if($entity=="page"){

                                                            $jsonName = $entity."_".$name;

                                                        }else{
                                                            $jsonName = $entity;

                                                        }



                                                        $url = $baseUrl . '?mode=unique&json_name='.$jsonName.'&'.$queryString;
                        
                                                                                            // Make the request
                                                            $response = file_get_contents($url);

                                                                                                // Check for errors
                                    if ($response === false) {
                                        return "Failed to open URL.";
                                    } else {
                                        return  $json;
                                    }


                    }else{

                        
                        return $json;

                    }





    }
}

        
    