<?php
/**
 * Created by PhpStorm.
 * User: meyss
 * Date: 11/04/2018
 * Time: 02:22
 */

namespace BonPlanBundle\Repository;


class ParticipationRepository extends \Doctrine\ORM\EntityRepository
{
    /*public function findByUserEvent($user,$event)
    { $qb = $this
        ->createQueryBuilder('p');

        $qb->innerJoin('p.user_iduser', 'userIduser')
            ->addSelect('id');

        $qb->innerJoin('p.Events_idEvents', 'eventsIdevents')
            ->addSelect('eventsIdevents');

        $qb->where('as.advert_id : id')
            ->setParameter('id', $user);
        $qb->where('as.advert_id : id')
            ->setParameter('id', $id);

        return ($qb->getQuery()->getResult());

    }*/
}