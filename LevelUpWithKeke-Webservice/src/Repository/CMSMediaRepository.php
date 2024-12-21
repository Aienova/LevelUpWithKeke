<?php

namespace App\Repository;

use App\Entity\CMSMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSMedia>
 *
 * @method CMSMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSMedia[]    findAll()
 * @method CMSMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSMediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSMedia::class);
    }

//    /**
//     * @return CMSMedia[] Returns an array of CMSMedia objects
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

//    public function findOneBySomeField($value): ?CMSMedia
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


public function findByFilter($proprety,$value,$decision): array
{

    return $this->createQueryBuilder('c')
    ->join('c.CMSGallery', 'gal')
    ->andWhere($proprety.' like :prop')
     ->setParameter('prop', "%".$value."%")
    ->orderBy('b.id', 'ASC')
    ->getQuery()
    ->getResult()
;

}
}
