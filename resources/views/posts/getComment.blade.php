@foreach($post->comments as $val)
<div class="commented-section mt-2">
    <div class="d-flex flex-row align-items-center commented-user">
        <h5 class="mr-2">{{ $val->user->name }}</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">{{ $val->created_at->diffForHumans() }}</span>
    </div>
    <div class="comment-text-sm"><span>{{ $val->comment }}.</span></div>
    <div class="reply-section">
        <div class="d-flex flex-row align-items-center voting-icons"><i
                class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i
                class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span
                class="ml-2"></span><span class="dot ml-2"></span>
                <a href="#" data-toggle="modal" data-target="#replyModal" id="Comment-{{ $val->id }}" class="reply-btn" data-id="{{  $val->id }}">Reply</a>                                     
                @if(Auth::id() == $post->user_id)
                 <a href="{{ url('comments/delete/'.$val->id) }}" class="ml-4">Remove</a>   
                @elseif(Auth::id() == $val->user_id)
                 <a href="{{ url('comments/delete/'.$val->id) }}" class="ml-4">Remove</a>   
                @endif                                
                @foreach($val->reply as $val)
                <div class="comment-text-sm"><span>{{ $val->reply }}.</span></div>
                @endforeach
        </div>
    </div>
</div>
@endforeach