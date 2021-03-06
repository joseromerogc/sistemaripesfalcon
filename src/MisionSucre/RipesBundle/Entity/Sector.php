<?php

namespace MisionSucre\RipesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sector
 *
 * @ORM\Table(name="sector")
 * @ORM\Entity
 */
class Sector
{
     /**
     * @ORM\ManyToOne(targetEntity="Parroquia", inversedBy="sectores")
     * @ORM\JoinColumn(name="parroquia_id", referencedColumnName="id")
     */
    protected $parroquia;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=70, nullable=false)
     */
    
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="UbicacionVivienda", mappedBy="sector")
     */
    protected $ubicaciones;
    
    /**
     * @ORM\OneToMany(targetEntity="AldeaComunal", mappedBy="sector")
     */
    protected $aldeascomunales;
    
    /**
     * @ORM\OneToMany(targetEntity="AnexoAldea", mappedBy="sector")
     */
    protected $anexos;
    
    
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
     * Set parroquia
     *
     * @param \MisionSucre\RipesBundle\Entity\Parroquia $parroquia
     * @return Sector
     */
    public function setParroquia(\MisionSucre\RipesBundle\Entity\Parroquia $parroquia = null)
    {
        $this->parroquia = $parroquia;

        return $this;
    }

    /**
     * Get parroquia
     *
     * @return \MisionSucre\RipesBundle\Entity\Parroquia 
     */
    public function getParroquia()
    {
        return $this->parroquia;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Sector
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
     * Add aldeascomunales
     *
     * @param \MisionSucre\RipesBundle\Entity\AldeaComunal $aldeascomunales
     * @return Sector
     */
    public function addAldeascomunale(\MisionSucre\RipesBundle\Entity\AldeaComunal $aldeascomunales)
    {
        $this->aldeascomunales[] = $aldeascomunales;

        return $this;
    }

    /**
     * Remove aldeascomunales
     *
     * @param \MisionSucre\RipesBundle\Entity\AldeaComunal $aldeascomunales
     */
    public function removeAldeascomunale(\MisionSucre\RipesBundle\Entity\AldeaComunal $aldeascomunales)
    {
        $this->aldeascomunales->removeElement($aldeascomunales);
    }

    /**
     * Get aldeascomunales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAldeascomunales()
    {
        return $this->aldeascomunales;
    }

    /**
     * Add anexos
     *
     * @param \MisionSucre\RipesBundle\Entity\AnexoAldea $anexos
     * @return Sector
     */
    public function addAnexo(\MisionSucre\RipesBundle\Entity\AnexoAldea $anexos)
    {
        $this->anexos[] = $anexos;

        return $this;
    }

    /**
     * Remove anexos
     *
     * @param \MisionSucre\RipesBundle\Entity\AnexoAldea $anexos
     */
    public function removeAnexo(\MisionSucre\RipesBundle\Entity\AnexoAldea $anexos)
    {
        $this->anexos->removeElement($anexos);
    }

    /**
     * Get anexos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnexos()
    {
        return $this->anexos;
    }
}
