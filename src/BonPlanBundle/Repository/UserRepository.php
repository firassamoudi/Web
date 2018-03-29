<?php

namespace BonPlanBundle\Repository;
use BonPlanBundle\Entity\User;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function findDescription($description)
    {
        $q=$this->createQueryBuilder('p')
            ->where('p.description LIKE :description')
            ->setParameter(':description',"%$description%");
        return $q->getQuery()->getResult();
    }
    public function findRole($role)
    {

        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
            ->from($this->User, 'u')
            ->where('u.roles LIKE "ROLE_PROP"')
            ->setParameter('roles', '%"'.$role.'"%');

        return $qb->getQuery()->getResult();
    }

}
