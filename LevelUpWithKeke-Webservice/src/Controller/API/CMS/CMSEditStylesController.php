<?php

namespace App\Controller\API\CMS;

use App\Entity\CMSgraphics;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Executer\Executer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use DateTimeImmutable;
use App\Entity\Document;
use App\Service\Form\UploadDocument;
use App\Service\Form\UploadImage;
use Doctrine\Common\Util\ClassUtils;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CMSEditStylesController extends AbstractController
{

    private $entityManager;
    private $executer;



    public function __construct(EntityManagerInterface $entityManager,Executer $executer) {
    
        $this->entityManager = $entityManager;
        $this->executer = $executer;

    }


    #[Route('/api/data/edit/styles/{element}/{value}', name: 'api_data_edit_styles')]
    public function editStyles($element,$value)
    {


        $graphics = $this->entityManager->getRepository(CMSgraphics::class)->findAll();


        $cssfile=file_get_contents("./cuid/custom.scss");

        if($element != "" || $value != 0){

        // Get the class name of the entity
        $className = ClassUtils::getClass($graphics);

        // Get the reflection class for the entity
        $reflectionClass = new \ReflectionClass($className);
        
        // Get all properties of the entity
        $properties = $reflectionClass->getProperties();
        
        // Loop through each property
        foreach ($properties as $property) {
            // Get the property name
        
            $propertyName = $property->getName();

            $content=str_replace("%".$propertyName."%",$_POST[$propertyName], $cssfile);

        }

    }else{

        $content=str_replace("%".$element."%",$_POST[$value], $cssfile);

    }



    




        /*

            $style=file_get_contents("./style/main".$element.".txt");

            $content=str_replace("%VALUE%",$value, $style);

        file_put_contents("./style/main".$element.".css", $content); */
        
        return $this->json(['message' => 'File uploaded successfully']);
    }
}


        
    