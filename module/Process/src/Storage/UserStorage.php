<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Storage;

class UserStorage extends AbstractStorage
{
    /**
     * Table name
     */
    const TABLE = 'users';
    const FIELD_ID = 'id';

    /**
     * @return array
     */
    public function fetchAllUsers()
    {
        return $this->_db->fetchAll(self::TABLE);
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function fetchUser($id)
    {
        return $this->_db->fetchOne(self::TABLE, ['id' => $id]);
    }

    /**
     * @param array $user
     *
     * @return array
     */
    public function canRegister($user)
    {
        if (!isset($user['username']) || empty($user['username'])) {
            return [
                'result' => false,
                'msg'    => 'Username can not be empty.',
            ];
        }

        if (!isset($user['email']) || empty($user['email'])) {
            return [
                'result' => false,
                'msg'    => 'Email can not be empty',
            ];
        }

        if (!isset($user['password']) || empty($user['password'])) {
            return [
                'result' => false,
                'msg'    => 'Password can not be empty',
            ];
        }

        $check = $this->_db->fetchOne(
            self::TABLE, ['username' => $user['username']]
        );

        if (!empty($check)) {
            return [
                'result' => false,
                'msg'    => 'Username already exists in the system',
            ];
        }

        $check = $this->_db->fetchOne(self::TABLE, ['email' => $user['email']]);

        if (!empty($check)) {
            return [
                'result' => false,
                'msg'    => 'Email already exists in the system',
            ];
        }

        return [
            'result' => true,
            'msg'    => '',
        ];
    }

    /**
     * @param null $email
     *
     * @return string
     */
    public function generateUserToken($email = null)
    {
        if ($email == null) {
            $token = md5(time());
        } else {
            $token = md5($email);
        }
        return $token;
    }

    /**
     * @param array $user
     *
     * @return array|ResultSet
     */
    public function registerUser($user, $storeSession = false)
    {
        $canRegister = $this->canRegister($user);

        if (!$canRegister['result']) {
            return $canRegister;
        }

        $user['token'] = $this->generateUserToken($user['email']);

        try {
            $this->_db->insert(self::TABLE, $user);
        } catch (\Exception $e) {
            return [
                'result' => false,
                'msg'    => $e->getMessage(),
            ];
        }
        return [
            'result'        => true,
            'msg'           => "User $user[email] has been registered.",
            'userRecord'    => $user,
        ];
    }

    public function loginUser($usernameOrEmail, $password)
    {
        $userRecord = $this->_db->fetchOne(self::TABLE, ['username' => $usernameOrEmail]);

        if (empty($userRecord)) {
            $userRecord = $this->_db->fetchOne(self::TABLE, ['email' => $usernameOrEmail]);
        }

        if (empty($userRecord)) {
            return [
                'result'    => false,
                'msg'       => 'Account doesn\'t exist',
            ];
        }


    }
}