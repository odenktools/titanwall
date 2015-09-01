<?php namespace Ngakost\TitanWall\Providers;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

/**
 * @todo
 */
class TitanWallUserProvider extends EloquentUserProvider implements UserProvider
{
    /**
     * @param array $credentials
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (array_key_exists('identifier', $credentials)) {
            foreach (config('titanwall.identified_by') as $identified_by) {
                $query = $this->createModel()
                    ->newQuery()
                    ->where($identified_by, $credentials['identifier']);

                $this->appendQueryConditions($query, $credentials, ['password', 'identifier']);

                if ($query->count() !== 0) {
                    break;
                }
            }
        } else {
            $query = $this->createModel()->newQuery();
            $this->appendQueryConditions($query, $credentials);
        }

        return $query->first();
    }

    /**
     * @param $query
     * @param $conditions
     * @param array $exclude
     */
    protected function appendQueryConditions($query, $conditions, $exclude = ['password'])
    {
        foreach ($conditions as $key => $value) {
            if (!in_array($key, $exclude)) {
                $query->where($key, $value);
            }
        }
    }

    /**
     * @todo
     *
     * - If user has expired
     * - user has role
     *
     * @param UserContract $user
     * @param array $credentials
     * @return boolean
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['password'];

        //return $this->hasher->check($user->salt . $plain, $user->getAuthPassword());

        return $this->hasher->check($plain, $user->getAuthPassword());
    }

    /**
     * @param UserContract $user
     * @return boolean
     */
    public function getRoleById(UserContract $user)
    {
        //$query = $this->createModel()->newQuery();

        $model = $this->createModel();
        $id = $model->getKeyName();

        //$data = $model->getRoleById($user->id_user);

        $data = $model->find($user->{$id})->roles->first();

        return $data;
    }

    public function hasRole(UserContract $user)
    {
        //$query = $this->createModel()->newQuery();

        $model = $this->createModel();
        $id = $model->getKeyName();

        //$data = $model->getRoleById($user->id_user);

        $data = $model->find($user->{$id})->roles->first();

        if ($data === NULL) return false;

        return true;
    }

    /**
     * @param UserContract $user
     * @return boolean
     */
    public function isPurchaseable(UserContract $user)
    {
        $model = $this->createModel();
        $id = $model->getKeyName();
        return $user->scopePurchaseable($user->{$id});
    }

    /**
     * @param UserContract $user
     * @return boolean
     */
    public function isVerified(UserContract $user)
    {
        return $user->verified;
    }

    /**
     * @param UserContract $user
     * @return boolean
     */
    public function isActivated(UserContract $user)
    {
        return $user->is_active;
    }
}
