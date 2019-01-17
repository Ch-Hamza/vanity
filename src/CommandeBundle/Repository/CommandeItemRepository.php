<?php

namespace CommandeBundle\Repository;

/**
 * CommandeItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommandeItemRepository extends \Doctrine\ORM\EntityRepository
{
    public function findMostWanted()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('i')
            ->from($this->_entityName, 'i')
            ->addSelect('SUM(i.quantity) AS s')
            ->groupBy('i.product')
            ->orderBy('s', 'DESC')
            ->setMaxResults(6)
        ;
        return $qb->getQuery()->getResult();
    }
}