<?php

namespace AppBundle\Entity\Repository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCommentsByPost($postId)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.post_id = :postId')
            ->addOrderBy('c.created',SORT_DESC)
            ->setParameter('post_id', $postId);

        return $qb->getQuery()
            ->getResult();
    }

}
