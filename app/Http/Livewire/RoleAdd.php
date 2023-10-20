<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class RoleAdd extends Component {
    public $name;
    public $description;
    public function render() {
        return view('livewire.role-add');
    }
    public function createRole() {
        $this->validate([
            'name' => 'required|unique:roles,name',
            'description' => 'nullable',
        ]);
        Role::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        session()->flash('message', 'Role added successfully');

        $this->reset(['name', 'description']);
    }
}
