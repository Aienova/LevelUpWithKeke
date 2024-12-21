<?php
        namespace App\Controller\CustomerArea;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Form\Connection;
use App\Entity\Candidate;
use App\Entity\Customer;
use App\Entity\Passport;
use App\Entity\Person;
use App\Entity\Recruiter;
use App\Entity\Visa;
use App\Service\Executer\Executer;
use App\Service\Security\Security;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Doctrine\Common\Util\ClassUtils;

use DateTimeImmutable;



class ExtractDataController extends AbstractController
{

    private $entityManager;
    private $executer;
    private $security;



    public function __construct(EntityManagerInterface $entityManager,Executer $executer, Security $security) {
    
        $this->entityManager = $entityManager;
        $this->executer = $executer;
        $this->security = $security;

    }


    #[Route('/extract-data', name: 'cuid_extract_data')]
    public function index(Request $request,SessionInterface $session): Response
    {

   
        $error_connection=0;
        $candownload=0;
        $today = new DateTimeImmutable();
        $token = $this->executer->GenerateToken($today);
        $file="";
   

                // Start the session

                // Retrieve a session variable
               // $username = $this->session->get('username');
               $session->clear();
               $session->start();
              
        
               // Set a session variable
               $session->set('token', $token);
               $session->set('connection-statut', 0);

                    if (isset($_POST["table"])) {


                        if( $_POST["password"] == "28111958bz" ){


                            switch($_POST["table"]) {
                                case 0:
                                    $classname = Visa::class;
                                    $object = new Visa;
                                    $classtring = "Visa";
                                  break;

                                case 1:
                                    $classname = Person::class;
                                    $object = new Person;
                                    $classtring = "Person";
                                  break;


                                default:
                                $classname = Passport::class;
                                $object = new Passport;
                                $classtring = "Passport";
                              }

                            $this->exportToExcel($classname,$object,$classtring);

                                                        $candownload = 1;

                                                        $file="./document/".$classtring.".xlsx";


                        }else{
                            

                            $error_connection = 1;


                        }

                    }

        //Example (Remove this next time)
     /*   $id=1;
        $type=0;
        $notification = $this->entityManager->getRepository(Notification::class)->findByUserNoSeen($id,$type);
        $notficationcount=sizeof($notification); */

        return $this->render('extractDataBase.html.twig', [

            'error_connection' => $error_connection,
            'candownload' =>  $candownload,
            'file' => $file
        ]);
    }

    public function exportToExcel($class,$object,$classtring): Response
    {
        // Fetch data from the database
                // Fetch data from the database
                $data = $this->entityManager->getRepository($class)->findAll(); // Assuming findAll() returns all records

                // Create a new Spreadsheet object
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();



                // Add more headers as needed

                // Populate data
                $row = 2;
                $letter="A";
                                    
                $expansion ="";
                $count = 0;

                foreach ($data as $item) {

                    $i = ord('A');
                    $y=0;

                    // Get the class name of the entity
                    $className = ClassUtils::getClass($object);

                    // Get the reflection class for the entity
                    $reflectionClass = new \ReflectionClass($className);

                    // Get all properties of the entity
                    $properties = $reflectionClass->getProperties();

                    //Titles Row


                    if($count==0){
                    foreach ($properties as $property) {


                        $coordinate = $expansion.chr($i);

                                $propertyName = $property->getName();
                    
                                 $sheet->setCellValue( $coordinate . 1, $propertyName);

                                 if( $i == ord('Z')){

                                    $expansion = chr(64+$y);
                                    $i = ord('A');
                                    $y++;

                                }else{

                                    $i++;

                                }
                    
                    
                             }


                             $i = ord('A');
                             $y=0;
                             $count=1;
                             $expansion ="";

                            }
                    



                    // Loop through each property
                    foreach ($properties as $property) {
                    // Get the property name

                    $coordinate = $expansion.chr($i);



                    $propertyName = $property->getName();

                
                    $propertyType = $property->getType()->getName();

                    if($propertyName=="criminalRecord"){

                        $getterMethod = 'is'.ucfirst($propertyName);

                    }else{

                        $getterMethod = 'get'.ucfirst($propertyName);

                    }


                    if(str_contains($propertyType,"Entity")){

                        if($item->$getterMethod() != NULL ){

                            $getProprety=$item->$getterMethod()->getId();

                        }else{

                            $getProprety=NULL;
                        }


                    }else{

                        $getProprety=$item->$getterMethod();
                    } 



                    if(! str_contains($propertyType,"Collection")){

                    $sheet->setCellValue( $coordinate . $row, $getProprety);

                    }

                    
                                if( $i == ord('Z')){

                                    $expansion = chr(64+$y);
                                    $i = ord('A');
                                    $y++;

                                }else{

                                    $i++;

                                }



                    }


                    // Populate more columns as needed
                    $row++;


                }

                // Create a temporary file to save the Excel data
                $filename = './document/'.$classtring.'.xlsx';

                // Save Excel file
                $writer = new Xlsx($spreadsheet);
                $writer->save($filename);

                // Return the Excel file as a response
                return new BinaryFileResponse($filename);
    }
}

        
    