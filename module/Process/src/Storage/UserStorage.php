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
        $clearPassword = $user['password'];
        $user['password'] = password_hash($clearPassword, PASSWORD_BCRYPT);

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

    public function loginUser($usernameOrEmail, $password, $storeSession = false)
    {
        $this->clearSession();

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

        if (!$this->verifyPassword($password, $userRecord)) {
            $this->failedLogin($userRecord);
            return [
                'result'    => false,
                'msg'       => 'Invalid password',
            ];
        }

        SessionStorage::setValue('user-logged-in', true);
        SessionStorage::setValue('username', $userRecord['username']);
        SessionStorage::setValue('user-email', $userRecord['email']);

        if ($storeSession) {
            $this->storeSession($userRecord);
        }

        return [
            'result'    => true,
            'msg'       => "User $userRecord[email] logged in",
        ];
    }

    public function userLoggedIn()
    {
        $store = SessionStorage::getValue('user-logged-in');

        if (!$store) {
            $this->retrieveSession();
        }

        $store = SessionStorage::getValue('user-logged-in');

        if (!$store) {
            return false;
        } else {
            if ($store == true) {
                return true;
            }
        }
        return false;
    }

    public function storeSession($user)
    {
        $username = $user['username'];
        $password = $user['password'];

        setcookie('username', $username);
        setcookie('password', $password);
    }

    public function clearSession()
    {
        setcookie('username', null);
        setcookie('password', null);
        SessionStorage::setValue('user-logged-in', null);
        SessionStorage::setValue('user-email', null);
        SessionStorage::setValue('username', null);
    }

    public function retrieveSession()
    {
        $username = $_COOKIE['username'];
        $password = $_COOKIE['password'];
        if (!$username || !$password) {
            return;
        }
        $this->loginUser($username, $password, true);
    }

    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword($password, $storedPassword)
    {
        if ($password == $storedPassword) {
            // password from cookies
            return true;
        }
        return password_verify($password, $storedPassword);
    }

    public function failedLogin($user)
    {

    }

    public function fetchCurrentUser()
    {
        if (!$this->userLoggedIn()) {
            return null;
        }

        $username = SessionStorage::getValue('username');
        return $this->_db->fetchOne('users', ['username' => $username]);
    }
}