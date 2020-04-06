<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setPrice(mt_rand(10, 100));
            $product->setBarCode('code'.$i.'ghj');
            $product-> setUrl('https://mobile-cdn.123rf.com/300wm/alexraths/alexraths1608/alexraths160800026/61925602-assortiment-de-fruits-et-l%C3%A9gumes-frais.jpg?ver=6');
            $manager->persist($product);
        }

        $manager->flush();
    }
}
