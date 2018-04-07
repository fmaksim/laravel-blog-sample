@extends("admin.layout")

@section("content")
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Добавить статью
            </h1>
        </section>

        <section class="content">
            @include("admin.partials.errors")
            {{Form::open(['route' => 'posts.store', 'files' => true])}}
            <div class="box">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" name = "title" value = "{{old('title')}}" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Лицевая картинка</label>
                            <input type="file" name = "image" id="exampleInputFile">

                            <p class="help-block">jpg, png</p>
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            {{Form::select(
                                'category_id',
                                $categories,
                                null,
                                ['class' => 'form-control select2', 'placeholder' => 'Выберите категорию']
                            )}}
                        </div>
                        <div class="form-group">
                            <label>Теги</label>
                            {{Form::select(
                               'tags[]',
                               $tags,
                               null,
                               ['class' => 'form-control select2', 'multiple' => true, 'data-placeholder' => 'Выберите теги']
                           )}}
                        </div>
                        <!-- Date -->
                        <div class="form-group">
                            <label>Дата:</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name = "date" class="form-control pull-right" id="datepicker">
                            </div>
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input type="checkbox" @if(old('is_featured')) checked @endif name = "is_featured" class="minimal">
                            </label>
                            <label>
                                Рекомендовать
                            </label>
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input type="checkbox" @if(old('status')) checked @endif name = "status" class="minimal">
                            </label>
                            <label>
                                Черновик
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Описание</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control">{{old('description')}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Полный текст</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control">{{old('content')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <a href = "{{route('posts.index')}}" class="btn btn-default">Назад</a>
                    <button type = "submit" class="btn btn-success pull-right">Добавить</button>
                </div>
            </div>
        {{Form::close()}}
        </section>
    </div>
@endsection