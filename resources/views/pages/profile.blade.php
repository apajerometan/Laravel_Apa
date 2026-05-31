@extends('layouts.main')

@section('content')
<section class="page-section">
    <div class="container">
        <h2 class="page-title mb-4">User Profile</h2>
        
        <div class="row g-4">
            {{-- Profile Picture --}}
            <div class="col-12 col-lg-4">
                <div class="page-card text-center">
                    <img
                        src="{{ $user->profile_pic ? asset('uploads/' . $user->profile_pic) : asset('uploads/default.png') }}"
                        alt="Profile photo"
                        class="profile-pic mb-3 rounded-circle"
                        style="width: 180px; height: 180px; object-fit: cover;"
                    >
                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 text-start">
                            <label class="form-label" for="profile_pic">Change photo</label>
                            <input type="file" class="form-control" id="profile_pic" name="profile_pic" accept="image/*">
                        </div>
                        <button type="submit" name="upload_pic" class="btn btn-outline-primary w-100">Upload photo</button>
                    </form>
                </div>
            </div>

            {{-- Profile Info --}}
            <div class="col-12 col-lg-8">
                <div class="page-card">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="fullname">Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" 
                                       value="{{ $user->fullname }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ $user->email }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" 
                                       value="{{ $user->phone ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" 
                                       value="{{ $user->address ?? '' }}">
                            </div>
                            <div class="col-md-6">
    <label class="form-label" for="gender">Gender</label>
    <select class="form-control" id="gender" name="gender">
        <option value="">Select Gender</option>
        <option value="Male" {{ ($user->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ ($user->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
        <option value="Other" {{ ($user->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
    </select>
</div>
                            
                            {{-- Change Password --}}
                            <div class="col-12">
                                <hr>
                                <h6 class="mb-3">Change password <small class="text-muted">(optional)</small></h6>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="current_password">Current password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="new_password">New password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="confirm_password">Confirm new password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection