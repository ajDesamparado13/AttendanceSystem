<?php

namespace App\Repositories;

use App\Entities\User;
use App\Mail\EmailActivationCode;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Mail;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $fieldSearchable = [
        'email' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return UserValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

    public function activationCode()
    {
        $request = app()->make('request');
        $strRandom = str_random(60);
        $user = $this->where('email', $request->email)->update([
            'activation_code' => $strRandom,
        ]);
        if ($user) {
            $referer = $_SERVER['HTTP_REFERER'];
            $array = [
                'name' => 'New User',
                'email' => $request->email,
                'activation_code' => $referer . '/' . $strRandom,
            ];
        }

        Mail::to($request->email)
            ->send(new EmailActivationCode($array));
    }

}