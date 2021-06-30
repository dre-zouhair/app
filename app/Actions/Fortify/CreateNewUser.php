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
     * @param array $input
     * @return User
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(array $input):User
    {

        // a hidden input is used in the register admin view to separate admin form intern
        if(array_key_exists('type' ,$input) && $input['type'] == 'admin' ){
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
            ])->validate();

            return $this->createUser($input,"admin");
        }else{
            // We use predefined validation rules for the user's input
            // required is required :),
            // 'unique:users' means that the value of the passed email must be unique in the users table
            // $this->passwordRules() gets a customized rules for password validation, predefined in the packed I used to implement the auth system
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
                //create a user
                $user = $this->createUser($input,"intern");
                // then create an intern for this user
                Intern::create([
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

    /**
     * Create a user via mass assignment
     * @param array $input
     * @param $userType
     * @return mixed
     */
    private function createUser(array $input,$userType)
    {
        return User::create([
            'name' => $input['name'],
            'lastName' => $input['lastName'],
            'email' => $input['email'],
            'user_type' => $userType,
            'password' => Hash::make($input['password']),
        ]);
    }
}
