<div class="leave-comment"><!--leave comment-->
    @if(Auth::check())
        @include('admin.partials.errors')
        <h4>Leave a reply</h4>
        <form class="form-horizontal contact-form" role="form" method="post" action="{{route('comment.store')}}">
            {{csrf_field()}}
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <div class="form-group">
                <div class="col-md-12">
										<textarea class="form-control" rows="6" name="text"
                                                  placeholder="Write Massage"></textarea>
                </div>
            </div>
            <a href="javascript:;" onclick="this.parentNode.submit();" class="btn send-btn">Post Comment</a>
        </form>
    @else
        <h4>Please, login for leaving comments</h4>
    @endif
</div><!--end leave comment-->