<div>
    <title>LAST Dashboard - Role Management</title>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">LAST</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Role Management</li>
                </ol>
            </nav>
            <h2 class="h4">Role Management</h2>
            <p class="mb-0">Your role management dashboard template.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('role.add')}}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                New Role
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button>
            </div>
        </div>
    </div>
    <div class="card card-body shadow border-0 table-wrapper table-responsive">
        <div class="table-settings mb-4">
            <div class="row justify-content-between align-items-center">
                <div class="col-6 col-lg-4 d-flex">
                    <div class="input-group me-2 me-lg-3">
                        <span class="input-group-text"><svg class="icon icon-xs"
                                x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg></span></span>
                        <input wire:model="search" type="text" class="form-control" placeholder="Search roles">
                    </div>
                    <div class="col-2 d-flex">
                        <select wire:model="entries" class="form-select mb-0" id="entries"
                            aria-label="Entries per page">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <table class="table user-table table-hover align-items-center">
            <thead>
                <tr>
                    <th class="border-bottom"><a wire:click="sortBy('name')" class="text-default me-3"><span>Name</span><span><i class="fas fa-sort-up"></i></span></a></th>
                    <th class="border-bottom"><a wire:click="sortBy('description')" class="text-default me-3"><span>Description</span><span><i class="fas fa-sort"></i></span></a></th>
                    <th class="border-bottom"><a wire:click="sortBy('created_at')" class="text-default me-3"><span>Date Created</span><span><i class="fas fa-sort"></i></span></a></th>
                    <th class="border-bottom"><a class="text-default me-3">Action</a></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td><span>{{ $role->name }}</span></td>
                        <td><span>{{ $role->description }}</span></td>
                        <td><span>{{ $role->created_at->format('d M Y') }}</span></td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                        </path>
                                    </svg>
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('role.edit', ['id' => $role->id]) }}">
                                        <span class="fas fa-user-shield me-2"></span>
                                        Edit role
                                    </a>
                                    <button type="button" class="dropdown-item text-danger d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" wire:click="confirmRoleDeletion({{ $role->id }})">
                                        <span class="fas fa-user-times me-2"></span>
                                        Delete role
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Confirmation Modal -->
        <div class="modal fade" wire:ignore.self id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this role?
                    </div>
                    <div class="modal-footer">
                        <!-- Modify the "Delete" button to trigger Livewire deleteRole method -->
                        <button type="button" id="deleteRole" class="btn btn-danger" data-bs-dismiss="modal" wire:click="deleteRole">Delete</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.getElementById('deleteRole').addEventListener('click', function () {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('message') }}',
                timer: 1500,
            })
        });
    </script>
@endpush
