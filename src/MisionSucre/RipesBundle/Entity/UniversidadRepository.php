<?php

namespace MisionSucre\RipesBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UniversidadRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UniversidadRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy(array(), array('nombre' => 'ASC'));
    }
}
