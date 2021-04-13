@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} <a href="comment-notification"><span class="fa fa-bell ml-3"><div class="badge badge-pill badge-warning">{{ $notification->count() }}</span></a></div></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <h3 class="text-right"><a href="posts" class="btn btn-success">All Posts</a></h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
