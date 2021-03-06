<?php

namespace AppBundle\Entity\Repository;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{
    public function getPosts($categoryId, $limit = null)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.category = :categoryId')
            ->addOrderBy('b.created_at', 'DESC')
            ->setParameter('categoryId', $categoryId);

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
            ->getResult();
    }
}
