<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;

class RoleEdit extends Component {
    public $role;
    public $name;
    public $description;
    public $originalName;

    public function mount($id) {
        $this->role = Role::find($id);

        if (!$this->role) {
            abort(404);
        }

        $this->name = $this->role->name;
        $this->description = $this->role->description;
        $this->originalName = $this->name;
    }

    public function render() {
        return view('livewire.role-edit');
    }

    public function updateRole() {
        // Build dynamic validation rules
        $rules = [
            'description' => 'nullable',
        ];

        // Add unique rule for "name" if it's changed
        if ($this->name !== $this->originalName) {
            $rules['name'] = 'required|unique:roles,name,' . $this->role->id;
        }

        // Validate the input data
        $this->validate($rules);

        // Update the role
        $this->role->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Role updated successfully');
    }
}
