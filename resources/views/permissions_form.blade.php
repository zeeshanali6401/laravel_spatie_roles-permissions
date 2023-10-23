@extends('layouts.app')
@section('content')
<div class="container w-25">
  <form method="post" action="{{route('permission.store')}}">
    @csrf
      <div class="form-group">
        <label>Permission Name</label>
        <input type="text" class="form-control" name="name" placeholder="Permission Name" autofocus>
      </div>
      <div class="form-group">
        <label>guard_name</label>
        <input value="web" readonly type="text" class="form-control" name="guard_name" placeholder="guard_name">
      </div><br>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
