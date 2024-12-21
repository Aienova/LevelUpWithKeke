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
use App\Entity\Document;
use App\Service\Form\UploadDocument;
use App\Service\Form\UploadImage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CMSUploadDocumentController extends AbstractController
{

    private $entityManager;
    private $executer;



    public function __construct(EntityManagerInterface $entityManager,Executer $executer) {
    
        $this->entityManager = $entityManager;
        $this->executer = $executer;

    }


    #[Route('/api/data/upload/image', name: 'api_data_upload_image')]
    public function uploadImage(Request $request): Response
    {
        $uploadedFile = $request->files->get('file');

        // Your file handling logic here
        // For example, move the file to a specific directory
                                    $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
                                    $uploadedFile->move($destination, $uploadedFile->getClientOriginalName());

        return $this->json(['message' => 'File uploaded successfully']);
    }
}


        
    