<?php

namespace App\Repository;

use App\Entity\CMSDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSDocument>
 *
 * @method CMSDocument|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSDocument|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSDocument[]    findAll()
 * @method CMSDocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSDocument::class);
    }

//    /**
//     * @return CMSDocument[] Returns an array of CMSDocument objects
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

//    public function findOneBySomeField($value): ?CMSDocument
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
