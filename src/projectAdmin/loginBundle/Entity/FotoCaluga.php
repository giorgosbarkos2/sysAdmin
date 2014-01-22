<?php

namespace projectAdmin\loginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FotoCaluga
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FotoCaluga
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
    * @ORM\ManyToOne(targetEntity="projectAdmin\loginBundle\Entity\Caluga", inversedBy="fotoCaluga")
    * @ORM\JoinColumn(name="caluga_id", referencedColumnName="id")
    *
    */
    
    
    
          
    private $caluga;


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
     * Set estado
     *
     * @param string $estado
     * @return FotoCaluga
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
     * @return FotoCaluga
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
     * Set caluga
     *
     * @param \projectAdmin\loginBundle\Entity\Caluga $caluga
     * @return FotoCaluga
     */
    public function setCaluga(\projectAdmin\loginBundle\Entity\Caluga $caluga = null)
    {
        $this->caluga = $caluga;
    
        return $this;
    }

    /**
     * Get caluga
     *
     * @return \projectAdmin\loginBundle\Entity\Caluga 
     */
    public function getCaluga()
    {
        return $this->caluga;
    }
}