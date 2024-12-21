<?php

namespace App\Repository;

use App\Entity\Form;
use App\Entity\FormStep;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormStep>
 *
 * @method FormStep|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormStep|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormStep[]    findAll()
 * @method FormStep[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormStepRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormStep::class);
    }

//    /**
//     * @return FormStep[] Returns an array of FormStep objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FormStep
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

   public function findByForm($form): array
     {
      return $this->createQueryBuilder('f')
     ->andWhere('f.form = :form')
     ->setParameter('form', $form)
     ->getQuery()
     ->getResult()
         ;
    }
}
