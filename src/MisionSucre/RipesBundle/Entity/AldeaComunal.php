<?php

namespace MisionSucre\RipesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sector
 *
 * @ORM\Table(name="aldea_comunal")
 * @ORM\Entity(repositoryClass="MisionSucre\RipesBundle\Entity\AldeaComunalRepository")
 */
class AldeaComunal
{   
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\ManyToOne(targetEntity="Aldea", inversedBy="aldeascomunales")
     * @ORM\JoinColumn(name="aldea_id", referencedColumnName="id")
     */
    protected $aldea;
    
    /**
     * @ORM\ManyToOne(targetEntity="Sector", inversedBy="aldeascomunales")
     * @ORM\JoinColumn(name="sector_id", referencedColumnName="id")
     */
    protected $sector;
        
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=70)
     */
    
    private $nombre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=80)
     */
    
    private $direccion;

    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return AldeaComunal
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set aldea
     *
     * @param \MisionSucre\RipesBundle\Entity\Aldea $aldea
     * @return AldeaComunal
     */
    public function setAldea(\MisionSucre\RipesBundle\Entity\Aldea $aldea = null)
    {
        $this->aldea = $aldea;

        return $this;
    }

    /**
     * Get aldea
     *
     * @return \MisionSucre\RipesBundle\Entity\Aldea 
     */
    public function getAldea()
    {
        return $this->aldea;
    }

    /**
     * Set sector
     *
     * @param \MisionSucre\RipesBundle\Entity\Sector $sector
     * @return AldeaComunal
     */
    public function setSector(\MisionSucre\RipesBundle\Entity\Sector $sector = null)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector
     *
     * @return \MisionSucre\RipesBundle\Entity\Sector 
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return AldeaComunal
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }
}
