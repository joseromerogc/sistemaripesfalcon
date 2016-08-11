<?php

namespace MisionSucre\RipesBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CoordinadoAldeaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CoordinadoAldeaRepository extends EntityRepository
{
    public function findAllOrderedByUser()
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT u.id, u.username FROM MisionSucreRipesBundle:User u WHERE u.tip_usr=5  AND 
                    NOT EXISTS
                   ( SELECT a FROM MisionSucreRipesBundle:CoordinadorAldea a WHERE u.id=a.user) 
                '
            )
            ->getResult();
    }
    public function findAllOrderedById()
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT u.id,u.username,p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.sexPer, a.nombre,
                    c.turno
                    FROM MisionSucreRipesBundle:Persona p, MisionSucreRipesBundle:User u,
                    MisionSucreRipesBundle:CoordinadorAldea c JOIN c.aldea a
                    WHERE p.user=u.id AND c.user=u.id
                '
            )
            ->getResult();
    }
    
    public function findAllOrderedByAldea($aldea)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT u.id,u.username,p.priNom,p.segNom, p.priApe, p.segApe, p.cedPer, p.codCed,p.celPer,p.telPer, c.id as cid
                    FROM MisionSucreRipesBundle:Persona p, MisionSucreRipesBundle:User u,
                    MisionSucreRipesBundle:CoordinadorAldea c JOIN c.aldea a
                    WHERE p.user=u.id AND c.user=u.id AND c.aldea=:aldea 
                '
            )
            ->setParameter('aldea',$aldea)
            ->getResult();
    }
    
    public function findCoordinadorAldeaByUserAndId($aldea,$user)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM MisionSucreRipesBundle:CoordinadorAldea c
                    WHERE c.user=:user AND c.aldea=:aldea
                '
            )
            ->setParameters(array('user'=>$user,'aldea'=>$aldea))->getSingleResult();
    }
    
    public function findAllByAldea($aldea)
    {
          return $this->getEntityManager()
            ->createQuery(
                "SELECT u.username, u.id,r.id AS idrole, r.name FROM MisionSucreRipesBundle:Role r, MisionSucreRipesBundle:User u 
                    WHERE r.id=u.tip_usr AND(
                            (u.tip_usr=6 AND EXISTS ( SELECT t FROM MisionSucreRipesBundle:Triunfador t JOIN t.ambiente am
                            WHERE u.id=t.user AND am.aldea =:aldea ))
                            OR
                            (u.tip_usr=7 AND EXISTS 
                            ( SELECT d FROM MisionSucreRipesBundle:Docente d
                            WHERE u.id=d.user AND d.aldea =:aldea )) OR
                            (u.tip_usr=9 AND EXISTS 
                            ( SELECT o FROM MisionSucreRipesBundle:Operario o
                            WHERE u.id=o.user AND o.aldea =:aldea))
                            )
                            ORDER BY u.username
                        "
            )
            ->setParameter('aldea',$aldea)      
            ->getResult();
    }
    public function findAllByAldeaAndUser($aldea,$username,$role)
    {
          return $this->getEntityManager()
            ->createQuery(
                "SELECT u.username, u.id,r.id AS idrole, r.name FROM MisionSucreRipesBundle:Role r, MisionSucreRipesBundle:User u 
                    WHERE r.id=u.tip_usr AND u.username LIKE :username AND r.id=:role AND(
                            (u.tip_usr=6 AND EXISTS ( SELECT t FROM MisionSucreRipesBundle:Triunfador t JOIN t.ambiente am
                            WHERE u.id=t.user AND am.aldea =:aldea ))
                            OR
                            (u.tip_usr=7 AND EXISTS 
                            ( SELECT d FROM MisionSucreRipesBundle:Docente d
                            WHERE u.id=d.user AND d.aldea =:aldea )) OR
                            (u.tip_usr=9 AND EXISTS 
                            ( SELECT o FROM MisionSucreRipesBundle:Operario o
                            WHERE u.id=o.user AND o.aldea =:aldea))
                            )
                            ORDER BY u.username
                        "
            )
            ->setParameters(array('aldea' => $aldea,'username'=>"%$username%",'role'=>$role ))      
            ->getResult();
    }
}
