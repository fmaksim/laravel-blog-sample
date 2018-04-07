@extends("admin.layout")

@section("content")
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Изменить статью
            </h1>
        </section>

        <section class="content">
            @include("admin.partials.errors")
            {{Form::open([
                'route' => ['posts.update', $post->id],
                'files' => true,
                'method' => 'PUT'
            ])}}
            <div class="box">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" name = "title" value = "{{$post->title}}" class="form-control" id="exampleInputEmail1" placeholder="" value="Как изучить Laravel создавая Блог?">
                        </div>

                        <div class="form-group">
                            <img src="{{$post->getImage()}}" alt="" class="img-responsive" width="200">
                            <label for="exampleInputFile">Лицевая картинка</label>
                            <input type="file" name = "image" id="exampleInputFile">

                            <p class="help-block">jpg, png</p>
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            {{Form::select(
                                'category_id',
                                $categories,
                                $post->category_id,
                                ['class' => 'form-control select2', 'placeholder' => 'Выберите категорию']
                            )}}
                        </div>
                        <div class="form-group">
                            <label>Теги</label>
                            {{Form::select(
                               'tags[]',
                               $tags,
                               $post->tags,
                               ['class' => 'form-control select2', 'data-placeholder' => 'Выберите теги', 'multiple' => true]
                           )}}
                        </div>
                        <!-- Date -->
                        <div class="form-group">
                            <label>Дата:</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" value="{{$post->date}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" @if($post->is_featured == $post::IS_FEATURED) checked @endif name = "is_featured" class="minimal">
                            </label>
                            <label>
                                Рекомендовать
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" @if(!$post->status) checked @endif name = "status" class="minimal">
                            </label>
                            <label>
                                Черновик
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Описание</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control">{{$post->description}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Полный текст</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control">{{$post->content}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href = "{{route('posts.index')}}" class="btn btn-default">Назад</a>
                    <button type = "submit" class="btn btn-warning pull-right">Изменить</button>
                </div>
            </div>

        </section>
    </div>
@endsection