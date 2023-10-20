<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class Roles extends Component
{
    use WithPagination;

    public $roleId;
    public $roleToDelete;
    public $confirmingRoleDeletion;
    public $sortField;
    public $sortDirection = 'asc'; // Default sorting direction
    public $search = ''; // Add the search property
    public $entries = 10; // Add the entries property

    protected $roleList = []; // Use a protected property

    public function mount()
    {
        $this->sortField = 'name'; // Default sorting field
        $this->roleList = $this->getRoles(); // Initialize the roleList property
    }

    public function render()
    {
        return view('livewire.roles', [
            'roles' => $this->roleList, // Pass the roleList to the view
        ]);
    }

    public function confirmRoleDeletion($id)
    {
        $this->roleId = $id;
        $this->roleToDelete = Role::find($id);
        $this->confirmingRoleDeletion = true;

        // Emit the event to trigger the Livewire method
        $this->emit('confirmRoleDeletion', $id);
    }

    public function deleteRole()
    {
        $roleToDelete = Role::find($this->roleId);

        if ($roleToDelete) {
            $roleToDelete->delete();
            session()->flash('message', 'Role deleted successfully');

            // Reset component state
            $this->reset(['roleId', 'roleToDelete', 'confirmingRoleDeletion']);
        }
    }

    public function sortBy($field)
    {
        // If the field to sort by is the same as the current one, toggle the sort direction
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        // Update the roleList property with the sorted data
        $this->roleList = $this->getRoles();
    }

    public function updatedSearch()
    {
        // Update the roleList property with filtered data based on the search query
        $this->roleList = $this->getRoles();
    }

    public function updatedEntries()
    {
        // Update the roleList property with the specified number of entries per page
        $this->roleList = $this->getRoles();
    }

    // Create a getter method for the roleList property
    protected function getRoles()
    {
        return Role::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->entries);
    }
}
