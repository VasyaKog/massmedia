<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SessionRepository")
 * @ORM\Table(name="symfony_session")
 * */
class Session
{
    /**
     * @ORM\Column(type="bigint", options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $sessionId;
    /**
     * @var mixed
     * @ORM\Column(type="blob", nullable=true)
     */
    protected $sessionData;
    /**
     * @var mixed
     * @ORM\Column(type="string")
     */
    protected $ip;
    /**
     * @var mixed
     * @ORM\Column(type="string")
     */
    protected $browser;
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $endOfLife;

    /**
     *
     */
    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id = null)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return mixed
     * @deprecated
     */
    public function getData()
    {
        return $this->getSessionData();
    }

    /**
     * @param mixed $data
     *
     * @deprecated
     */
    public function setData($data)
    {
        $this->setSessionData($data);
    }

    /**
     * @return mixed
     */
    public function getSessionData()
    {
        return $this->sessionData;
    }

    /**
     * @param mixed $sessionData
     */
    public function setSessionData($sessionData)
    {
        $this->sessionData = $sessionData;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * @param mixed $browser
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;
    }



    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getEndOfLife()
    {
        return $this->endOfLife;
    }

    /**
     * @param \DateTime $endOfLife
     */
    public function setEndOfLife(\DateTime $endOfLife)
    {
        $this->endOfLife = $endOfLife;
    }
}
