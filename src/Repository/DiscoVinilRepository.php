<?php

namespace App\Repository;

use App\Entity\DiscoVinil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DiscoVinil>
 *
 * @method DiscoVinil|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiscoVinil|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiscoVinil[]    findAll()
 * @method DiscoVinil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiscoVinilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiscoVinil::class);
    }

    public function save(DiscoVinil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DiscoVinil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
    * @return DiscoVinil[] Returns an array of DiscoVinil objects
    */
    public function createOrderedByVotesQueryBuilder(string $genero = null): QueryBuilder
    {
       $queryBuilder = $this->addOrderByVotosQueryBuilder();

        if($genero){
            $queryBuilder->andWhere('disco.genero = :genero')
                ->setParameter('genero', $genero);
        }

        return $queryBuilder;
    }

    private function addOrderByVotosQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        $queryBuilder = $queryBuilder ?? $this->createQueryBuilder('disco');

        return $queryBuilder->orderBy('disco.votos', 'DESC');
    }

//    public function findOneBySomeField($value): ?DiscoVinil
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
