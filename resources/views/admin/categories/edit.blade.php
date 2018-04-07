@extends("admin.layout")

@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить категорию
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        @include("admin.partials.errors")
        {{Form::open(['route' => ['categories.update', $category->id], 'method' => 'PUT'])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" value = "{{$category->title}}" name = "title" placeholder="">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href = "{{route('categories.index')}}" class="btn btn-default">Назад</a>
                    <button type = "submit" class="btn btn-success pull-right">Изменить</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            {{Form::close()}}
        </section>
        <!-- /.content -->
    </div>
@endsection