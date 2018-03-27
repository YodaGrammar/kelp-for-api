<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/02/2018
 * Time: 14:19
 */

namespace App\DataFixtures;

use App\Entity\Packaging;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TypeStorageFixture
 * @package App\DataFixtures
 */
class PackagingFixture extends Fixture
{
    const PACKAGING = [
        ['label' => 'Barquette'],
        ['label' => 'Unitaire'],
        ['label' => 'Conserve'],
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager):void
    {
        foreach (self::PACKAGING as $data) {
            $packaging = new Packaging();
            $packaging->setLabel($data['label']);
            $manager->persist($packaging);
        }
        $manager->flush();
    }
}
