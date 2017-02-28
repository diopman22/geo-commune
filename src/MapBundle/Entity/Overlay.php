<?php

namespace MapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Overlay
 *
 * @ORM\Table(name="overlay")
 * @ORM\Entity(repositoryClass="MapBundle\Repository\OverlayRepository")
 */
class Overlay
{

    /**
      * @ORM\ManyToOne(targetEntity="UtilisateursBundle\Entity\User")
    */
        private $user;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="infos", type="text", nullable=true)
     */
    private $infos;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=255)
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(name="lng", type="string", length=255)
     */
    private $lng;

    /**
     * @var array
     *
     * @ORM\Column(name="path", type="json_array")
     */
    private $path;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set infos
     *
     * @param string $infos
     *
     * @return Overlay
     */
    public function setInfos($infos)
    {
        $this->infos = $infos;

        return $this;
    }

    /**
     * Get infos
     *
     * @return string
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Overlay
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set path
     *
     * @param array $path
     *
     * @return Overlay
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return array
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set user
     *
     * @param \UtilisateursBundle\Entity\User $user
     *
     * @return Overlay
     */
    public function setUser(\UtilisateursBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UtilisateursBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set lat
     *
     * @param string $lat
     *
     * @return Overlay
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     *
     * @return Overlay
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }
}
