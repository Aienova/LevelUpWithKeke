<?php


namespace App\Service\Form;

use App\Entity\Activity;
use App\Entity\Booking;
use App\Entity\CMSarticle;
use App\Entity\CMSDocument;
use App\Entity\CMSfont;
use App\Entity\CMSfontWeight;
use App\Entity\CMSgallery;
use App\Entity\CMSHomepage;
use App\Entity\CMSitemSettings;
use App\Entity\CMSjobOffer;
use App\Entity\CMSLevel;
use App\Entity\CMSmail;
use App\Entity\Customer;
use App\Entity\FormData;
use App\Entity\Notarize;
use App\Entity\NotarizeType;
use App\Entity\Passport;
use App\Entity\Performance;
use App\Entity\Person;
use App\Entity\Visa;
use App\Entity\CMSMedia;
use App\Entity\CMSmenu;
use App\Entity\CMSPage;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSsocialmediaType;
use App\Entity\CMSsubmenu;
use App\Entity\CMSUser;
use App\Entity\CMSWebsite;
use App\Entity\Decision;
use App\Entity\Event;
use App\Entity\Form;
use App\Entity\FormItem;
use App\Entity\FormItemListOptionSettings;
use App\Entity\FormItemListSettings;
use App\Entity\FormItemSettings;
use App\Entity\FormStep;
use App\Entity\NotarizeDocument;
use App\Entity\Photo;
use App\Entity\VisaType;
use App\Service\Mailer\Mailer;
use Symfony\Component\Form\AbstractType;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Util\ClassUtils;
use Proxies\__CG__\App\Entity\Document;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Service\Executer\Executer;
use App\Controller\API\CMS\CMSGetEntityListController;
use App\Controller\API\CMS\CMSGetEntityController;
use App\Entity\CMSarticleCategory;
use App\Entity\CMSarticleTag;

class SubmitForm extends AbstractType
{

    
    private $entityManager;
    private $mailer;
    private $executer;
    private $getListData;
    private $getData;

    public function __construct(EntityManagerInterface $entityManager, Mailer $mailer, Executer $executer, CMSGetEntityListController $getListData, CMSGetEntityController $getData ) {
    
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
        $this->executer = $executer;
        $this->getListData = $getListData;
        $this->getData = $getData;
    }
    
    public function createBooking($data)
    {

        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // You can include other characters if needed
        $numbers = '0123456789'; // You can include other characters if needed
        $randomLetter = substr(str_shuffle($letters), 0, 2);
        $randomNumber = substr(str_shuffle($numbers), 0, 2);
        $randomString = str_shuffle($randomLetter.$randomNumber);
        $firstNameInitial = substr($data["firstname"], 0, 1);
        $surNameInitial = substr($data["surname"], 0, 1);
        $code=strtoupper($firstNameInitial.$surNameInitial)."-".$randomString."-".date("dmY");
        $tempcode = strtolower(substr(str_shuffle($letters), 0, 3)).substr(str_shuffle($numbers), 0, 2).date("dmYhis");
        

        $booking=new Booking;


        $customer = $this->entityManager->getRepository(Customer::class)->findByEmail($data["email"]);
        $accountmessage = "Um Ihre Anfrage zu bestätigen, melden Sie sich bitte unten in Ihrem Konto an:";
        $link="https://".$_SERVER['SERVER_NAME']."/kundenbereich/";



        if($customer==NULL){

            $customer=new Customer;
            $accountmessage = "Um Ihre Anfrage zu bestätigen, erstellen Sie bitte unten:";
            $link="https://".$_SERVER['SERVER_NAME']."/weiter-registrierung/".$tempcode;
        }


        $customer->setFirstname($data["firstname"]);
        $customer->setSurname($data["surname"]);
        $customer->setEmail($data["email"]);
        $customer->setTelephone($data["telephone"]);

        $this->entityManager->persist($customer);
        $this->entityManager->flush();

        $booking->setCustomer($customer);
        $dateTime = new DateTimeImmutable($data["bookingDate"]);
        $booking->setVisitor($customer->getFirstname()." ".$customer->getSurname());
        $booking->setBookingDate($dateTime);
        $booking->setLocation($data["location"]);
        $booking->setCode($code);
        $customer->setTempCode($tempcode);
        $booking->setConfirmation(FALSE);
        $cost=0;   

        for($i=1;$i<=4;$i++){



            if($data["performance".$i] == TRUE ){


                $perfomance = $this->entityManager->getRepository(Performance::class)->find($i);
                $booking->addPerformance($perfomance);


            }

        }


        $this->entityManager->persist($booking);
        $this->entityManager->flush();

            


        return $booking;
        
    }


    public function setAllEntityProreties($entity,$data){

        // Get the class name of the entity
$className = ClassUtils::getClass($entity);

// Get the reflection class for the entity
$reflectionClass = new \ReflectionClass($className);

// Get all properties of the entity
$properties = $reflectionClass->getProperties();

// Loop through each property
foreach ($properties as $property) {
    // Get the property name


    $propertyName = $property->getName();

    $propertyType = $property->getType()->getName();

    $setterMethod = 'set'.ucfirst($propertyName);


    if(isset($data[$propertyName])){

        $methodValue = $data[$propertyName];

        if(str_contains($propertyType,"Entity")){

            $methodValue = $this->entityManager->getRepository($propertyType)->find($data[$propertyName]);
        }

        if(str_contains($propertyType,"int")){

            $methodValue = (int)$data[$propertyName];
        }


        if(str_contains($propertyName,"Date") || str_contains($propertyName,"date")){

            $methodValue = new DateTimeImmutable($data[$propertyName]);
        }

        $entity->$setterMethod($methodValue); 
    }


} 

$this->entityManager->persist($entity);
$this->entityManager->flush();

        return $entity;
    }

    
    public function findPassport($customer){
        

        if($customer->getId() != 1){

            if(isset($_POST)){


                $numberId = $_POST["numberId"];
                $person = $customer->getPerson();
                $passports = $this->entityManager->getRepository(Passport::class)->findByPersonAndNumberId($person,$numberId);

            }else{

                $passports = $this->entityManager->getRepository(NotarizeDocument::class)->findByCustomer($customer);

            }


            return $passports;

        }else{

            if(isset($_POST)){

                $email = $_POST["email"];
                $firstname = $_POST["firstname"];
                $surname = $_POST["surname"];
                $numberId = $_POST["numberId"];
                $telephone = $_POST["telephone"];
                $person = $this->entityManager->getRepository(Person::class)->findByInfos($email,$firstname,$surname,$telephone);
                $passports = $this->entityManager->getRepository(Passport::class)->findByPersonAndNumberId($person,$numberId);
                
                return $passports;

            }else{

                return NULL;

            }
        }

    }


    public function findVisa($customer){
        

        if($customer->getId() != 1){

            if(isset($_POST)){

                $visanumberId = $_POST["visaNumberId"];
                $numberId = $_POST["numberId"];
                $person = $customer->getPerson();
                $passport = $this->entityManager->getRepository(Passport::class)->findByNumberId($numberId);
                $notarize = $this->entityManager->getRepository(Notarize::class)->findForchecking($person,$visanumberId,$passport);

            }else{

                $notarize = $this->entityManager->getRepository(Notarize::class)->findByCustomerAndNumberId($customer,$_POST["visaNumberId"]);

            }

            return $notarize;

        }else{

            if(isset($_POST)){

                    $email = $_POST["email"];
                    $telephone = $_POST["telephone"];
                    $visanumberId = $_POST["visaNumberId"];
                    $numberId = $_POST["numberId"];
                    $person = $this->entityManager->getRepository(Person::class)->findByEmailAndTelephone($email,$telephone);

                    $passport = $this->entityManager->getRepository(Passport::class)->findByNumberId($numberId);

                    $notarize = $this->entityManager->getRepository(Notarize::class)->findForchecking($person,$visanumberId,$passport);

    

                return $notarize;

            }else{

                return NULL;

            }
        }

    }


    public function findNotarizeDocument($customer){

        if($customer->getId() != 1){


            if(isset($_POST)){

                $code = $_POST["code"];
                $documentId = $_POST["documentId"];

                $documents = $this->entityManager->getRepository(NotarizeDocument::class)->findByCodeAndDocumentId($code,$documentId);




            }else{

                $documents = $this->entityManager->getRepository(NotarizeDocument::class)->findByCustomer($customer);

            }


            return $documents;

        }else{

            if(isset($_POST)){

                $code = $_POST["code"];
                $documentId = $_POST["documentId"];

                $documents = $this->entityManager->getRepository(NotarizeDocument::class)->findByCodeAndDocumentId($code,$documentId);
                
                return $documents;

            }else{

                return NULL;

            }
        }




    }



    public function createVisa($data,$customer)
    {
    

        $visa = new Visa;
        $checkperson = $this->entityManager->getRepository(Person::class)->findByCustomer($customer);
        $checkpassport = $this->entityManager->getRepository(Passport::class)->findByNumberId($data["numberId"]);
        
        if($checkperson != NULL ){

        $person = $checkperson;
        $newperson = $this->setAllEntityProreties($person,$data);


        }else{
            
            $person = new Person;
            $person->setCustomer($customer);
            $newperson = $this->setAllEntityProreties($person,$data);


        }


        if($checkpassport != NULL ){

            $passport = $checkpassport;
            $newpassport =$this->setAllEntityProreties($passport,$data);

            
    
            }else{

        $passport = new Passport;
        $passport->setPerson($newperson);
        $newpassport =$this->setAllEntityProreties($passport,$data);

            }

        $visa->setPerson($newperson);

        $visa->setPassport($newpassport);
        $visa->setCustomer($customer);

        $newvisa = $this->setAllEntityProreties($visa,$data);

        return $newvisa;
        
    }


    public function createFormData($data,$customer,$form,$notarizeentity)
    {
    



        $i=0;



        foreach ($data as $onedata) {


            if( $i > 0 ) {

            $id = $form->getId();

            if(isset($data["form_".$id."_field_".$i."_column"])){

                $formdata = new FormData;

                $formdata->setNotarize($notarizeentity);
    
                $formdata->setForm($form);
    
                $formdata->setCustomer($customer);

                $formdata->setName($data["form_".$id."_field_".$i."_column"]);

        if($data["form_".$id."_field_".$i."_type"]=="date"){

            $value = date("d/m/Y",strtotime($data["form_".$id."_field_".$i]));
        }

        elseif($data["form_".$id."_field_".$i."_type"]=="file"){

            $value = "Enregistré";
        }

        else{

            $value = $data["form_".$id."_field_".$i];
        }

        $formdata->setValue($value);

        $this->entityManager->persist($formdata);
        $this->entityManager->flush();


            }


        }

        $i++;

    }


 
    }



    public function createPerson($data,$customer)   {


        $checkperson = $this->entityManager->getRepository(Person::class)->findByCustomer($customer);
    
        if($checkperson != NULL ){

            $person = $checkperson;
            $newperson = $this->setAllEntityProreties($person,$data);
            $this->entityManager->persist($newperson);
            $this->entityManager->flush();
    
            }else{
                
                $person = new Person;
                $person->setCustomer($customer);
                $newperson = $this->setAllEntityProreties($person,$data);
                $this->entityManager->persist($newperson);
                $this->entityManager->flush();
    
            }
            

        return $newperson;
        
    }


    public function createBookingForCustomer($data,$customer)
    {

        $booking=new Booking;

        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // You can include other characters if needed
        $numbers = '0123456789'; // You can include other characters if needed
        $randomLetter = substr(str_shuffle($letters), 0, 2);
        $randomNumber = substr(str_shuffle($numbers), 0, 2);
        $randomString = str_shuffle($randomLetter.$randomNumber);
        $firstNameInitial = substr($customer->getFirstname(), 0, 1);
        $surNameInitial = substr($customer->getSurname(), 0, 1);
        $code=strtoupper($firstNameInitial.$surNameInitial)."-".$randomString."-".date("dmY");
        
        $booking->setCustomer($customer);
        $thedate = $data["bookingDate"]." ".$data["hour"];
        $dateTime = new DateTimeImmutable($thedate);
   
        $booking->setBookingDate($dateTime);

        $booking->setCode($code);
        $booking->setDecision($this->entityManager->getRepository(Decision::class)->find(2));
        $booking->setSubject($data["subject"]);
        $booking->setComment($data["comment"]);
        $booking->setConfirmation(FALSE);
        $cost=0;   

        for($i=1;$i<=4;$i++){



            if(isset($data["performance".$i])){


                $perfomance = $this->entityManager->getRepository(Performance::class)->find($data["performance".$i]);
                $booking->addPerformance($perfomance);


            }

        }

        $booking->setLocation("Wallstraße 69, 10179 Berlin");
        if($customer->getId() != 1){

            $visitor = $customer->getFirstname()." ".$customer->getSurname();

        }else{

            $visitor = $_POST["firstname"]." ".$_POST["surname"];          
        }

        $booking->setVisitor($visitor);
        $this->entityManager->persist($booking);
        $this->entityManager->flush();

        return $booking;
        
    }

    public function randomizeCode($customer){

        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // You can include other characters if needed
        $numbers = '0123456789'; // You can include other characters if needed
        $randomLetter = substr(str_shuffle($letters), 0, 2);
        $randomNumber = substr(str_shuffle($numbers), 0, 2);
        $randomString = str_shuffle($randomLetter.$randomNumber);
        $firstNameInitial = substr($customer->getFirstname(), 0, 1);
        $surNameInitial = substr($customer->getSurname(), 0, 1);
        $code=strtoupper($firstNameInitial.$surNameInitial)."-".$randomString."-".date("dmY");

        return $code;


    }

    public function randomizeNumber(){

 
        $numbers = '0123456789'; // You can include other characters if needed
        $randomNumber = substr(str_shuffle($numbers), 0, 4);
        $mix = str_shuffle($randomNumber);
   
        return $mix;


    }


    public function storeFilesForDocument($name,$notarize,$code,$customer)
    {

        $file = new CMSDocument();
        $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);

        $today = new DateTimeImmutable();

        $file->setNotarize($notarize);
        $file->setName($name);
        $file->setDateUploaded($today);
        


        $link = $website->getLink()."cuid/document/notarize/".$customer->getId()."/".$code."/".$name;
        $file->setLink($link);
        $this->entityManager->persist($file);
        $this->entityManager->flush();

    }


    public function createNotarizeForCustomer($documentlink,$data,$customer,$code)
    {

        $notarize=new Notarize;

        
        $notarize->setCustomer($customer);
        $dateTime = new DateTimeImmutable();
        
        $notarize->setDateCreation($dateTime);
        
        $notarize->setNumberId($code);
        $notarize->setPaid(0);
        $notarize->setCancelled(0);

        $notarize->setComment($data["comment"]);
        $notarize->setDecision($this->entityManager->getRepository(Decision::class)->find(2));
        $type = $this->entityManager->getRepository(NotarizeType::class)->find($data["notarizeType"]);
        $notarize->setType($type);
        $notarize->setCost($type->getPrice());

        if($customer->getPerson()!=NULL){

            $notarize->setPerson($customer->getPerson());
        }

        $notarize->setdocument($documentlink);


        $this->entityManager->persist($notarize);
        $this->entityManager->flush();

        return $notarize;
        
    }

    

    public function setNotarizetypeData($data,$entity)
    {
        if($entity != NULL){

            $notarizetype = $entity;

        }else{

            $notarizetype = new NotarizeType;

        }

        $name = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $data["frName"]);

        $name = strtolower($name);

        $name = str_replace(" ","-",$name);

        $notarizetype->setName($name);

        $notarizetype->setFrName($data["frName"]);

        $notarizetype->setPrice($data["price"]);

        $notarizetype->setDetails($data["content"]);

        if($data["isAuth"]==1){
            $notarizetype->setConsularDocument(TRUE);
        }
        
        else{
            $notarizetype->setConsularDocument(FALSE);
        }


        $this->entityManager->persist($notarizetype);
        $this->entityManager->flush();

        return $notarizetype->getId();

    }

    public function setUserData($data,$entity)
    {
        if($entity != NULL){

            $user = $entity;

        }else{

            $user = new CMSUser;

        }

        $today = new DateTimeImmutable();

        $level = $this->entityManager->getRepository(CMSLevel::class)->find($data["level"]);


        $user->setFirstname($data["firstname"]);

        $user->setSurname($data["surname"]);

        $user->setEmail($data["email"]);

        $user->setLogin($data["login"]);

        $hashpassword=md5($data["password"]);

        $user->setPassword($hashpassword);

        $user->setLevel($level);

        $user->setState(1);

        $user->setCreationDate($today);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user->getId();

    }


    public function setListData($data,$entity)
    {
        if($entity != NULL){

            $list = $entity;
            $options = $this->entityManager->getRepository(FormItemListOptionSettings::class)->findByList($list);

            foreach($options as $option){


                $this->entityManager->remove($option);
                $this->entityManager->flush();

            }


        }else{

            $list = new FormItemListSettings;
            $option = new FormItemListOptionSettings;

        }

        $list->setTitle($data["title"]);

        $list->setName($data["name"]);

        $this->entityManager->persist($list);
        $this->entityManager->flush();

        for($i = 1 ; $i <= $data["totaloptions"] ; $i ++){

            $option->setFormItemListSettings($list);
            $option->setValue($data["option".$i]);

            $this->entityManager->persist($option);
            $this->entityManager->flush();
            $option = new FormItemListOptionSettings;

        }

        $updatedoptions = $this->entityManager->getRepository(FormItemListOptionSettings::class)->findByList($list);


        $list->setOptionsTotal(count($updatedoptions));
        $this->entityManager->persist($list);
        $this->entityManager->flush();

        return $list->getId();

    }



    public function setMailData($data,$entity)
    {
        if($entity != NULL){

            $mail = $entity;

        }else{

            $mail = new CMSmail;

        }

        $mail->setHeader($data["header"]);

        $mail->setBody($data["body"]);

        $mail->setFooter($data["footer"]);

        $this->entityManager->persist($mail);
        $this->entityManager->flush();

        return $mail->getId();

    }

    
    public function setSocialData($data,$entity)
    {
        if($entity != NULL){

            $social = $entity;

        }else{

            $social = new CMSsocialmedia;

        }

        $today = new DateTimeImmutable();

        $socialMediaType = $this->entityManager->getRepository(CMSsocialmediaType::class)->find($data["socialmediaType"]);


        $social->setSocialMediaType($socialMediaType);

        $social->setLink($data["link"]);


        $social->setCreationDate($today);
        

        $social->setVisibility($data["visibility"]);

        $this->entityManager->persist($social);
        $this->entityManager->flush();

        $this->getListData->apiGetDataList("socials-exe");

        return $social->getId();

    }

    public function setEventData($data,$entity){

        
        if($entity != NULL){

            $event = $entity;

        }else{

            $event = new Event;

        }

        $name = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $data["title"]);

        $name = strtolower($name);

        $name = str_replace(" ","-",$name);
        $name = str_replace("'","-",$name);
        $name = str_replace("^","",$name);
        $name = str_replace("`","",$name);



        $event->setTitle($data["title"]);
        $event->setTag($name);
        $event->setDescription($data["description"]);
        $event->setEventDate(new DateTime($data["eventDate"]));
        $event->setContent($data["content"]);

        $imagelink = $this->entityManager->getRepository(CMSMedia::class)->find($data["picture"])->getLink();

        $category = $this->entityManager->getRepository(CMSarticleCategory::class)->find($data["category"]);
        $event->setCategory($category);

        $event->setImage($imagelink);



        $this->entityManager->persist($event);
        $this->entityManager->flush();

        if($data["category"]==2){

            $this->getListData->apiGetDataList("lesson-event-exe");

        }


        return $event->getId();

    }


    public function setPerformanceData($data,$entity){

        
        if($entity != NULL){

            $perf = $entity;

        }else{

            $perf = new Performance;

        }

        $name = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $data["name"]);

        $name = strtolower($name);

        $name = str_replace(" ","-",$name);
        $name = str_replace("'","-",$name);
        $name = str_replace("^","",$name);
        $name = str_replace("`","",$name);



        $perf->setName($data["name"]);
        $perf->setTag($name);
        $perf->setDescription($data["description"]);
        $perf->setContent($data["content"]);
        $perf->setPrice($data["price"]);
        $perf->setTotaltime($data["totaltime"]);

        $picture = $this->entityManager->getRepository(CMSMedia::class)->find($data["picture"]);

        $perf->setLogo($picture);

        $imagelink = $picture->getLink();

        $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);

        $perf->setSymbol($website->getCuidlink().$imagelink);

        $this->entityManager->persist($perf);
        $this->entityManager->flush();
        $this->getListData->apiGetDataList("performance-exe");
        
        return $perf->getId();

    }

    public function setVisaData($data,$entity){

        
        if($entity != NULL){

            $visa = $entity;

        }else{

            $visa = new VisaType;

        }

        $visa->setFRName($data["frName"]);
        $visa->setPrice($data["price"]);
        $visa->setDay($data["day"]);


        $this->entityManager->persist($visa);
        $this->entityManager->flush();
        return $visa->getId();

    }



    public function setPageData($data,$entity)
    {

        if($entity != NULL){

            $page = $entity;

        }else{

            $page = new CMSPage;

        }

        $today = new DateTimeImmutable();

        $name = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $data["title"]);

        $name = strtolower($name);

        $name = str_replace(" ","-",$name);
        $name = str_replace("'","-",$name);
        $name = str_replace("^","",$name);
        $name = str_replace("`","",$name);

        $page->setName($name);
        $page->setVisibility(1);
        $page->setTitle($data["title"]);
        $page->setDescription($data["description"]);
        $page->setAuthor($data["author"]);
        $page->setCreationDate($today);
        $page->setContent($data["content"]);

        $this->entityManager->persist($page);
        $this->entityManager->flush();

        $this->getData->apiGetData($name,"page","test");

        return $page->getId();

    }



    public function setJobData($data,$entity)
    {

        if($entity != NULL){

            $job = $entity;

        }else{

            $job = new CMSjobOffer;

        }

        $today = new DateTimeImmutable();

        $name = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $data["title"]);

        $name = strtolower($name);

        $name = str_replace(" ","-",$name);
        $name = str_replace("'","-",$name);
        $name = str_replace("^","",$name);
        $name = str_replace("`","",$name);

        $job->setTag($name);
        $job->setTitle($data["title"]);
        $job->setDiploma($data["diploma"]);
        $job->setWage($data["wage"]);
        $job->setDescription($data["description"]);
        $job->setStartDate($today);
        $job->setContent($data["content"]);

        $this->entityManager->persist($job);
        $this->entityManager->flush();
        return $job->getId();

    }




    public function setGalleryData($data,$entity)
    {

        if($entity != NULL){

            $gallery = $entity;

        }else{

            $gallery = new CMSgallery;

        }

        $today = new DateTimeImmutable();

        $name = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $data["title"]);

        $name = strtolower($name);

        $name = str_replace(" ","-",$name);
        $name = str_replace("'","-",$name);
        $name = str_replace("^","",$name);
        $name = str_replace("`","",$name);

        $gallery->setTag($name);
        $gallery->setVisibility(1);
        $gallery->setTitle($data["title"]);
        $gallery->setCreationDate($today);

        $media = $this->entityManager->getRepository(CMSMedia::class)->findAll();

        foreach($media as $media){

            $id = $media->getId();

            $i=0;

            if(isset($_POST["picture-".$id])){

                $gallery->addPicture($media);

                if($i==0){

                    $gallery->setImage($media->getLink());

                }
            }
        }



        $this->entityManager->persist($gallery);
        $this->entityManager->flush();
        return $gallery->getId();

    }


    public function setMenusData($data,$entity)
    {

        if($data["action"]=="edit"){

            $menu = $this->entityManager->getRepository(CMSmenu::class)->find($data["id"]);



        }
        
        
        if($data["submenu"]!=0 ){

            $menu = $this->entityManager->getRepository(CMSmenu::class)->find($data["submenu"]);

            if($data["action"]=="edit-submenu"){

                $submenu = $this->entityManager->getRepository(CMSsubmenu::class)->find($data["id"]);
                
    
            }else{

                $submenu = new CMSsubmenu;

                $submenu->setCmsmenu($menu);
            }
            

            $submenu->setTitle($data["title"]);

            if($data["page"]>0){

                $page = $this->entityManager->getRepository(CMSPage::class)->find($data["page"]);
    
                $submenu->setPage($page);
                $url = "/page/".$page->getName();         
                $submenu->setUrl($url);                     
    
            }else{
                
                $submenu->setPage(NULL);
                $submenu->setUrl($data["link"]);
    
            }

            if($_POST["decision"]=="Supprimer"){


                $this->entityManager->remove($submenu);
                $this->entityManager->flush();
                $allsubmenu = $this->entityManager->getRepository(CMSsubmenu::class)->findByMenu($menu);
                $count = count($allsubmenu);


    
                foreach ($allsubmenu as $submenu){
    
                    $submenu->setTotalsubmenu($count);
                    $this->entityManager->persist($submenu);
                    $this->entityManager->flush();
    
                }

                return NULL;
    
            }


            $this->entityManager->persist($submenu);
            $this->entityManager->flush();

            $allsubmenu = $this->entityManager->getRepository(CMSsubmenu::class)->findByMenu($menu);
            $count = count($allsubmenu);

            foreach ($allsubmenu as $submenu){

                $submenu->setTotalsubmenu($count);
                $this->entityManager->persist($submenu);
                $this->entityManager->flush();

            }




            return $submenu->getId();

        }


        if($data["action"]=="add"){

            $menu = new CMSmenu;


        }


        $today = new DateTimeImmutable();

        $menu->setTitle($data["title"]);


        if($_POST["decision"]=="Supprimer"){


            $this->entityManager->remove($menu);
            $this->entityManager->flush();
            return NULL;

        }

        if($data["page"]>0){

            $page = $this->entityManager->getRepository(CMSPage::class)->find($data["page"]);

            $menu->setPage($page);
            $url = "/page/".$page->getName();         
            $menu->setUrl($url);                     

        }else{
            
            $menu->setPage(NULL);
            $menu->setUrl($data["link"]);

        }


        $menu->setPosition($data["position"]);
        $menu->setTopmenu(1);

        $this->entityManager->persist($menu);
        $this->entityManager->flush();

        $this->getListData->apiGetDataList("menu-exe");

        return $menu->getId();

    }


    public function setHomepageData($data,$entity)
    {


            $entity = $this->entityManager->getRepository(CMSHomepage::class)->find(1);


            $today = new DateTimeImmutable();



        if($data["homepage_data"]=="maininfos"){

            $entity->setTitle($data["title"]);
            $entity->setDescription($data["description"]);

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        }


        if($data["homepage_data"]=="banner"){
            
            $entity->setBannerTitle($data["bannerTitle"]);
            $entity->setBannerVideo($data["bannerVideo"]);
            $entity->setBannerVideoDisplayed($data["bannerVideoDisplayed"]);
            $picture=$this->entityManager->getRepository(CMSMedia::class)->find($data["picture"]);
            $entity->setBannerImage($picture->getLink());      
            $entity->setBannerImageId($picture);  
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        }

        if($data["homepage_data"]=="otherinfos"){
            
            $entity->setAboutUsTitle($data["aboutUsTitle"]);
            $entity->setAboutUs($data["aboutUs"]);
            $entity->setOurServicesTitle($data["ourServicesTitle"]);
            $entity->setOurServices($data["ourServices"]);
            $entity->setOurPricesTitle($data["ourPricesTitle"]);
            $entity->setOurPrices($data["ourPrices"]);

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        }

        $this->getListData->apiGetDataList("homepage-exe");

        return $entity->getId();

    }


    public function setInfosData($data,$entity)
    {


        $entity = $this->entityManager->getRepository(CMSWebsite::class)->find(1);
            $homepage = $this->entityManager->getRepository(CMSHomepage::class)->find(1);

            $logo = $this->entityManager->getRepository(CMSMedia::class)->find($data["picture"]);

            $homepage->setTitle($data["title"]);
            $homepage->setDescription($data["description"]);
            $entity->setLogo($logo);
            $entity->setOwner($data["owner"]);
            $entity->setCountry($data["country"]);
            $entity->setLink($data["link"]);
            $entity->setDomain($data["domain"]);
            $entity->setEmail($data["email"]);
            $entity->setTelephone($data["telephone"]);
            $entity->setLocation($data["location"]);
            $entity->setCompanyName($data["companyName"]);
            $entity->setCompanyId($data["companyId"]);
            $entity->setActivity($data["activity"]);

            $this->entityManager->persist($entity);
            $this->entityManager->flush();

            $this->getListData->apiGetDataList("website-exe");

            

        return $entity->getId();

    }


    public function setGraphicData($data,$entity)
    {

        if( $data["isImage"] == 1 ){
            $backgroundImage = $this->entityManager->getRepository(CMSMedia::class)->find($data["picture"]);
        }else{

            $backgroundImage = NULL;
        }
           
            $fontitle = $this->entityManager->getRepository(CMSfont::class)->findByFont($data["fontTitle"]);
            $fontext = $this->entityManager->getRepository(CMSfont::class)->findByFont($data["fontText"]);

            $fontitleweight = $this->entityManager->getRepository(CMSfontWeight::class)->findByFontWeight($data["fontTitleWeight"]);
            $fontextweight = $this->entityManager->getRepository(CMSfontWeight::class)->findByFontWeight($data["fontTextWeight"]);

            $today = new DateTimeImmutable();

            $entity->setPrimaryColor($data["primaryColor"]);
            $entity->setSecondaryColor($data["secondaryColor"]);
            $entity->setThirdColor($data["thirdColor"]);
            $entity->setHeaderColor($data["headerColor"]);
            $entity->setFooterColor($data["footerColor"]);
           
            $entity->setBackgroundImage($backgroundImage->getLink());
           
            $entity->setBackgroundRepeat($data["backgroundReapeat"]);
            $entity->setFontTitle($fontitle);
            $entity->setFontText($fontext);
            $entity->setFontTitleWeight($fontitleweight);
            $entity->setFontTextWeight($fontextweight);

            $this->entityManager->persist($entity);
            $this->entityManager->flush();

            $this->getListData->apiGetDataList("graphics-exe");


        return $entity->getId();

    }


    public function setArticleData($data,$entity)
    {


        $image = $this->entityManager->getRepository(CMSMedia::class)->find($data["picture"]);


        if($entity != NULL){

            $article = $entity;

        }else{

            $article = new CMSarticle;

        }

        $today = new DateTimeImmutable();

        $name = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $data["title"]);

        $name = strtolower($name);

        $name = str_replace(" ","-",$name);
        $name = str_replace("'","-",$name);
        $name = str_replace("^","",$name);
        $name = str_replace("`","",$name);


        $publishdate = new DateTimeImmutable($data["publishDate"]);

        $article->setName($name);
        $article->setVisibility(1);
        $article->setTitle($data["title"]);
        $article->setDescription($data["description"]);
        $article->setAuthor($data["author"]);
        $category = $this->entityManager->getRepository(CMSarticleCategory::class)->find($data["category"]);
        $tag = $this->entityManager->getRepository(CMSarticleTag::class)->find($data["tag"]);
        $article->setCategory($category);
        $article->setTag($tag);
        $article->setStatement($data["statement"]);
        $article->setImage($image->getLink());


        if($article->getCreationDate() == NULL){
            $article->setCreationDate($today);

        }

        $article->setPublishDate($publishdate);
        $article->setContent($data["content"]);

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        if($data["category"]==3){

            $this->getListData->apiGetDataList("workshop-exe");
        }

        if($data["category"]==1){

            $this->getListData->apiGetDataList("advice-exe");
        }

        return $article->getId();

    }



    public function setFormData($data,$entity)
    {

        if($entity != NULL){

            $form = $entity;

        }else{

            $form = new Form;

        }



        if(isset($data["addNewFormItem"])){


            $field = new FormItemSettings;

            $field->setTitle($data["title"]);
            $field->setForm($form);
            $field->setFormItem($this->entityManager->getRepository(FormItem::class)->find($data["formItem"]));



            $this->entityManager->persist($field);
            $this->entityManager->flush();
            return $form->getId();

        }

        if(isset($data["EditFormItem"])){

            $field = $this->entityManager->getRepository(FormItemSettings::class)->find($data["entity"]);


            if($data["decision"]=="Supprimer"){

                $this->entityManager->remove($field);
                $this->entityManager->flush();
                return $form->getId();

            }


            if(isset($data["list"])){

                $field->setFormItemListSettings($this->entityManager->getRepository(FormItemListSettings::class)->find($data["list"]));
                $this->entityManager->persist($field);
                $this->entityManager->flush();
            }

        }


        if(isset($data["addNewStep"])){


            $step = new FormStep;

            $step->setName($data["title"]);
            if( $form->getSteps() == NULL || $form->getSteps() == 0 ){

                $position = 1;
                $form->setSteps(1);
            }
            

            else{

                $position = $form->getSteps() + 1;

                $form->setSteps( $position );
            }


            $step->setForm($form);
            $step->setPosition($position);
            $this->entityManager->persist($step);
            $this->entityManager->flush();
            $this->entityManager->persist($form);
            $this->entityManager->flush();
            return $form->getId();

        }

        

        if(isset($data["EditFormItem"])){


            $field = $this->entityManager->getRepository(FormItemSettings::class)->find($data["entity"]);

            $field->setTitle($data["title"]);
            $field->setName($data["title"]);


            if( isset($data["placeholder"]) ){
                
                $field->setPlaceholder($data["placeholder"]);

            }


            if( isset($data["min"]) ){
                
                $field->setMin($data["min"]);

            }

            if( isset($data["max"]) ){
                
                $field->setMax($data["max"]);

            }

            if( isset($data["step"]) ){
                
                $field->setFormStep($this->entityManager->getRepository(FormStep::class)->find($data["step"]));

            }

            $this->entityManager->persist($field);
            $this->entityManager->flush();
            return $form->getId();

        }

        
        
        
        else{


        

        $today = new DateTimeImmutable();

        $notarizeType = $this->entityManager->getRepository(NotarizeType::class)->find($data["notarize"]);


        $form->setVisibility(1);
        $form->setName($notarizeType->getName());
        $form->setTitle($data["title"]);
        $form->setDescription($data["description"]);
        $form->setAuthor($data["author"]);
        $form->setNotarizeType($notarizeType);
        $form->setCreationDate($today);

        $this->entityManager->persist($form);
        $this->entityManager->flush();

        return $form->getId();

        }

    }
    
    
    public function setMediaData($data,$directory)
    {

        $today = new DateTimeImmutable();


        $filename=$_FILES["newmedia"]["name"];

            // Count total files
            $totalFiles = count($filename);


            // Loop through each file
            for($i=0; $i<$totalFiles; $i++) {

                
                $fileName =$_FILES["newmedia"]["name"][$i];


                $extension = pathinfo($fileName, PATHINFO_EXTENSION);

                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
                $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv'];

                if(in_array($extension, $imageExtensions)){

                    $mediaType = "image";
                    $namewithoutextension = str_replace(".".$extension, "", $_FILES["newmedia"]["name"][$i]);
                    $fileName =$namewithoutextension."_".$this->randomizeNumber().date("his").".".$extension;

                    $isvideo = FALSE;
                }

                elseif(in_array($extension, $videoExtensions)){

                    $mediaType = "video";
                    $isvideo = TRUE;
                    $namewithoutextension = str_replace(".".$extension, "", $_FILES["newmedia"]["name"][$i]);
                    $fileName =$namewithoutextension."_".$this->randomizeNumber().date("his").".".$extension;

                }

                else{

                    header('Location: '.$_SERVER['PHP_SELF']);
                    die;


                }
                            // Define your target directory
            $targetDir = $directory.$mediaType."/".$today->format('m-d-Y')."/";

            // Ensure that the target directory exists
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

                $targetFilePath = $targetDir ."/". $fileName;

                

                // Check if file is selected and then proceed to move it to the target directory
                if (!empty($_FILES["newmedia"]['name'])) {


                    // You can add more validations here (file size, file type, etc.)
                    if(move_uploaded_file($_FILES["newmedia"]['tmp_name'][$i], $targetFilePath)){

                        $link = "/cuid/media/".$mediaType."/".$today->format('m-d-Y')."/".$fileName;
                        $media=new CMSMedia();
                        $media->setName($fileName);
                        $media->setDateUploaded($today);
                        $media->setLink($link);
                        $media->setVideo($isvideo);
                        $this->entityManager->persist($media);
                        $this->entityManager->flush();

                         "The file ".$fileName. " has been uploaded.";

                    } else{
                       "Sorry, there was an error uploading your file.";

                    }
                }



            }

        


        

    }

    public function ExportFormData(){

        

        
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Assuming you get the HTML from a source, for example, a form submission
$htmlString = '<table><tr><th>Name</th><th>Email</th><th>Age</th></tr><tr><td>Alice</td><td>alice@example.com</td><td>30</td></tr><tr><td>Bob</td><td>bob@example.com</td><td>25</td></tr></table>';
$htmlString = trim(strip_tags($htmlString, '<table><tr><td><th>'));

// Load the HTML string into a DOMDocument
$dom = new \DOMDocument();
$dom->loadHTML($htmlString);

$table = $dom->getElementsByTagName('table')->item(0);
$rows = $dom->getElementsByTagName('tr');

// Parse each row of the table and add it to the spreadsheet
$excelRow = 1;
foreach ($rows as $row) {
    $cells = $row->getElementsByTagName('th');
    if ($cells->length == 0) {
        $cells = $row->getElementsByTagName('td');
    }

    $excelCol = 'A';
    foreach ($cells as $cell) {
        $sheet->setCellValue($excelCol.$excelRow, $cell->nodeValue);
        $excelCol++;
    }

    $excelRow++;
}

// Write an .xlsx file
$writer = new Xlsx($spreadsheet);

// Save the file to the server (you could also output directly to the browser)
$fileName = 'example.xlsx';
$writer->save($fileName);

echo 'Excel file has been generated successfully.';
    }

    public function setServiceData($data,$entity)
    {

        $notarize=$entity;

        $today = new DateTimeImmutable();

        $decision = $this->entityManager->getRepository(Decision::class)->find($data["decision"]);

        $notarize->setDecision($decision);


        $emailid = 5;

        if($decision->getId() == 1){

            $notarize->setCancelled(1);
            $emailid = 6;
        }

        if($decision->getId() == 3){

            $emailid = 7;

            if(isset($data["price"])){

                $notarize->setCost($data["price"]);
            }

        }



        $notarize->setCompanyComment($data["comment"]);



        $this->entityManager->persist($notarize);
        $this->entityManager->flush();

        if(isset($data["codeDocument"])){

            $servicedocument = new NotarizeDocument;

            $servicedocument->setCustomer($notarize->getCustomer());
            $servicedocument->setNotarizeType($notarize->getType());
            $servicedocument->setCode($data["codeDocument"]);
            $servicedocument->setDocumentId($data["documentId"]);
            $servicedocument->setSender("Service consulaire");
            $servicedocument->setSendDate($today);

            $this->entityManager->persist($servicedocument);
            $this->entityManager->flush();

            if($notarize->getType()->getId() == 7){

                $person = $notarize->getPerson();

                $person->setConsularCardId($data["documentId"]);

                $this->entityManager->persist($person);
                $this->entityManager->flush();

            }



            $emailmessage=$this->mailer->GetEmailNotarizeDocument($entity,$servicedocument);
        }else{

            $emailmessage=$this->mailer->GetEmailNotarize($entity);
        }



        $this->mailer->sendEmail($entity->getCustomer()->getEmail(), $emailid , $emailmessage);

        
    }

    public function uploadPhoto($link, $fileName, $person){


        if($person->getPhoto() == NULL){
        $photo = new Photo;
        $today = new DateTimeImmutable();

        }else{

            $photo = $person->getPhoto();
            $today = new DateTimeImmutable();

        }
        
        $photo->setName($fileName);
        $photo->setPerson($person);
        $photo->setDateUploaded($today);
        $photo->setLink($link);

        $this->entityManager->persist($photo);
        $this->entityManager->flush();

    }
    public function uploadDocument($link,$filename,$customer,$notarize){

        $document = new CMSDocument;
        $today = new DateTimeImmutable();

        $document->setNotarize($notarize);
        $document->setName($filename);
        $document->setDateUploaded($today);
        $document->setLink($link);

        $this->entityManager->persist($document);
        $this->entityManager->flush();

    }

    
    public function createNotarizeForCustomerFormData($documentlink,$customer,$code,$form)
    {

        $notarize=new Notarize;

        
        $notarize->setCustomer($customer);
        $dateTime = new DateTimeImmutable();
        
        $notarize->setDateCreation($dateTime);
        
        $notarize->setNumberId($code);
        $notarize->setState(1);
        $notarize->setPaid(FALSE);
        $notarize->setCancelled(FALSE);
        $decision =  $this->entityManager->getRepository(Decision::class)->find(2);
        $notarize->setDecision($decision);
        $notarize->setForm($form);

        if(isset($_POST["comment"])){

            $notarize->setComment($_POST["comment"]);

        }else{

            $notarize->setComment("Consultez ses informations");
        }

        $notarize->setType( $this->entityManager->getRepository(NotarizeType::class)->find($form->getNotarizeType()->getId()));



        $notarize->setdocument($documentlink);




        $this->entityManager->persist($notarize);
        $this->entityManager->flush();



        return $notarize;
        
    }
}