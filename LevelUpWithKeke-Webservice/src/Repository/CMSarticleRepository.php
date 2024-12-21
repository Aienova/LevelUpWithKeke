<?php

namespace App\Repository;

use App\Entity\CMSarticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSarticle>
 *
 * @method CMSarticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSarticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSarticle[]    findAll()
 * @method CMSarticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSarticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSarticle::class);
    }

//    /**
//     * @return CMSarticle[] Returns an array of CMSarticle objects
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

//    public function findOneBySomeField($value): ?CMSarticle
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


public function findByName(string $name): ?CMSarticle
{

    return $this->createQueryBuilder('a')
            ->andWhere('a.name = :name')
            ->setParameter(':name', $name)
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    public function findByFilter($proprety,$value): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.'.$proprety.' like :prop')
             ->setParameter('prop', "%".$value."%")
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
     }



}
