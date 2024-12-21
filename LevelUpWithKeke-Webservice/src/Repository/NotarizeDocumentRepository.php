<?php

namespace App\Repository;

use App\Entity\NotarizeDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NotarizeDocument>
 *
 * @method NotarizeDocument|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotarizeDocument|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotarizeDocument[]    findAll()
 * @method NotarizeDocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotarizeDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotarizeDocument::class);
    }

//    /**
//     * @return NotarizeDocument[] Returns an array of NotarizeDocument objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NotarizeDocument
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


    public function findByCodeAndDocumentId($code,$documentId): array
    {
       return $this->createQueryBuilder('n')
           ->andWhere('n.code = :code')
           ->andWhere('n.documentId = :documentId')
           ->setParameter('code', $code)
           ->setParameter('documentId', $documentId)
           ->orderBy('n.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
    }

}
