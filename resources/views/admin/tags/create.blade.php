@extends("admin.layout")

@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Добавить тег
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
        @include("admin.partials.errors")
        {{Form::open(['route' => 'tags.store'])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" value = "{{old('name')}}" class="form-control" id="exampleInputEmail1" name = "title" placeholder="">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href = "{{route('tags.index')}}" class="btn btn-default">Назад</a>
                    <button type = "submit" class="btn btn-success pull-right">Добавить</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            {{Form::close()}}
        </section>
        <!-- /.content -->
    </div>
@endsection