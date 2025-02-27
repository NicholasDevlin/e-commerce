@extends('layouts.app')

@section('title', 'Profile')
@section('content')
<div class="container">
  <p>Name : {{$user->name}}</p>
  <p>Email : {{$user->email}}</p>
  <p>Role : {{$user->is_admin ? 'Admin' : 'Member'}}</p>

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Profile
  </button>

  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('update_profile')}}" method="post">
          @csrf
          <div class="mb-3 row">  
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="name" value="{{$user->name}}" />
            </div>
          </div>
          <div class="mb-3 row">  
            <label class="col-sm-2 col-form-label">New Password</label>
            <div class="col-sm-10">
              <input class="form-control" type="password" name="password" />
            </div>
          </div>
          <div>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
