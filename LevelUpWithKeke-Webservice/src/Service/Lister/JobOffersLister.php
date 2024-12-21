<?php

namespace App\Service\Lister;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\JobOffer;
use App\Entity\Job;
use App\Repository\JobRepository;
use App\Repository\AppliedJobRepository;
use App\Repository\JobOfferRepository;
use App\Service\Executer\Executer;

class JobOffersLister
{

    private $jobofferrepository;
    private $appliedjobpository;


    public function __construct(

        JobOfferRepository $jobofferrepository,
        AppliedJobRepository $appliedjobpository,

        
        )
    {
        $this->jobofferrepository = $jobofferrepository;
        $this->appliedjobpository = $appliedjobpository;

    }

    public function listJobOffersByCompany(int $companyid)  {

        $joboffer = $this->jobofferrepository->findJobOfferByCompany($companyid);

        $result=$joboffer;

        return $result;
    }


    public function listJobOffersByJob(Job $job)  {

        $joboffer = $this->jobofferrepository->findJobOfferByJob($job);

        $result=$joboffer;

        return $result;
    }


    

    public function listJobOffersByRecruiterSearchEngine(int $companyid, string $title, int $contractype, string $city, float $wage)  {

        $joboffer = $this->jobofferrepository->findJobOffersByRecruiterSearchEngine($companyid,$title,$contractype,$city,$wage);

        $result=$joboffer;

        return $result;
    }

    public function listJobOffersByCandidateSearchEngine(string $title, int $contractype, string $city, float $wage)  {

        $joboffer = $this->jobofferrepository->findJobOffersByCandidateSearchEngine($title,$contractype,$city,$wage);

        $result=$joboffer;

        return $result;
    }


    



    /*

    public function listCandidateByJobApplied(int $jobOfferid)  {

        $appliedJob = $this->appliedjobpository->findCandidateByJobOffer($jobOfferid);
        $jobofferlist = array(Null);

        for($i=0; $i<sizeof($appliedJob);$i++){

            $joboffer = $this->candidaterepository->find($appliedJob[$i]['candidateId']);
            $jobofferlist[$i] = $joboffer;

        }


        return $jobofferlist;
    } */
}
