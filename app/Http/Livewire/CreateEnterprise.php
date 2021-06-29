<?php

namespace App\Http\Livewire;

use App\Models\Enterprise;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateEnterprise extends Component
{
    public $enterprises = [],$name,$city,$phone,$fax,$address,$adminEmail,$contactEmail,$password,$confirm_password;
    public $updateMode =false;
    public function render()
    {
        $this->enterprises = Enterprise::all();
        return view('livewire.create-enterprise');
    }

    public function store(){
        try{
            $data = [
                'name' => $this->name,
                'city' => $this->city,
                'phone' => $this->phone,
                'fax' => $this->fax,
                'address' => $this->address,
                'contactEmail' => $this->contactEmail,
            ];
            $userData = [
                'email' => $this->adminEmail,
                'name' => $this->name,
                'lastName' => $this->name,
                'password' => $this->password
            ];

            Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'fax' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'contactEmail' => ['required', 'string', 'email', 'max:255']
            ])->validate();

            Validator::make($userData, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required']
            ])->validate();

            $user =  User::create([
                'name' => $userData['name'],
                'lastName' => $userData['lastName'],
                'email' => $userData['email'],
                'user_type' => "enterpriseRep",
                'password' => Hash::make($userData['password']),
            ]);

            Enterprise::create([
                'name' => $this->name,
                'city' => $this->city,
                'phone' => $this->phone,
                'fax' => $this->fax,
                'address' => $this->address,
                'email' => $this->contactEmail,
                'user_id' => $user->id
            ]);


            session()->flash('message', 'Enterprise has been created successfully.');
        }catch (\Exception $e){
            session()->flash('error','something went wrong try later :(');
        }
    }
    public function remove($id){
        try{
            $enterprise = Enterprise::find($id);
            if($enterprise->internships()->getResults()->count() == 0 ){
                Enterprise::destroy($id);
                session()->flash('messageDeleted','Enterprise has been deleted successfully.');
            }else{
                session()->flash('errorDeleted','This enterprise has internships associated to it');
            }

        }catch (\Exception $e){
            session()->flash('errorDeleted','something went wrang');
        }

    }
}
