<?php

namespace AppBundle\Entity\Repository;

/**
 * CategoryCommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryCommentRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCommentsByCategory($categoryId)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.category = :categoryId')
            ->addOrderBy('c.created', 'DESC')
            ->setParameter(':categoryId', $categoryId);

        return $qb->getQuery()
            ->getResult();
    }
}