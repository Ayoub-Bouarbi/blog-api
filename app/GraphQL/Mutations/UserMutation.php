<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Nuwave\Lighthouse\Exceptions\ValidationException;

class UserMutation
{
    public function create($_, array $args)
    {
        $valid = Validator::make($args,[
            'fullname' => 'required|string|min:2',
            'phone' => 'max:20|min:8|string',
            'bio' => 'min:8|string',
            'role' => 'required|integer',
            'password' => 'required|min:8|max:16|confirmed',
            'username' => "required|max:20|min:8|string|unique:users,username",
            'email' => "required|email|unique:users,email|max:120|min:6"
        ]);

        if($valid->fails()){
            $error =  ValidationException::withMessages([
                $valid->errors()
            ]);

            throw $error;
        }

        $user = User::create($args);

        if($user != null){
            return $user;
        }

    }
    public function update($_, array $args)
    {
        $id = $args['id'];

        $valid = Validator::make($args,[
            'fullname' => 'required|string|min:2',
            'phone' => 'max:20|min:8|string',
            'bio' => 'string',
            'role' => 'required|integer',
            'username' => "required|max:20|min:8|string|unique:users,username,$id,id",
            'email' => "required|email|unique:users,email,$id,id|max:120|min:6"
        ]);

        if($valid->fails()){
            $error =  ValidationException::withMessages([
                $valid->errors()
            ]);

            throw $error;
        }

        $user = User::find($id);

        if($user->update($args)){
            return $user;
        }

    }
    public function updateAvatar($_, array $args)
    {
        $user = User::find($args['id']);

        $file = $args['avatar'];

        if($user->avatar != null || !empty($user->avatar)){
            unlink(storage_path('app/public/uploads/'.$user->avatar));
        }

        $user->avatar = $file->hashname();

        if($user->update()){

            $file->storePublicly('public/uploads');

            return $user;
        }
    }
    public function changePassword($_, array $args)
    {
        $id = $args['id'];

        $valid = Validator::make($args,[
            'password' => 'required|max:20|min:6|confirmed',
        ]);

        if($valid->fails()){
            $error =  ValidationException::withMessages([
                $valid->errors()
            ]);

            throw $error;
        }

        $user = User::find($id);

        if($user->update($args)){
            return $user;
        }
    }
}
