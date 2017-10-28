<?php

namespace AppBundle\Entity\Repository;

/**
 * PostCommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostCommentRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCommentsByPost($postId)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.post = :postId')
            ->addOrderBy('c.created', 'DESC')
            ->setParameter(':postId', $postId);

        return $qb->getQuery()
            ->getResult();
    }
}