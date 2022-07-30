<?php

namespace App\Repository;

use App\Entity\GeographicCoordinate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GeographicCoordinate>
 *
 * @method GeographicCoordinate|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeographicCoordinate|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeographicCoordinate[]    findAll()
 * @method GeographicCoordinate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeographicCoordinateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeographicCoordinate::class);
    }

    public function add(GeographicCoordinate $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GeographicCoordinate $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GeographicCoordinate[] Returns an array of GeographicCoordinate objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GeographicCoordinate
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
