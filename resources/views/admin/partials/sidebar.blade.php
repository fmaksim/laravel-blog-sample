<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Админ-панель</span>
                </a>
            </li>
            <li><a href="{{route('posts.index')}}"><i class="fa fa-sticky-note-o"></i> <span>Посты</span></a></li>
            <li><a href="{{route('categories.index')}}"><i class="fa fa-list-ul"></i> <span>Категории</span></a></li>
            <li><a href="{{route('tags.index')}}"><i class="fa fa-tags"></i> <span>Теги</span></a></li>
            <li><a href="{{route('comments.index')}}"><i class="fa fa-commenting"></i> <span>Комментарии</span></a></li>
            <li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> <span>Пользователи</span></a></li>
            <li><a href="#"><i class="fa fa-user-plus"></i> <span>Подписчики</span></a></li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>