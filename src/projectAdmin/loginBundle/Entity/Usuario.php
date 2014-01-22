<?php

namespace projectAdmin\loginBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Usuario
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
    * @ORM\Column(name="nusuario", type="string", length=255 , nullable=true)
    */
    private $nusuario;
    
    /**
    * @var string
    * @ORM\Column(name="rol", type="string", length=255 , nullable=true)
    */
    private $rol;
    
    /**
    * @var string
    * @ORM\Column(name="contrasena", type="string", length=512 , nullable=true)
    */
    private $contrasena;
    


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
     * Set nusuario
     *
     * @param string $nusuario
     * @return Usuario
     */
    public function setNusuario($nusuario)
    {
        $this->nusuario = $nusuario;
    
        return $this;
    }

    /**
     * Get nusuario
     *
     * @return string 
     */
    public function getNusuario()
    {
        return $this->nusuario;
    }

    /**
     * Set rol
     *
     * @param string $rol
     * @return Usuario
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    
        return $this;
    }

    /**
     * Get rol
     *
     * @return string 
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set contrasena
     *
     * @param string $contrasena
     * @return Usuario
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    
        return $this;
    }

    /**
     * Get contrasena
     *
     * @return string 
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }
}