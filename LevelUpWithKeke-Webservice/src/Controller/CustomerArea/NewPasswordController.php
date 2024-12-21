<?php

namespace App\Controller\CustomerArea;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Customer;

class NewPasswordController extends AbstractController
{


    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {

        $this->entityManager = $entityManager;
    }

    #[Route('/nouveau-mot-de-passe/{usertype}/{recoverCode}', name: 'cuid_recover_code')]
    public function index($usertype,$recoverCode): Response
    {   

        $message="";
        $error=0;
        $finish=0;

        if($usertype==0){

            $class=Customer::class;

        }

        $entity = $this->entityManager->getRepository($class)->findByRecoverCode($recoverCode);


        if($entity == NULL){
            
            $message="Cette page n'est plus accessible";
            $error=1;
            $finish=1;

        }else{

            if(isset($_POST["newPassword"])) {
                        

            if($_POST["newPassword"]==$_POST["confirmPassword"]){

            $entity->setPassword(md5($_POST["newPassword"]));
            $message="Votre mot de passe a bien été réinitialisé";
            $entity->setRecoverCode("done");
            $this->entityManager->flush();
            $finish=1;
                        

                }else{

                $message="Vos mots de passes renseignés ne sont pas identiques";
                $error=1;
                $finish=0;

                }
            }

        }

        return $this->render('newPassword.html.twig', [
            'usertype' => $usertype,
            'message' => $message,
            'error' => $error,
            'finish' => $finish

        ]);
    }
}
