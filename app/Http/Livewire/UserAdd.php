<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserAdd extends Component {
    use WithFileUploads;

    public $email;
    public $number;
    public $role;
    public $password;
    public $password_confirmation;
    public $first_name;
    public $last_name;
    public $gender;
    public $address;
    public $city;
    public $zip;
    public $image;
    public function render() {
        $roles = Role::all();
        return view('livewire.user-add', ['roles' => $roles]);
    }
    public function resetFormFields() {
        $this->email = '';
        $this->number = '';
        $this->role = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->gender = '';
        $this->address = '';
        $this->city = '';
        $this->zip = '';
        $this->image = null;
    }

    public function createUser() {
        info('Attempting to create a user.');
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'number' => 'required|numeric|digits:10|unique:users,number',
            'role' => 'required|exists:roles,id',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'gender' => 'nullable|in:Male,Female,Other',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'zip' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        User::create([
            'email' => $this->email,
            'number' => $this->number,
            'role_id' => $this->role,
            'password' => Hash::make($this->password),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'address' => $this->address,
            'city' => $this->city,
            'zip' => $this->zip,
            'remember_token' => Str::random(10),
        ]);
        session()->flash('success', 'Role added successfully');

        $this->resetFormFields();
        info('User creation completed.');
        return redirect()->route('users');
    }
}
