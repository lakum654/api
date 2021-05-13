@extends('layouts.app')
@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
        <div class="d-flex flex-column col-md-12">
            <div class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
                <div class="profile-image"><img class="rounded-circle" src="https://i.imgur.com/06EM6Iy.jpg" width="70"></div>
                <div class="d-flex flex-column-reverse flex-grow-0 align-items-center votings ml-1"><i class="fa fa-sort-up fa-2x hit-voting"></i><span>127</span><i class="fa fa-sort-down fa-2x hit-voting"></i></div>
                <div class="d-flex flex-column ml-3">
                    <div class="d-flex flex-row post-title">
                        <h5>{{ $post->user->name }}</h5> <h5 class="ml-3"> Post : {{ $post->title }}</h5><span class="ml-2"></span>
                    </div>
                    <div class="d-flex flex-row align-items-center align-content-center post-title">
                    <span class="bdge mr-1"><a href="#" class="text-dark">
                        <i class="fas fa-thumbs-up" id="like-btn" data-like="{{ $post->like }}"></i></a></span>
                    <div class="like_count mr-3">
                        <span class="likes">{{ $post->like }}</span>
                    </div>
                    <span class="mr-2 comments" id="totalComment">{{ $post->comments->count() }} comments&nbsp;</span><span class="mr-2 dot"></span><span>{{ $post->created_at->diffForHumans() }}</span></div>
                </div>
            </div>
            <div class="coment-bottom bg-white p-2 px-4">
                <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                <img class="img-fluid img-responsive rounded-circle mr-2" src="https://i.imgur.com/KLeobJk.jpg" width="38">
                <input type="hidden" id="post_id" value="{{ $post->id }}"> 
                <input type="text"   id="comment" class="form-control mr-3" placeholder="Add comment">
                <button class="btn btn-primary" type="button" id="addCommentBtn" data-comment="{{ $post->comments->count() }}">Comment</button></div>
                    <div class="d-flex flex-row justify-content-between align-items-center action-collapse p-2" data-toggle="collapse" aria-expanded="true" aria-controls="collapse-5" href="#collapse-1"><span>Comments</span>
                    <i class="fa fa-chevron-down servicedrop"></i></div>
                    <div class="newComment">
                    </div>
                    <div class="commentData">
                      @foreach($post->comments as $val)
                      <div class="commented-section mt-2">
                          <div class="d-flex flex-row align-items-center commented-user">
                              <h5 class="mr-2">{{ $val->user->name }}</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">{{ $val->created_at->diffForHumans() }}
                              </span>
                          </div>
                          <div class="comment-text-sm"><span class="commentText-{{ $val->id }}">{{ $val->comment }}.</span></div>
                          <div class="reply-section">
                              <div class="d-flex flex-row align-items-center voting-icons"><i
                                      class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i
                                      class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span
                                      class="ml-2"></span><span class="dot ml-2"></span>
                                      <a href="#" data-toggle="modal" data-target="#replyModal" id="Comment-{{ $val->id }}" class="reply-btn" data-id="{{  $val->id }}">Reply</a>  
                                      @if(Auth::id() == $post->user_id)
                                          <a href="{{ url('posts/comments/delete/'.$val->id) }}" class="ml-4">Remove</a>
                                          @if(Auth::id() == $val->user_id)
                                          <a href="#" class="ml-4 edit-btn" data-id="{{ $val->id }}">Edit</a>  
                                          @endif   
                                      @elseif(Auth::id() == $val->user_id)
                                          <a href="{{ url('posts/comments/delete/'.$val->id) }}" class="ml-4">Remove</a>                                          
                                          <a href="#" class="ml-4 edit-btn" data-id="{{ $val->id }}">Edit</a>                                         
                                      @endif
                               </div>                         
                               <div class="reply-{{ $val->id }}">       
                                 @foreach($val->reply as $val)                                 
                                  <div class="reply-section mt-2">
                                      <div class="d-flex flex-row align-items-center repled-user" style="font-size:13px">
                                          <span class="text-sm" >{{ $val->reply }}</span><span class="mb-1 ml-2">{{ $val->created_at->diffForHumans() }}</span>
                                      </div>
                                  </div>                                  
                               @endforeach
                               </div>
                          </div>
                      </div>
                      @endforeach
                    </div>
                
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="replyModal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Comment Reply</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <input type="text" name="reply" id="replyText" class="form-control">
        <input type="hidden" name="reply" id="commentId" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="reply" class="btn btn-success" data-dismiss="modal" id="send-reply">Send</button>
      </div>
    </div>
  </div>
</div>
</div>

<script src="{{ asset('public/js/app.js') }}" defer></script>   
<script>
    $(document).ready(function(){
      
        function loadComment(){
            var postId = $('#post_id').val();
            var authId = "{{ Auth::id() }}";
            var _token = '{{ csrf_token() }}';
            var box = '';
            $.ajax({
              type:'GET',
              url:"{{ route('comments.index') }}",
              data:{postId:postId,_token:_token},            
               success:function(res) {
                 $.each(res,function(key,value){    
                  const today = new Date(value.created_at);
                   var commentData = '<div class="p-2">';
                    
                    commentData += '<div class="commented-section mt-2"><div class="d-flex flex-row align-items-center commented-user"><h5 class="mr-2">'+value.user.name+'</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">{{ now()->diffForHumans() }}</span></div>';
                    
                    commentData += '<div class="comment-text-sm"><span class="commentText-'+value.id+'">'+value.comment+'</span><div class="d-flex flex-row align-items-center voting-icons"><i class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i class="fa fa-sort-down fa-2x mb-3 hit-voting"></i>';
                      
                    commentData += '<span class="ml-2"></span><span class="dot ml-2"></span><a href="#" data-toggle="modal" data-target="#replyModal" id="Comment-'+value.id+'" class="reply-btn" data-id="'+value.id+'">Reply</a>';

                   if(authId == postId){
                     commentData += '<a href="comments/delete/'+value.id+'" class="ml-4">Remove</a>';
                     if(authId == value.user_id){
                        commentData += '<a href="#" class="ml-4 edit-btn" data-id='+value.id+'>Edit</a>';
                     }
                   }
                   if(authId == value.user_id){
                    commentData += '<a href="comments/delete/'+value.id+'" class="ml-4">Remove</a>';
                    commentData += '<a href="#" class="ml-4 edit-btn" data-id='+value.id+'>Edit</a>';
                   }             
                
                      commentData +=' </div><div class="reply-'+value.id+'"></div></div></div>'; 
                  
                    $('.commentData').prepend(commentData);
                 })
                
              }
            });
          }
        $('#addCommentBtn').click(function(e){
            var total = $(this).data('comment');
            $(this).data('comment',total+1);
            $('#totalComment').text(total+1+' Comments');
            $('.loader').show();
            e.preventDefault();
            var postId = $('#post_id').val();
            var comment = $('#comment').val();
            var _token = '{{ csrf_token() }}';
            $.ajax({
              type:'POST',
              url:"{{ route('comments.store') }}",
              data:{postId:postId,comment:comment,_token:_token},
              success:function(response) {
                $('.loader').hide();
                loadComment();
                $('#commentId').val('');
                $('#comment').val('');
              }
              
            });
        });

        $('#like-btn').click(function(e){
            $('.loader').show();
            e.preventDefault();
            let likeCount = $(this).data('like');
            if($(this).hasClass('fa-thumbs-up')){
                $(this).removeClass('fa-thumbs-up');
                $(this).addClass('fa-thumbs-down');
                 likeCount++;
                 $(this).data('like',likeCount);
                $('.likes').text(likeCount)
            }else{
              $(this).removeClass('fa-thumbs-down');
              $(this).addClass('fa-thumbs-up');
               likeCount--;
              $(this).data('like',likeCount);
              $('.likes').text(likeCount)
            }
            var postId = $('#post_id').val();
            var _token = '{{ csrf_token() }}';
            $.ajax({
              type:'POST',
              url:"{{ route('add.like') }}",
              data:{postId:postId,likes:likeCount,_token:_token},
              success:function(response) {
                if(response == likeCount){
                    $('.likes').text(likeCount)
                    $(this).data('like',likeCount);
                    $('.loader').hide();
                }else{
                
                }
               
              }
            });
        })

        $(document).on('click','.reply-btn',function(e){
            e.preventDefault();
            var commentId = $(this).data('id');
            $('#commentId').val(commentId);           
        })

        $('#send-reply').click(function(e){
            $('.loader').hide();            
            var commentId = $('#commentId').val();
            var replyText = $('#replyText').val();
            if(replyText == ''){
              replyText = "Empty Reply";
            }
            $('.reply-'+commentId).append('<div class="reply-section mt-2"><div class="d-flex flex-row align-items-center repled-user" style="font-size:13px"><span class="text-sm" >'+replyText+'</span><span  class="mb-1 ml-2">{{ now()->diffForHumans() }}</span>');
            var _token = '{{ csrf_token() }}';
            $.ajax({
                type:'POST',
                url:"{{ url('save-reply') }}",
                data:{commentId:commentId,replyText:replyText,_token:_token},
                success:function(res) {  
                    $('.loader').hide();
                    $('#commentId').val('');
                    $('#replyText').val('');
                }
              });

              $('#commentId').val('');
              $('#replyText').val('');
              //location.reload();
              //$('#replyModal').modal('toggle');
              
        })

        $(document).on('click','.edit-btn',function(e){
          e.preventDefault();
          var id = $(this).data('id');
          var oldComment = $('.commentText-'+id).text();
          $('.commentText-'+id).html('<div class="form-inline"><input type="text" id="newComment-'+id+'" class="form-control form-control-sm w-25" value="'+oldComment+'"><button class="btn btn-sm btn-primary ml-2 update-btn" data-id="'+id+'">Update</button></div>');
        });

        $(document).on('click','.update-btn',function(){
           var id = $(this).data('id');
           var newComment = $('#newComment-'+id+'').val();
           $('.commentText-'+id).html('')
           $('.commentText-'+id).text(newComment)
           var _token = '{{ csrf_token() }}';         
           $.ajax({
            type:'POST',
            url:'comments-update',
            data:{commentId:id,comment:newComment,_token:_token},
            success:function(res) {  
              $('.commentText-'+id).text(newComment)
            }
        })
      });
  })   

</script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
  jQuery.validator.setDefaults({
    debug: false,
    success: "valid"
  });
  $( "#myForm" ).validate({
    rules: {
      title: {
        required: true
      }
    }
  });

</script>
@endsection
