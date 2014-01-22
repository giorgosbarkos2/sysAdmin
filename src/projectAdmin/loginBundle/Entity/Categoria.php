<?php

namespace projectAdmin\loginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Categoria
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
    * @var string
    * @ORM\Column(name="nombre", type="string", length=255 , nullable=true)
    */
    
    private $nombre;
    
    /**
    * @var string
    * @ORM\Column(name="departamento", type="string", length=255 , nullable=true)
    */
    
    private $departamento;
    
    /**
    * @var string
    * @ORM\Column(name="descripcion", type="string", length=400 , nullable=true)
    */
    
    private $descripcion;
    
    /**
    * @var string
    * @ORM\Column(name="descripcioncorta", type="string", length=255 , nullable=true)
    */

    private $descripcioncorta;
    
    /**
    * @var string
    * @ORM\Column(name="idioma", type="string", length=255 , nullable=true)
    */
    private $idioma;
    
   /**
    * @ORM\OneToMany(targetEntity="projectAdmin\loginBundle\Entity\Producto", mappedBy="categoria")
    */
    
    private $producto;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->producto = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @return Categoria
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
     * Set departamento
     *
     * @param string $departamento
     * @return Categoria
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    
        return $this;
    }

    /**
     * Get departamento
     *
     * @return string 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Categoria
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set descripcioncorta
     *
     * @param string $descripcioncorta
     * @return Categoria
     */
    public function setDescripcioncorta($descripcioncorta)
    {
        $this->descripcioncorta = $descripcioncorta;
    
        return $this;
    }

    /**
     * Get descripcioncorta
     *
     * @return string 
     */
    public function getDescripcioncorta()
    {
        return $this->descripcioncorta;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     * @return Categoria
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;
    
        return $this;
    }

    /**
     * Get idioma
     *
     * @return string 
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Add producto
     *
     * @param \projectAdmin\loginBundle\Entity\Producto $producto
     * @return Categoria
     */
    public function addProducto(\projectAdmin\loginBundle\Entity\Producto $producto)
    {
        $this->producto[] = $producto;
    
        return $this;
    }

    /**
     * Remove producto
     *
     * @param \projectAdmin\loginBundle\Entity\Producto $producto
     */
    public function removeProducto(\projectAdmin\loginBundle\Entity\Producto $producto)
    {
        $this->producto->removeElement($producto);
    }

    /**
     * Get producto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducto()
    {
        return $this->producto;
    }
}