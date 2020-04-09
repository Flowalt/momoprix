<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    

    public function load(ObjectManager $manager)
    {

         // create 20 catégories! Bam!
         for ($i = 0; $i < 20; $i++) {
            $cat= new Category();
            $cat->setIdcategory($i);
            $cat->setName('cat'.$i);
            $manager->persist($cat);
        }

        // create 20 products! Bam!
        /*for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setPrice(mt_rand(10, 100));
            $product->setBarCode('code'.$i.'ghj');
            $product-> setUrl('ijk');
            $product->setCategoryIdcategory($ca);
            $manager->persist($product);
        }
*/
        $manager->flush();
    }

}