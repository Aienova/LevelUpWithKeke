<?php

namespace App\Service\Algob;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Candidate;
use App\Entity\JobOffer;
use App\Entity\Skill;
use App\Repository\CandidateRepository;
use App\Repository\JobOfferRepository;
use App\Repository\ApplicationRepository;
use App\Repository\SkillRepository;

class Algob
{

    private $candidaterepository;
    private $jobofferrepository;
    private $applicationRepository;
    private $skillRepository;

    public function __construct(

        CandidateRepository $candidaterepository,
        JobOfferRepository $jobofferrepository,
        ApplicationRepository $applicationRepository,
        SkillRepository $skillRepository,
        
        )
    {
        $this->candidaterepository = $candidaterepository;
        $this->jobofferrepository = $jobofferrepository;
        $this->applicationRepository = $applicationRepository;
        $this->skillRepository = $skillRepository;
    }

    public function compatibility(Candidate $candidate, JobOffer $joboffer)
    {


        /*--------------ALGOB 1 : Check if Candidate and JobOffer Job are equivalent ----------------------*/

        $candidatejob=$candidate->getJob();
        $jobofferjob=$joboffer->getJob();

        if($candidatejob==$jobofferjob){

            $algob1=10;
            
        }else{

            $algob1=0;
        }


         /*--------------ALGOB 2 : Check if Candidate and JobOffer JobTitle are equivalent ----------------------*/

         $candidatejobtitle=$candidate->getJobTitle();
         $joboffertitle=$joboffer->getTitle();
 
         function haveEquivalentWord($string1, $string2) {
            $words1 = explode(' ', $string1);
            $words2 = explode(' ', $string2);
        
            $commonWords = array_intersect($words1, $words2);
        
            return !empty($commonWords);
        }

        $checktitle = haveEquivalentWord($candidatejobtitle, $joboffertitle);


         if($checktitle){

            $algob2=10;
            
        }else{

            $algob2=0;
        }



         /*--------------ALGOB 3 : Check if Candidate and JobOffer Skillsname and SkillsExp are equivalent ----------------------*/
        
         $candidateskills = $this->skillRepository->findByCandidate($candidate);
         $jobofferskills = $this->skillRepository->findByJobOffer($joboffer);
         $min=count($jobofferskills)/2;
         $max=count($jobofferskills);


         if($min>2){

            $min=1;
         }
        
         foreach ($candidateskills as $candidateskill) {


            $checkskill = $this->skillRepository->findByCandidateSkillNameANDExpCompareWithJobOffer($candidateskill->getSkillName(),$candidateskill->getSkillExp(),$joboffer);

         }

         $counter=count($checkskill);

         if( $counter <= 0){

            $algob3=0;
            
        }

        if( $counter > 0 && $counter < $min ){

            $algob3=10;

            }
        
        if($counter >= $min && $counter < $max ){

            $algob3=20;
    
            }


            if($counter >= $max ){

                $algob3=40;
        
                }

        
                 /*--------------ALGOB 4 : Check if Candidate and JobOffer licence are equivalent ----------------------*/

                 $candidatelicencelevel = $candidate->getLicence()->getLevel();
                 $jobofferlicencelevel = $joboffer->getLicence()->getLevel();

            if($candidatelicencelevel>=$jobofferlicencelevel){

                $algob4=30;

            }

            if($candidatelicencelevel==$jobofferlicencelevel-1){

                $algob4=15;

            }

            if($candidatelicencelevel < $jobofferlicencelevel-1){

                $algob4=0;

            }


          /*--------------ALGOB 5 : Check if Candidate and JobOffer location are closer ----------------------*/

          $candidatelicencelevel = $candidate->getLocation();
          $jobofferlicencelevel = $joboffer->getLocation();

          /*---USE GOOGLE CLOUD MPA CONSOLE---*/



        $result=$algob1+$algob2+$algob3+$algob4;


        return $result;
    }
}
