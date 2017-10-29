<?php

namespace AppBundle\Service;

use AppBundle\Entity\Session;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;


class DoctrineSessionHandler implements \SessionHandlerInterface
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var  RequestStack */
    protected $requestStack;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        $this->entityManager->flush();
        return true;
    }

    /**
     * @inheritDoc
     */
    public function destroy($session_id)
    {
        return $this->getRepository()->destroy($session_id);
    }

    /**
     * @inheritDoc
     */
    public function gc($maxlifetime)
    {
        $this->getRepository()->purge();
        return true;
    }

    /**
     * @inheritDoc
     */
    public function open($save_path, $session_id)
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function read($session_id)
    {
        $session = $this->getSession($session_id);
        if (!$session || is_null($session->getSessionData())) {
            return '';
        }
        $resource = $session->getSessionData();
        return is_resource($resource) ? stream_get_contents($resource) : $resource;
    }

    /**
     * @inheritDoc
     */
    public function write($session_id, $session_data)
    {
        $browser = $this->getBrowser();
        $ip = $this->requestStack->getCurrentRequest()->getClientIp();
        $maxlifetime = (int)ini_get('session.gc_maxlifetime');
        $now = new \DateTime();
        $enfOfLife = new \DateTime();
        $enfOfLife->add(new \DateInterval('PT' . $maxlifetime . 'S'));
        $session = $this->getSession($session_id);
        $session->setSessionData($session_data);
        $session->setBrowser($browser);
        $session->setIp($ip);
        $session->setUpdatedAt($now);
        $session->setEndOfLife($enfOfLife);
        $this->entityManager->persist($session);
        $this->entityManager->flush();
        return true;
    }

    protected function getRepository()
    {
        return $this->entityManager->getRepository('AppBundle:Session');
    }

    /**
     * @param $session_id
     *
     * @return Session
     */
    protected function newSession($session_id)
    {
        $className = $this->getRepository()->getClassName();
        /** @var Session $session */
        $session = new $className;
        $session->setSessionId($session_id);
        return $session;
    }

    /**
     * @param $session_id
     *
     * @return Session
     */
    protected function getSession($session_id)
    {
        $session = $this->getRepository()->findOneBy([
            'sessionId' => $session_id
        ]);
        if (!$session) {
            $session = $this->newSession($session_id);
        }
        return $session;
    }

    public function getBrowser()
    {
        $user_agent = $_SERVER["HTTP_USER_AGENT"];
        if (strpos($user_agent, "Firefox") !== false) return "Firefox";
        if (strpos($user_agent, "Opera") !== false) return "Opera";
        if (strpos($user_agent, "Chrome") !== false) return "Chrome";
        if (strpos($user_agent, "MSIE") !== false) return "Internet Explorer";
        if (strpos($user_agent, "Safari") !== false) return "Safari";
        return "Undefined";
    }
}