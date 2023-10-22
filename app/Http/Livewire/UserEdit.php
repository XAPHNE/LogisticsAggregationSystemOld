<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserEdit extends Component
{
    use WithFileUploads;

    public $user;
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

    public function mount($id)
    {
        $this->user = User::find($id);

        if (!$this->user) {
            abort(404);
        }

        $this->email = $this->user->email;
        $this->number = $this->user->number;
        $this->role = $this->user->role_id;
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->gender = $this->user->gender;
        $this->address = $this->user->address;
        $this->city = $this->user->city;
        $this->zip = $this->user->zip;
    }

    public function render()
    {
        $roles = Role::all();
        return view('livewire.user-edit', ['roles' => $roles]);
    }

    public function updateUser()
    {
        // Define validation rules
        $rules = [
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'number' => 'required|numeric|digits:10|unique:users,number,' . $this->user->id,
            'role' => 'required|exists:roles,id',
            'password' => 'nullable|min:6', // Optional password change
            'password_confirmation' => 'nullable|min:6|same:password', // Optional password change
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'gender' => 'nullable|in:Male,Female,Other',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'zip' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // If password is not provided, remove validation rules for password fields
        if (empty($this->password)) {
            unset($rules['password']);
            unset($rules['password_confirmation']);
        }

        // Validate the input data
        $this->validate($rules);

        // Update the user
        $this->user->update([
            'email' => $this->email,
            'number' => $this->number,
            'role' => $this->role,
            'password' => empty($this->password) ? $this->user->password : bcrypt($this->password),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'address' => $this->address,
            'city' => $this->city,
            'zip' => $this->zip,
        ]);

        // Handle image upload
        if ($this->image) {
            $this->user->update([
                'image' => $this->image->store('user-images', 'public'),
            ]);
        }

        session()->flash('message', 'User updated successfully');

        return redirect()->route('users');
    }
}
