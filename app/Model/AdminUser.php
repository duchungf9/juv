<?php namespace App\Model;

use App\FromSky\DomainLayer\Admin\AdminAcl;
use App\FromSky\Permission\GFEntrustUserTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/*GF_ma for fromSky*/

use App\FromSky\DomainLayer\Admin\AdminUserPresenter;
use App\FromSky\Notifications\AdminResetPasswordNotification as AdminUserResetPasswordNotification;

class AdminUser extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    use Notifiable;

    use AdminUserPresenter;
    use AdminAcl;
    use GFEntrustUserTrait;

    protected string $role_user_table = "adminuser_role";
    protected string $user_foreign_key = "adminuser_id";

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'adminusers';


    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'is_active', 'locale'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    protected array $fieldspec = [];

    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        if ($password != '') {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    /**
     * @param $roles
     */
    public function saveRoles($roles)
    {
        if (!empty($roles)) {
            $this->roles()->sync($roles);
        } else {
            $this->roles()->detach();
        }
    }


    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    /**
     * @return array
     */

    function getFieldSpec(): array

    {
       
        $this->fieldspec['id'] = [
            'type' => 'integer',
            'minvalue' => 0,
            'pkey' => 'y',
            'required' => 1,
            'label' => trans('admin.label.id'),
            'hidden' => 1,
            'display' => 0,
        ];
        $this->fieldspec['first_name'] = [
            'type' => 'string',
            'required' => 1,
            'hidden' => 0,
            'label' => trans('admin.label.first_name'),
            'display' => 1,
            'validation' => 'required'
        ];
        $this->fieldspec['last_name'] = [
            'type' => 'string',
            'required' => 1,
            'hidden' => 0,
            'label' => trans('admin.label.last_name'),
            'display' => 1,
            'validation' => 'required'
        ];
        $this->fieldspec['email'] = [
            'type' => 'string',
            'required' => 1,
            'hidden' => 0,
            'label' => trans('admin.label.email'),
            'display' => 1,
            'validation' => 'required|Between:3,64|Email|is_unique'
        ];
        $this->fieldspec['role'] = [
            'type' => 'relation',
            'model' => 'Role',
            'relation_name' => 'roles',
            'foreign_key' => 'id',
            'label_key' => 'display_name',
            'required' => 1,
            'label' => trans('admin.label.role'),
            'hidden' => $this->hideEditRole(),
            'whereRaw' => ($this->isSu()) ? '' : 'name != "su"',
            'display' => 1,
            'multiple' => 1,
            'validation' => 'required',
            'roles' => ['su', 'admin'],
            'show_only_values' => [ 'su'=> [8] , 'admin' => [8] ]

        ];

        $this->fieldspec['locale'] = [
            'type' => 'component',
            'required' => 1,
            'label' => trans('admin.label.locale'),
            'hidden' => 0,
            'display' => 1,
        ];
        $this->fieldspec['password'] = [
            'type' => 'password',
            'is_full_component' => 1,
            'required' => 0,
            'hidden' => 0,
            'label' => trans('admin.label.password'),
            'display' => 1,
            'template' => 'password',
            'validation' => 'nullable|min:10|confirmed|regex:' . config('fromSky.security.password_regex'),
        ];
        $this->fieldspec['is_active'] = [
            'type' => 'boolean',
            'required' => 0,
            'hidden' => 0,
            'label' => trans('admin.label.publish'),
            'display' => 1
        ];
        return $this->fieldspec;
    }


    /*
    |--------------------------------------------------------------------------
    | NOTIFIABLE OVERRIDE THE SENDPASSWORDRESETNOTIFICATION
    |--------------------------------------------------------------------------
    |
    */

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminUserResetPasswordNotification($token));
    }
}
