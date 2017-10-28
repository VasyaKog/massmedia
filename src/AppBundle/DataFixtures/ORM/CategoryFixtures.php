<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;

class CategoryFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category1 = new Category();
        $category1->setName('A day with Symfony2');
        $category1->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');;
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName('The pool on the roof must have a leak');
        $category2->setDescription('Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Misdirection. What the eyes see and the ears hear, the mind believes');
        $category3->setDescription('Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $manager->persist($category3);

        $category4 = new Category();
        $category4->setName('The grid - A digital frontier');
        $category4->setDescription('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        $manager->persist($category4);

        $category5 = new Category();
        $category5->setName('You\'re either a one or a zero. Alive or dead');
        $category5->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $manager->persist($category5);

        $this->addReference('category-1', $category1);
        $this->addReference('category-2', $category2);
        $this->addReference('category-3', $category3);
        $this->addReference('category-4', $category4);
        $this->addReference('category-5', $category5);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

}
