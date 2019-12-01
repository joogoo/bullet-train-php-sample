<?php
/**
 * Created by PhpStorm.
 * User: herve
 * Date: 30/11/2019
 * Time: 14:36
 */

namespace BulletTrain\Sample\Services;


use BulletTrain\Sample\Exception\AccessDeniedException;

class UserService
{
    /**
     * @var array
     */
    private $users;

    /**
     * UserService constructor.
     * @param array $users
     */
    public function __construct(array $users)
    {
        $this->users = $users;
    }

    /**
     * @param string $username
     * @param string $password
     * @return array
     * @throws AccessDeniedException
     */
    public function signIn(string $username, string $password)
    {
        if (! array_key_exists($username, $this->users)) {
            throw new AccessDeniedException('Invalid username or password');
        }

        if ($password !== $this->users[$username]) {
            throw new AccessDeniedException('Invalid username or password');
        }
        return [
            'signed_in' => true,
            'username' => $username
        ];
    }
}
