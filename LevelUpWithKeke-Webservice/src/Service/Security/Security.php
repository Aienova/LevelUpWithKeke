<?php

namespace App\Service\Security;


use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Candidate;
use App\Entity\CMSUser;
use App\Entity\Customer;
use App\Entity\Recruiter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Security extends AbstractController
{

    private $entityManager;



    public function __construct(

        EntityManagerInterface $entityManager,
        
        )
    {

        $this->entityManager = $entityManager;
    }

    public function SecurityCheck(SessionInterface $session){

        $token = $session->get('token');


        if($token==NULL){

            header("location:/connexion");
            die;

        }else{



            $class=Customer::class;
            
        

        $entity = $this->entityManager->getRepository($class)->findByToken($token);


        if($entity==NULL){

            header("location:/connexion");
            die;
    
            }

        if(isset($_POST["disconnection"])){

        
            $entity->setToken("disconnect");
            $session->clear();
            $this->entityManager->flush();
            header("location:/connexion");
            die;

        }



        

    }

    }

    public function SecurityCheckCMS(SessionInterface $session){

        $token = $session->get('token');


        if($token==NULL){

            header("location:/cuid/connection");
            die;

        }else{



            $class=CMSUser::class;
            
        

        $entity = $this->entityManager->getRepository($class)->findByToken($token);


        if($entity==NULL){

            header("location:/cuid/connection");
            die;
    
            }

        if(isset($_POST["disconnection"])){

        
            $entity->setToken("disconnect");
            $session->clear();
            $this->entityManager->flush();
            header("location:/connexion");
            die;

        }



        

    }

    }


    public function Securitystatut(SessionInterface $session){

        $token = $session->get('token');


        if($token==NULL){

            return 0;

        }else{

            return 1;
        }

    }


    public function FirstTimeCheck(SessionInterface $session){

        $user = $session->get('user');

        if($user->getState()==0){

            return TRUE;

        }else{

            return FALSE;
        }



    }

    
    public function Securityinfo(SessionInterface $session){

        $usertype = $session->get('usertype');


        if($usertype==NULL){

            return 0;

        }else{

            return 1;
        }

    }

}