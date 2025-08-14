@extends('layouts.app')

@section('title', 'Add New User')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/add_form.css') }}">
@endpush

@section('content')
    <!-- Main Content -->
    <main>
        <div class="form-card">
            <div class="form-header">
                <i class="fas fa-tooth dental-icon"></i>
                <h1>Add New User</h1>
            </div>

            <form action="{{ route('users.store') }}" method="POST" class="form-container">
                @csrf
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="username" class="required">Username:</label>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Enter username">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="required">Email:</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-col">
                        <div class="form-group">
                            <label for="fullname" class="required">Full Name:</label>
                            <input type="text" name="name" id="fullname" value="{{ old('name') }}" placeholder="Enter full name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="required">Phone:</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Enter phone number">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="required">Gender:</label>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="male" name="gender" value="Male"  {{ old('gender', 'Male') == 'Male' ? 'checked' : '' }}>
                                    <label for="male">Male</label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="female" name="gender" value="Female" {{ old('gender', 'Female') == 'Female' ? 'checked' : '' }}>
                                    <label for="female">Female</label>
                                </div>
                            </div>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="role" class="required">Role:</label>
                            <select id="role" name="role">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div id="conditional-section" class="conditional-section">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="specialty" class="required">Specialty:</label>
                                <input type="text" name="specialty" id="specialty" value="{{ old('specialty') }}" placeholder="Enter specialty..">
                                @error('specialty')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-col">
                            <div class="form-group">
                                <label for="experience" class="required">Years of Experience:</label>
                                <div class="experience-container">
                                    <input type="number" name="years_of_experience" id="experience" min="0" max="50" value="{{ old('years_of_experience',0) }}">
                                    <div class="range-value" id="exp-value">0</div>
                                    @error('years_of_experience')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="permissions" class="required">Permissions:</label>
                    <div class="checkbox-container">
                        @php
                            $oldPermissions = old('permissions', []);
                        @endphp

                        @foreach($permissions as $permission)
                            <div class="checkbox-option">
                                <input type="checkbox" name="permissions[]" id="perm_{{ $permission->id }}" value="{{ $permission->name }}"
                                    {{ in_array($permission->name, $oldPermissions) ? 'checked': '' }}>
                                <label for="per_{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('permissions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Save</button>
            </form>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/user_form.js') }}"></script>
@endpush