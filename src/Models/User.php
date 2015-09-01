<?php namespace Ngakost\TitanWall\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use RuntimeException;

/**
 * @todo
 */
class User extends TitanWallModel implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $hidden = ['password', 'salt', 'remember_token'];

    protected $primaryKey = 'id_user';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'username' => 'required|between:3,64',
        'email' => 'required|between:3,64|email|unique:users',
        'password' => 'required:create|between:2,32|confirmed',
        //'password_confirmation' => 'required_with:password|between:2,32'
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'user_mail',
        'email',
        'password',
        'is_active',
        'verified'
    ];

    /**
     * @todo
     *
     * <code>
     * $roles = \Odenktools\Coolcms\Models\User::find(1)->roles;
     * echo json_encode($roles);
     * </code>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('\Ngakost\TitanWall\Models\Role', 'odk_user_roles', 'user_id', 'roles_id')
            ->withTimestamps();
    }

    /**
     * From OctoberCMS
     *
     * Generate a random string
     * @param $length integer
     * @return string
     */
    public function getRandomString($length = 42)
    {
        /*
         * Use OpenSSL (if available)
         */
        if (function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes($length * 2);

            if ($bytes === false)
                throw new RuntimeException('Unable to generate a random string');

            return substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $length);
        }

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    /**
     * @param $id_user
     * @return boolean
     */
    public function getOneRoleById($id_user)
    {
        $row = $this->find($id_user)->roles()
            ->select('id_role', 'role_name', 'role_description', 'is_active',
                'is_purchaseable', 'amount', 'price', 'time_left', 'quantity',
                'period', 'is_builtin', 'backcolor', 'forecolor')
            ->first();

        //$row = $this->find($id_user)->roles;

        return $row;
    }

    /**
     * Set Hash Password after user create
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        //$salt = md5(str_random(64) . time());

        //$this->attributes['password'] = \Hash::make($salt . $password);
        $this->attributes['password'] = \Hash::make($password);
        //$this->attributes['salt'] = $salt;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    public static function create(array $data = array())
    {
        parent::create($data);

        $lastid = \DB::getpdo()->lastinsertid();


    }

    /**
     * [NEW FEATURE]
     *
     * @param $id_user
     * @return bool|string
     */
    public function calculateDays($id_user)
    {
        $now = date('Y-m-d H:i:s');

        $row = $this->getOneRoleById($id_user);

        if ($row) {
            switch ($row->period) {
                case "D":
                    $diff = $row->time_left;
                    break;
                case "W":
                    $diff = $row->time_left * 7;
                    break;
                case "M":
                    $diff = $row->time_left * 30;
                    break;
                case "Y":
                    $diff = $row->time_left * 365;
                    break;
            }

            $expire = date("Y-m-d H:i:s", strtotime($now . +$diff . " day"));

            //echo $expire;

        } else {

            $expire = "0000-00-00 00:00:00";
        }

        return $expire;
    }

    /**
     * [NEW FEATURE]
     *
     *
     *
     * @param $user_id
     * @return int
     */
    public function isExpired($user_id)
    {
        $id = $this->getKeyName();

        $tbl = $this->getTable();

        $data = \DB::select("SELECT `expire_date` FROM `$tbl` WHERE `$id` = $user_id AND TO_DAYS(`expire_date`) > TO_DAYS(NOW())");

        if ($data) {
            return false;
        } else {
            return true;
        }

    }

    /**
     * Check role is purchaseable?
     *
     * <code>
     * $purchased = \Ngakost\TitanWall\Models\User::purchaseable()->get();
     * echo $purchased
     * </code>
     * @param $id_user
     * @return bool
     */
    public function scopePurchaseable($id_user)
    {
        $row = $this->getOneRoleById($id_user);

        if ($row->is_purchaseable == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @todo
     * @param $query
     * @return mixed
     */
    public function scopeVerified($query)
    {
        return $query->where('verified', 1);
    }

    /**
     * @todo
     * @param $query
     * @return mixed
     */
    public function scopeUnverified($query)
    {
        return $query->where('verified', 0);
    }

    /**
     * @todo
     * @param $query
     * @return mixed
     */
    public function scopeUnactived($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * @todo
     * @param $query
     * @return mixed
     */
    public function scopeActived($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * @todo
     * @param $query
     * @return mixed
     */
    public function scopeBuiltin($query)
    {
        return $query->where('is_builtin', 1);
    }
}