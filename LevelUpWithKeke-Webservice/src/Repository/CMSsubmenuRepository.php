<?php

namespace App\Repository;

use App\Entity\CMSsubmenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSsubmenu>
 *
 * @method CMSsubmenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSsubmenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSsubmenu[]    findAll()
 * @method CMSsubmenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSsubmenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSsubmenu::class);
    }

//    /**
//     * @return CMSsubmenu[] Returns an array of CMSsubmenu objects
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

//    public function findOneBySomeField($value): ?CMSsubmenu
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }




   public function findByMenu($menu): array
   {
       return $this->createQueryBuilder('c')
          ->andWhere('c.CMSmenu = :menu')
           ->setParameter('menu', $menu)
           ->orderBy('c.id', 'ASC')
           ->setMaxResults(10)
           ->getQuery()
            ->getResult()
       ;
    }


}
