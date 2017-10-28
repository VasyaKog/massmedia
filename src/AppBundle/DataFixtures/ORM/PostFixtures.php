<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.10.2017
 * Time: 0:17
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class PostFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $post = new Post();
        $post->setName('Hello');
        $post->setContent('nach');
        $post->setFile('');
        $post->setCategory($manager->merge($this->getReference('category-1')));
        $manager->persist($post);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}