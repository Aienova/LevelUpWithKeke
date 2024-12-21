<?php

namespace App\Repository;

use App\Entity\CMSPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSPage>
 *
 * @method CMSPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSPage[]    findAll()
 * @method CMSPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSPage::class);
    }

//    /**
//     * @return CMSPage[] Returns an array of CMSPage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CMSPage
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


public function findByName(string $name): ?CMSPage
{

    return $this->createQueryBuilder('c')
            ->andWhere('c.name = :name')
            ->setParameter(':name', $name)
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }



    public function findByFilter($proprety,$value): array
   {
       return $this->createQueryBuilder('c')
           ->andWhere('c.'.$proprety.' like :prop')
            ->setParameter('prop', "%".$value."%")
           ->orderBy('c.id', 'ASC')
           ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
    }




}
