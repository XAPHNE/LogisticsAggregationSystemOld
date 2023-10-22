<div>
    <title>LAST Dashboard - User Add</title>
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
                    <li class="breadcrumb-item active" aria-current="page">User Add</li>
                </ol>
            </nav>
            <h2 class="h4">User Add</h2>
            <p class="mb-0">Your user adding template.</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('role.add')}}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                New User
            </a>
            <div class="btn-group ms-2 ms-lg-3">
                <button type="button" class="btn btn-sm btn-outline-gray-600">Share</button>
                <button type="button" class="btn btn-sm btn-outline-gray-600">Export</button>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-8">
        <div class="card card-body shadow-sm mb-4">
            <h2 class="h5 mb-4">User information</h2>
                <form wire:submit.prevent="createUser" action="{{route('user.add')}}" method="POST">
                    @csrf
                    <div class="col-md-12 mb-3">
                        <div>
                            <label for="email">Email</label>
                            <input wire:model="email" class="form-control" name="email" id="email" type="email" placeholder="Email" required>
                        </div>
                        @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div>
                            <label for="number">Mobile Number</label>
                            <input wire:model="number" class="form-control" name="number" id="number" type="number" placeholder="Mobile Number" required>
                        </div>
                        @error('number') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div>
                            <label for="role">Role</label>
                            <select wire:model="role" class="form-control" name="role" id="role" required>
                                <option>Select</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('role') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div>
                            <label for="password">Password</label>
                            <input wire:model="password" class="form-control" name="password" id="password" type="password" placeholder="Password" required>
                        </div>
                        @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div>
                            <label for="password_confirmation">Confirm Password</label>
                            <input wire:model="password_confirmation" class="form-control" name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div>
                            <label for="first_name">First Name</label>
                            <input wire:model="first_name" class="form-control" name="first_name" id="first_name" type="text" placeholder="First Name">
                        </div>
                        @error('first_name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div>
                            <label for="last_name">Last Name</label>
                            <input wire:model="last_name" class="form-control" name="last_name" id="last_name" type="text" placeholder="Last Name">
                        </div>
                        @error('last_name') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div>
                            <label for="gender">Gender</label>
                            <select wire:model="gender" class="form-control" name="gender" id="gender">
                                <option>Select</option>
                                @foreach(['Male', 'Female', 'Other'] as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('gender') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div>
                            <label for="address">Address</label>
                            <textarea wire:model="address" class="form-control" name="address" id="address" type="text" placeholder="Address"></textarea>
                        </div>
                        @error('address') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div>
                            <label for="city">City</label>
                            <input wire:model="city" class="form-control" name="city" id="city" type="text" placeholder="City">
                        </div>
                        @error('city') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div>
                            <label for="zip">Zip Code</label>
                            <input wire:model="zip" class="form-control" name="zip" id="zip" type="number" placeholder="Zip Code">
                        </div>
                        @error('zip') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div>
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div>
                        @error('image') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2" id="userAdd">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if (session('success'))
    @push('scripts')
        <script>
            // This script will execute after the page is loaded.
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('userAdd').addEventListener('click', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session('success') }}',
                        timer: 1500,
                    });
                });
            });
        </script>
    @endpush
@endif