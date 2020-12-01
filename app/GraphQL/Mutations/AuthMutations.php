<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Joselfonseca\LighthouseGraphQLPassport\Exceptions\AuthenticationException;

class AuthMutations
{
    public function login($_,array $args)
    {
        // Check if a user with the specified email exists
        $user = User::where(config('lighthouse-graphql-passport.username'), $args['username'])->first();

        if($user->role == 2){
            throw new AuthenticationException(__('Authentication exception'), __('User Not Authorized'));
        }


        if (!$user) {
            throw new AuthenticationException(__('Authentication exception'), __('User Not Found'));
        }

        // If a user with the email was found - check if the specified password
        // belongs to this user
        if (!Hash::check($args['password'], $user->password)) {
            throw new AuthenticationException(__('Authentication exception'), __('Wrong password'));

        }
        // Send an internal API request to get an access token
        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        // Make sure a Password Client exists in the DB
        if (!$client) {
            throw new AuthenticationException(__('Authentication exception'), __('Laravel Passport is not setup properly.'));
        }

        $data = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $args['username'],
            'password' => $args['password'],
        ];

        $request = Request::create('/oauth/token', 'POST', $data);

        $response = app()->handle($request);

        // Check if the request was successful
        if ($response->getStatusCode() != 200) {
            throw new AuthenticationException(__('Authentication exception'), __('Incorrect username or password'));
        }
        // // Get the data from the response
        $data = json_decode($response->getContent(),true);

        // Format the final response in a desirable format
        return array_merge(
            $data,
            [
                'user' => $user,
            ]
        );
    }
    public function register($_,array $args)
    {
        $model = app(config('auth.providers.users.model'));
        $input = collect($args)->except('password_confirmation')->toArray();
        $model->fill($input);
        $model->save();


        return [
            'tokens' => [],
            'status' => 'MUST_VERIFY_EMAIL',
        ];
    }
}
