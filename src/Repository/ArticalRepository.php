<?php

namespace App\Repository;

use App\Entity\Artical;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Artical>
 *
 * @method Artical|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artical|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artical[]    findAll()
 * @method Artical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artical::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Artical $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Artical $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function findEventByValue($value){


        $query=$this->createQueryBuilder('a')
            ->select('c', 'a')
            ->join('a.category','c')
            ->andWhere('a.title LIKE :sujet  or c.nameCategory LIKE :sujet ')
            //->andWhere('e.Title LIKE :sujet or e.Category Like :sujet  or c.Nom Like :sujet')

            ->setParameter('sujet', '%'.$value.'%');
        return $query->getQuery()->getResult();
    }













    // /**
    //  * @return Artical[] Returns an array of Artical objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Artical
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
