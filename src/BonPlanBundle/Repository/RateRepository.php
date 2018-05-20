<?php
/**
 * Created by PhpStorm.
 * User: firas
 * Date: 04/05/2018
 * Time: 21:38
 */

namespace BonPlanBundle\Repository;
use Doctrine\ORM\EntityRepository;


class RateRepository extends EntityRepository
{

    public function Rate($user)
    {
        $qb = $this->createQueryBuilder('o');

        $qb->select('AVG(o.rating) as rate')
            ->where('o.userPlan= :user_iduser1')

            ->setParameter(':user_iduser1',$user);
        return $qb->getQuery()->getResult();
    }

}