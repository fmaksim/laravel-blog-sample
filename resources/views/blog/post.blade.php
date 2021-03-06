@extends('blog.layout')

@section('content')

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <article class="post">
                        <div class="post-thumb">
                            <a href="{{route('post.show', $post->slug)}}"><img src="{{$post->getImage()}}" alt=""></a>
                        </div>
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                <h6>
                                    <a href="{{route('category.show', $post->category->slug)}}"> {{$post->getCategoryTitle()}}</a>
                                </h6>

                                <h1 class="entry-title"><a
                                            href="{{route('post.show', $post->slug)}}">{{$post->title}}</a></h1>


                            </header>
                            <div class="entry-content">
                                {!! $post->content !!}
                            </div>
                            <div class="decoration">
                                @foreach($post->tags as $tag)
                                    <a href="{{route('tag.show', $tag->slug)}}"
                                       class="btn btn-default">{{$tag->title}}</a>
                                @endforeach
                            </div>

                            <div class="social-share">
							<span
                                    class="social-share-title pull-left text-capitalize">By {{$post->author->name}}
                                On {{$post->getDate()}}</span>
                                <ul class="text-center pull-right">
                                    <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </article>
                    <div class="top-comment"><!--top comment-->
                        <img width="50" height="50" style="padding: 0px; margin-right: 15px;"
                             src="{{$post->author->getAvatar()}}" class="pull-left img-circle" alt="">
                        <h4>{{$post->author->name}}</h4>
                    </div><!--top comment end-->
                    <div class="row"><!--blog next previous-->
                        @if($post->hasPrevious())
                            <div class="col-md-6">
                                <div class="single-blog-box">
                                    <a href="{{route('post.show', $post->previous()->slug)}}">
                                        <img src="{{$post->previous()->getImage()}}" alt="">

                                        <div class="overlay">

                                            <div class="promo-text">
                                                <p><i class=" pull-left fa fa-angle-left"></i></p>
                                                <h5>{{$post->previous()->title}}</h5>
                                            </div>
                                        </div>


                                    </a>
                                </div>
                            </div>
                        @endif
                        @if($post->hasNext())
                            <div class="col-md-6">
                                <div class="single-blog-box">
                                    <a href="{{route('post.show', $post->next()->slug)}}">
                                        <img src="{{$post->next()->getImage()}}" alt="">

                                        <div class="overlay">
                                            <div class="promo-text">
                                                <p><i class=" pull-right fa fa-angle-right"></i></p>
                                                <h5>{{$post->next()->title}}</h5>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div><!--blog next previous end-->
                    <div class="related-post-carousel"><!--related post carousel-->
                        <div class="related-heading">
                            <h4>You might also like</h4>
                        </div>
                        <div class="items">
                            @foreach($post->related() as $related)
                                <div class="single-item">
                                    <a href="{{route('post.show', $related->slug)}}">
                                        <img src="{{$related->getImage()}}" alt="">

                                        <p>{{$related->title}}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div><!--related post carousel-->
                    <div class="bottom-comment"><!--bottom comment-->
                        <h4>{{$activeComments->count()}} comments</h4>
                        @if(!$activeComments->isEmpty())
                            @foreach($activeComments as $comment)
                        <div class="comment-img">
                            <img style="width: 75px; height: 75px;" class="img-circle"
                                 src="{{$comment->author->getAvatar()}}" alt="">
                        </div>

                        <div class="comment-text">
                            <h5>{{$comment->author->name}}</h5>

                            <p class="comment-date">
                                {{$comment->created_at->diffForHumans()}}
                            </p>

                            <p class="para">{{$comment->text}}</p>
                        </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- end bottom comment-->
                    @include('blog.partials.comment_form')
                </div>
                @include('blog.partials.sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->

@endsection