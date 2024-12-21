<?php

namespace App\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\Repository\PersonRepository;
use App\Repository\CMSgalleryRepository;
use DateTime;
use Exception;

class TwigFunctions extends AbstractExtension
{
    private $personRepository;
    private $cmsgalleryRepository;

    public function __construct(PersonRepository $personRepository, CMSgalleryRepository $cmsgalleryRepository)
    {
        $this->personRepository = $personRepository;
        $this->cmsgalleryRepository = $cmsgalleryRepository;
    }


    public function getFunctions()
    {
        return [
            new TwigFunction('getPersonValue', [$this, 'getPersonValue']),
            new TwigFunction('isStockedInThisgallery', [$this, 'isStockedInThisgallery']),
        ];
    }

    public function getPersonValue($theperson, $column)
    {


        if($theperson == NULL ){

            return NULL;

        }else{

            $person = $this->personRepository->find($theperson->getId());

            if (!$person) {
                throw new \InvalidArgumentException("Person with ID ".$theperson->getId()." not found");
            }
    



            if($column == "criminalRecord" ){

                $method = 'is' . ucfirst($column);

            }else{

                $method = 'get' . ucfirst($column);
            }






            if (!method_exists($person, $method) ) {

                throw new \InvalidArgumentException("Method $method not found in Person class");
            }
    
            $value = $person->$method();
    
            if (is_object($value)) {

                if(is_a($value, 'DateTime') || is_a($value, 'DateTimeImmutable')){

                    $value = $value->format('Y-m-d');

                }else{

                    $value = $value->getId();
                }

            }


    
            return $value;
        }


        }


        public function isStockedInThisgallery($gallery, $image)
        {


            $pictures = $gallery->getPictures();

            foreach($pictures  as  $picture){

                if($picture->getId() == $image){

                    return true;
                }


            }

            return false;
            


        }

}