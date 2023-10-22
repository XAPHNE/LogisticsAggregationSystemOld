<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use RealRashid\SweetAlert\Facades\Alert;

class Users extends Component {
    use WithPagination;

    public $userId;
    public $userToDelete;
    public $confirmingUserDeletion;
    public $sortField;
    public $sortDirection = 'asc';
    public $search = '';
    public $entries = 10;

    protected $listeners = ['confirmUserDeletion' => 'getUsers'];
    protected $userList = [];

    public function mount() {
        $this->sortField = 'first_name';
        $this->userList = $this->getUsers();
    }
    public function render() {
        return view('livewire.users', [
            'users'=> $this->userList,
        ]);
    }
    public function confirmUserDeletion($id) {
        $this->userId = $id;
        $this->userToDelete = User::find($id);
        $this->confirmingUserDeletion = true;


        $this->emit('confirmUserDeletion', $id);
    }
    public function deleteUser() {
        $userToDelete = User::find($this->userId);

        if ($userToDelete) {
            $userToDelete->delete();

            // Use SweetAlert to show a success message
            Alert::success('User deleted successfully', 'Success')->showConfirmButton();

            $this->reset(['userId', 'userToDelete', 'confirmingUserDeletion']);
            $this->userList = $this->getUsers();
        }
    }
    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection == 'asc'?'desc':'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->userList = $this->getUsers();
    }
    public function updatedSearch() {
        $this->userList = $this->getUsers();
    }
    public function updatedEntries() {
        $this->userList = $this->getUsers();
    }
    public function getUsers() {
        return User::with('roles')
        ->where(function ($query) {
            $query->where('first_name','like','%'. $this->search .'%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%');
        })
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate($this->entries);
    }
}