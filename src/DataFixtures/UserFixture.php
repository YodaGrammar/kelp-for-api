<?php
/**
 * Created by PhpStorm.
 * User: btaralle
 * Date: 17/04/2018
 * Time: 21:56.
 */

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserFixture.
 */
class UserFixture extends Fixture
{
    private const USER
        = [
            [
                'username' => 'admin',
                'fullName' => 'admini stration',
                'email' => 'admin@kelp.com',
                'roles' => ['ROLE_ADMIN'],
                'password' => 'admin',
            ],
            [
                'username' => 'user',
                'fullName' => 'user user',
                'email' => 'user@kelp.com',
                'roles' => ['ROLE_USER'],
                'password' => 'user', ],
        ];

    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    /**
     * UserFixture constructor.
     *
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        foreach (self::USER as $data) {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setUsername($data['username']);
            $user->setFullName($data['fullName']);
            $user->setRoles($data['roles']);
            $password = $this->passwordEncoder->encodePassword($user, $data['password']);
            $user->setPassword($password);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
