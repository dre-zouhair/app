<?php

namespace App\Http\Livewire;

use App\Models\Intern;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use App\Models\User as UserModel;
use Livewire\WithFileUploads;
use PHPUnit\Exception;

class Profile extends Component implements UpdatesUserProfileInformation
{
    use WithFileUploads;

    public $updateMode = false, $user,$intern, $name,$lastName,$email,$address,$phone,$dateOfBirth;
    public $photo;

    public function render()
    {
        $this->user = UserModel::find(Auth::user()->getAuthIdentifier());
        $this->intern = Intern::find($this->user->id);
        return view('livewire.profile');
    }

    public function update($user = null , array $input = null)
    {

        $user =UserModel::find( Auth::user()->getAuthIdentifier());
        $input = [
            'name' => $this->name,
            'lastName' => $this->lastName,
            'dateOfBirth' => $this->dateOfBirth,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'photo' => $this->photo,
        ];

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'dateOfBirth' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        try {
            if (isset($this->photo)) {
                $user->updateProfilePhoto($this->photo);
            }
            $user->forceFill([
                'name' => $input['name'],
                'lastName' => $input['lastName'],
                'email' => $input['email'],
            ])->save();
            Intern::find($user->id)->update([
                'address' => $input['address'],
                'phone' => $input['phone'],
                'dateOfBirth' => $input['dateOfBirth'],
            ]);
            $this->updateMode = false;
            $this->user = UserModel::find(Auth::user()->getAuthIdentifier());
            $this->intern = Intern::find($this->user->id);
            $this->updateInfo($this->user,$this->intern);

            session()->flash('message', 'Profile info was successfully updated');
        }catch (Exception $e){

            session()->flash('error', 'Something went wrong try later :(');
        }
    }

    public function edit(){
        $this->updateMode = true;
       $this->updateInfo($this->user,$this->intern);
    }

    public function cancel(){
        $this->updateMode = false;
        $this->user = UserModel::find(Auth::user()->getAuthIdentifier());
        $this->intern = Intern::find($this->user->id);
        $this->updateInfo($this->user,$this->intern);
    }
    public function deleteProfilePhoto(){
        try{
            $user = UserModel::find(Auth::user()->getAuthIdentifier());
            $user->profile_photo_path = null;
            $user->save();
            $this->updateMode = false;
            session()->flash('message', 'Profile Photo was deleted successfully');
        }catch (Exception $e){
            session()->flash('error', 'Something went wrong try later');
        }

    }
    private  function updateInfo($user,$intern){
        $this->name = $user->name;
        $this->email = $user->email;
        $this->lastName = $user->lastName;
        $this->address = $intern->address;
        $this->phone = $intern->phone;
        $this->dateOfBirth = $intern->dateOfBirth;
    }

}
