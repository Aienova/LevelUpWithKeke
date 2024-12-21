<?php

namespace App\Controller\API\CMS;

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
use App\Entity\Document;
use App\Service\Form\UploadDocument;
use App\Service\Form\UploadImage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CMSCreatePageController extends AbstractController
{

    private $entityManager;
    private $executer;



    public function __construct(EntityManagerInterface $entityManager,Executer $executer) {
    
        $this->entityManager = $entityManager;
        $this->executer = $executer;

    }


    #[Route('/api/data/create/page', name: 'api_data_create_page')]
    public function createPage(Request $request)
    {

        $postData = json_decode($request->getContent(), true);


        $entitydata = new CMSPage;

        $title=$postData["title"];

        function removeTrailingCharacters($str, $charactersToRemove) {
            // Check if the string ends with the specified characters
            if (substr($str, -strlen($charactersToRemove)) === $charactersToRemove) {
                // Remove the specified characters using rtrim
                $str = rtrim($str, $charactersToRemove);
            }
        
            return $str;
        }


        $name=strtolower($title);
        $name = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        $name = str_replace(' ', '-', $name);
        $name = str_replace('/', '-', $name);
        $name = str_replace('\\', '', $name);
        $name = str_replace('\'', '', $name);
        $name = str_replace('`', '', $name);
        $pattern = '/[!?\s]/u';

    // Use preg_replace to replace exclamation and question marks with an empty string
        $name = preg_replace($pattern, '', $name);

        removeTrailingCharacters($name,'-');
        
        $entitydata->setName($name);
        $entitydata->setTitle($title);
        $this->entityManager->persist($entitydata);
        $this->entityManager->flush();
    


               
        return $this->json(['message' => 'File uploaded successfully']);
    }
}


        
    