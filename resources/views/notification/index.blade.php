@extends('layouts.app')
@section('content')

<div class="container w-50">
    <form action="notification/send" method="POST">
        @csrf()
        <div class="form-group">
            <label>Select Users</label><br>
            <select class="js-example-basic-multiple w-100"  name="users[]" multiple="multiple">
               @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
               @endforeach
              </select>
        </div>

        <div class="form-group">
            <label>Notification Message</label>
            <textarea class="form-control" name="message"></textarea>
        </div>

        <div class="form-group">
            <input type="submit" value="Send Notification" class="btn btn-primary">
        </div>
    </form>
</div>

@if(Session::has('success'))
    <center>{{ Session::get('success') }}</center>
@endif
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
