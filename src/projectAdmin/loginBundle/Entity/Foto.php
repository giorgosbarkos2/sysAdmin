<?php

namespace projectAdmin\loginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Foto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Foto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /** @ORM\Column(type="datetime") */
    
    private $fecha;
    
    /**
    * @var string
    *
    * @ORM\Column(name="estado", type="string", length=100 , nullable=true)
    */
    
    private $estado;
    
    /**
    * @var string
    *
    * @ORM\Column(name="url", type="string", length=100 , nullable=true)
    */

    private $url;
    
    /**
    * @ORM\ManyToOne(targetEntity="projectAdmin\loginBundle\Entity\Producto", inversedBy="foto")
    * @ORM\JoinColumn(name="producto_id", referencedColumnName="id")
    *
    */
    
    
    
          
    private $producto;


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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Foto
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Foto
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Foto
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set producto
     *
     * @param \projectAdmin\loginBundle\Entity\Producto $producto
     * @return Foto
     */
    public function setProducto(\projectAdmin\loginBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return \projectAdmin\loginBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }
}