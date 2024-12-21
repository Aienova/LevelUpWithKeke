<?php

namespace App\Repository;

use App\Entity\CMSfont;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSfont>
 *
 * @method CMSfont|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSfont|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSfont[]    findAll()
 * @method CMSfont[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSfontRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSfont::class);
    }

//    /**
//     * @return CMSfont[] Returns an array of CMSfont objects
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

//    public function findOneBySomeField($value): ?CMSfont
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function findByFont($name): ?CMSfont
{
return $this->createQueryBuilder('c')
->andWhere('c.name = :name')
->setParameter('name', $name)
->getQuery()
 ->getOneOrNullResult()
 ;
 }


}
