<?php

namespace App\Repository;

use App\Entity\CMSgallery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSgallery>
 *
 * @method CMSgallery|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSgallery|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSgallery[]    findAll()
 * @method CMSgallery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSgalleryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSgallery::class);
    }

//    /**
//     * @return CMSgallery[] Returns an array of CMSgallery objects
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

//    public function findOneBySomeField($value): ?CMSgallery
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findByTag($tag): ?CMSgallery
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.tag = :tag')
            ->setParameter('tag', $tag)
           ->getQuery()
           ->getOneOrNullResult()
        ;
    }


}
