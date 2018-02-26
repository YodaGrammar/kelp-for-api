<?php
/**
 * Created by PhpStorm.
 * User: b.tarall
 * Date: 26/02/2018
 * Time: 14:19
 */

namespace App\DataFixtures;

use App\Entity\TypeStorage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TypeStorageFixture
 * @package App\DataFixtures
 */
class TypeStorageFixture extends Fixture
{
    const TYPE_STORAGE = [
        ['label' => 'Froid', 'class' => 'primary', 'comment' => ' '],
        ['label' => 'Frais', 'class' => 'info', 'comment' => ' '],
        ['label' => 'Sec', 'class' => 'light', 'comment' => ' '],
        ['label' => 'Vin', 'class' => 'danger', 'comment' => ' ']
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager):void
    {
        foreach (self::TYPE_STORAGE as $data) {
            $typeStorage = new TypeStorage();
            $typeStorage->setLabel($data['label']);
            $typeStorage->setClass($data['class']);
            $typeStorage->setComment($data['comment']);
            $manager->persist($typeStorage);
        }
        $manager->flush();
    }

}