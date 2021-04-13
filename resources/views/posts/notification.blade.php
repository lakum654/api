@extends('layouts.app')

@section('content')
<div class="container">
   <table class="table table-sm">
       <tr>
           <th>Post Id</th>
           <th>Notification</th>
           {{--  <th>User Name</th>  --}}
           <th>Action URL</th>
           <th>Comment At</th>
       </tr>
       <tbody>
           @foreach($notifications as $val)
            <tr>
                <td>{{ $val->data['title'] }}</td>
                <td>{{ $val->data['message'] }}</td>
                {{--  <td>{{ $val->data['user_id'] }}</td>  --}}
                <td><a href="{{ $val->data['actionURL'] }}">View</a></td>
                <td>{{ $val->created_at->diffForHumans() }}</td>
            </tr>
           @endforeach
       </tbody>
   </table>
</div>
@endsection
