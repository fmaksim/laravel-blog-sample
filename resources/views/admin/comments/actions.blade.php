@if($comment->isActive())
    @php($toggleStatus = 'hidden')
    @php($buttonStyle = 'fa-lock')
@else
    @php($toggleStatus = 'active')
    @php($buttonStyle = 'fa-thumbs-o-up')
@endif

{{Form::open([
                "route" => ['comments.status', $comment->id, $toggleStatus],
                'method' => 'POST',
                'id' => 'changeStatus' . $comment->id,
                'style' => 'float: left;'
          ])}}
<a href="javascript:;" onclick="document.getElementById('changeStatus{{$comment->id}}').submit(); return false;"
   style="float: left;" class="fa {{$buttonStyle}}"></a>
{{Form::close()}}

{{Form::open([
                "route" => ['comments.destroy', $comment->id],
                'method' => 'DELETE',
                'style' => 'float: left;'
          ])}}
<button onclick="return confirm('Are you sure you want to delete this comment?');" type="submit"
        class="fa fa-remove btn delete-btn"></button>
{{Form::close()}}