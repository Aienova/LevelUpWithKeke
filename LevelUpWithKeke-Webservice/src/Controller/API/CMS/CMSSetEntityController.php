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



class CMSSetEntityController extends AbstractController
{

    private $entityManager;
    private $executer;



    public function __construct(EntityManagerInterface $entityManager,Executer $executer) {
    
        $this->entityManager = $entityManager;
        $this->executer = $executer;

    }


    #[Route('/api/data/set/{entity}/{id}/{property}', name: 'api_data_set')]
    public function setdata($entity,$id,$property,Request $request){


        $postData = json_decode($request->getContent(), true);

        $setterMethod = 'set'.ucfirst($property);

        if($entity=="user"){

            $className=CMSUser::class;

        }else{

            $className=CMSUser::class;

        }

        $entitydata = $this->entityManager->getRepository($className)->find($id);

                            $entitydata->$setterMethod($postData[$property]);
                            $this->entityManager->persist($entitydata);
                            $this->entityManager->flush();

                        /*
                            $userArray = [
                                'login' => $edituser->getLogin(),
                                'password' => $edituser->getPassword(),
                                'creationDate' => $edituser->getCreationDate(),
                                'level' => $edituser->getLevel()->getName(),
                                // ... add other properties as needed
                            ]; */

                        return $this->json([
                            
                            $property => $postData[$property],
        
                            ]
                    
                    
                    
                    );                               

    }
}

        
    