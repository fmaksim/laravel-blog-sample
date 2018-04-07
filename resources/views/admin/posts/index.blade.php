@extends("admin.layout")

@section("content")

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Все записи
            </h1>
        </section>

        <section class="content">

            <div class="box">

                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('posts.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Категория</th>
                            <th>Теги</th>
                            <th>Картинка</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->getCategoryTitle()}}</td>
                            <td>{{$post->getTagsTitles()}}</td>
                            <td>
                                <img src="{{$post->getImage()}}" alt="" width="100">
                            </td>
                            <td><a href="{{route('posts.edit', $post->id)}}" class="fa fa-pencil"></a>
                                {{Form::open(["route" => ['posts.destroy', $post->id], 'method' => 'DELETE'])}}
                                <button onclick="return confirm('Are you sure you want to delete this post?');" type="submit" class="fa fa-remove btn delete-btn"></button>
                                {{Form::close()}}
                            </td>
                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                </div>
            </div>

        </section>

    </div>

@endsection