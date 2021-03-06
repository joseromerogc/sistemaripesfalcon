<?php

namespace MisionSucre\RipesBundle\Entity;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RoleRepository extends EntityRepository
{
    
    public function findAllOrderedByName($name)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT r.id, r.name FROM MisionSucreRipesBundle:Role r WHERE r.name NOT LIKE :name
                    ORDER BY r.name ASC'
            )->setParameter('name', $name)
            ->getResult();
    }
    
    public function findAllOrderedByRole($name)
    {
          return $this->getEntityManager()
            ->createQuery(
                "SELECT u.username, u.id,r.id AS idrole, r.name FROM MisionSucreRipesBundle:Role r, MisionSucreRipesBundle:User u 
                    WHERE r.name NOT LIKE :name AND r.id=u.tip_usr
                    ORDER BY r.name ASC"
            )->setParameter('name', $name)
            ->getResult();
    }
    
    public function findAllOrderedByRoleAndName()
    {
          return $this->getEntityManager()
            ->createQuery(
                "SELECT u.username, u.id,r.id AS idrole, r.name FROM MisionSucreRipesBundle:Role r, MisionSucreRipesBundle:User u 
                    WHERE r.id=u.tip_usr AND(
                            (u.tip_usr=8 AND EXISTS 
                            ( SELECT c FROM MisionSucreRipesBundle:CoordinadorEje c WHERE u.id=c.user)) OR
                            (u.tip_usr=5 AND EXISTS 
                            ( SELECT ca FROM MisionSucreRipesBundle:CoordinadorAldea ca WHERE u.id=ca.user)) OR
                            (u.tip_usr=6 AND EXISTS 
                            ( SELECT t FROM MisionSucreRipesBundle:Triunfador t WHERE u.id=t.user))
                            OR
                            (u.tip_usr=7 AND EXISTS 
                            ( SELECT d FROM MisionSucreRipesBundle:Docente d WHERE u.id=d.user)) OR
                            (u.tip_usr=9 AND EXISTS 
                            ( SELECT o FROM MisionSucreRipesBundle:Operario o WHERE u.id=o.user))
                            )
                            ORDER BY u.username
                            "
            )
            ->getResult();
    }
    
    public function findAllByRoleAndName($username,$role)
    {
          return $this->getEntityManager()
            ->createQuery(
                "SELECT u.username, u.id,r.id AS idrole, r.name FROM MisionSucreRipesBundle:Role r, MisionSucreRipesBundle:User u 
                    WHERE r.id=u.tip_usr AND u.username LIKE :username AND r.id=:role AND(
                            (u.tip_usr=8 AND EXISTS 
                            ( SELECT c FROM MisionSucreRipesBundle:CoordinadorEje c WHERE u.id=c.user)) OR
                            (u.tip_usr=5 AND EXISTS 
                            ( SELECT ca FROM MisionSucreRipesBundle:CoordinadorAldea ca WHERE u.id=ca.user)) OR
                            (u.tip_usr=6 AND EXISTS 
                            ( SELECT t FROM MisionSucreRipesBundle:Triunfador t WHERE u.id=t.user))
                            OR
                            (u.tip_usr=7 AND EXISTS 
                            ( SELECT d FROM MisionSucreRipesBundle:Docente d WHERE u.id=d.user)) OR
                            (u.tip_usr=9 AND EXISTS 
                            ( SELECT o FROM MisionSucreRipesBundle:Operario o WHERE u.id=o.user))
                            )
                            ORDER BY u.username
                            "
            )->setParameters(array('username'=>"%$username%",'role'=>$role))
            ->getResult();
    }
    
    public function findOneByRole($id)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT u.username, u.id, r.name FROM MisionSucreRipesBundle:Role r, MisionSucreRipesBundle:User u 
                    WHERE u.id = :id AND r.id=u.tip_usr
                    ORDER BY r.name ASC'
            )->setParameter('id', $id)
            ->getOneOrNullResult();
    }
        
}

