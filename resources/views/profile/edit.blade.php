@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<div class="edit-wrapper">
    <div class="edit-card">
        <h2>EDIT PROFILE</h2>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="edit-row">
                <div>
                    <label for="first_name" class="form-label">First&nbsp;</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}" required>
                </div>
                <div>
                    <label for="middle_name" class="form-label">Middle</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ Auth::user()->middle_name }}">
                </div>
                <div>
                    <label for="last_name" class="form-label">Last&nbsp;&nbsp;</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}" required>
                </div>
                <div>
                    <label for="ext_name" class="form-label">Ext.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" class="form-control" id="ext_name" name="ext_name" value="{{ Auth::user()->ext_name }}">
                </div>
                <div>
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                </div>
                <div>
                    <label for="profile_photo" style="cursor: pointer;">
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                            alt="Profile Photo"
                            class="profile-photo"
                            id="preview">
                    </label>
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*" style="display: none;" onchange="previewImage(event)">
                </div>
                <div class="button-row">
                    <button type="submit" class="btn-primary">Update Profile</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('preview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection