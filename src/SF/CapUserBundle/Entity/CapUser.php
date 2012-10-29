<?php
namespace SF\CapUserBundle\Entity;

use SF\CapBundle\Entity\CapRunner;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="CapUser")
 */
class CapUser extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @ORM\OneToOne(targetEntity="SF\CapBundle\Entity\CapRunner")
     * @ORM\JoinColumn(name="runner_id", referencedColumnName="id")
     */
    protected $runner;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(message="Please enter your lastname.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The lastname is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="255", message="The lastname is too long.", groups={"Registration", "Profile"})     
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\MaxLength(limit="255", message="The firstname is too long.", groups={"Registration", "Profile"})     
     */
    protected $firstname;




    /**
     * Set firstname
     *
     * @param string $salt
     * @return CapUser
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Set lastname
     *
     * @param string $salt
     * @return CapUser
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    /**
     * Set runner
     *
     * @param SF\CapBundle\Entity\CapRunner $runner
     * @return Sortie
     */
    public function setRunner(\SF\CapBundle\Entity\CapRunner $runner = null)
    {
        $this->runner = $runner;
    
        return $this;
    }

    /**
     * Get runner
     *
     * @return SF\CapBundle\Entity\CapRunner 
     */
    public function getRunner()
    {
        return $this->runner;
    }

    
}