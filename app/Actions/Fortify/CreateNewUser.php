<?php

namespace App\Actions\Fortify;

use App\Models\Intern;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        if(array_key_exists('type' ,$input) && $input['type'] == 'admin' ){
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
            ])->validate();

           $user =  User::create([
                'name' => $input['name'],
                'lastName' => $input['lastName'],
                'email' => $input['email'],
                'user_type' => "admin",
                'password' => Hash::make($input['password']),
            ]);
            return $user;
        }else{
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string','unique:interns'],
                'dateOfBirth' => ['required',],
                'address' => ['required'],
                'password' => $this->passwordRules(),
            ])->validate();

            try{
                $user =  User::create([
                    'name' => $input['name'],
                    'lastName' => $input['lastName'],
                    'email' => $input['email'],
                    'user_type' => "intern",
                    'password' => Hash::make($input['password']),
                ]);

                $intern = Intern::create([
                    'id' => $user->id,
                    'phone' => $input['phone'],
                    'address' => $input['address'],
                    'dateOfBirth' => $input['dateOfBirth']
                ]);
                return $user;
            }catch (\Exception $e){
                session()->flash('error','something went wrong sorryyy');
                return redirect()->back();
            }
        }
    }
}
