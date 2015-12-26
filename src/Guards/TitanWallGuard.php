<?php namespace Ngakost\TitanWall\Guards;

use Illuminate\Auth\Guard;
use Illuminate\Contracts\Auth\Guard as GuardContract;
use Ngakost\TitanWall\Helpers\TitanWallHelper;

/**
 * @todo
 * @license MIT
 */
class TitanWallGuard extends Guard implements GuardContract
{
    /**
	 * Default Laravel Auth method.
     * Attempt to authenticate a user using the given credentials.
     *
     * @param  array $credentials
     * @param  bool $remember
     * @param  bool $login
     * @return bool
     */
    public function attempt(array $credentials = [], $remember = false, $login = true)
    {
        $this->fireAttemptEvent($credentials, $remember, $login);

        $this->lastAttempted = $user = $this->provider->retrieveByCredentials($credentials);

        // If an implementation of UserInterface was returned, we'll ask the provider
        // to validate the user against the given credentials, and if they are in
        // fact valid we'll log the users into the application and return true.
        if ($this->hasValidCredentials($user, $credentials)) {

            if ($login) {
                $this->login($user, $remember);
            }

            return true;
        }

        return false;
    }

    /**
     * Attempt to authenticate a user using the given credentials.
     * @todo
     * @param  array $credentials
     * @param  bool $remember
     * @param  bool $login
     * @return bool
     */
    public function verify(array $credentials = array(), $remember = false, $login = true)
    {
        $this->fireAttemptEvent($credentials, $remember, $login);

        $this->lastAttempted = $user = $this->provider->retrieveByCredentials($credentials);

        if (!$this->hasValidCredentials($user, $credentials)) {

            return TitanWallHelper::INVALID_CREDENTIALS;

        } else {

            if (!$this->provider->isVerified($user)) {
                return TitanWallHelper::UNVERIFIED;
            }

            if (!$this->provider->isActivated($user)) {
                return TitanWallHelper::DISABLED;
            }

            //cek jika user telah mempunyai role
            if ($this->provider->hasRole($user)) {

                $isPurchase = $this->provider->isPurchaseable($user);

                if ($isPurchase) {

                    if ($user->expire_date === NULL) {

                        $calc = $user->calculateDays($user->getAuthIdentifier());
                        $user->expire_date = $calc;
                        $user->save();
                    }

                    if ($user->isExpired($user->getAuthIdentifier())) {
                        return TitanWallHelper::EXPIRED;
                    } else {
                        return TitanWallHelper::SUCCESS;
                    }

                }

                return TitanWallHelper::SUCCESS;

            } else {

				throw new \RuntimeException('User not has any roles, please setup user roles.');
			}

        }

        if ($login) {
            $this->login($user, $remember);
        }

        return TitanWallHelper::INVALID_CREDENTIALS;
    }
}