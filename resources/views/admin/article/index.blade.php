<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>后台管理</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/ionicons/2.0.0/css/ionicons.min.css">
    <!-- toastr -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/2.1.4/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('static/admin/dist/css/AdminLTE.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        ul.pagination {margin:0;}
        tr:hover {background-color: #f5f5f5;}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<section class="content-header">
    <h1>
        文章列表
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void(0)" onclick="top.location.href='{{ url('admin/index') }}'"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li><a href="javascript:void(0)">文章管理</a></li>
        <li class="active">文章列表</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a class="btn btn-sm btn-primary grid-refresh" title="刷新" onclick="location.reload()"><i class="fa fa-refresh"></i><span class="hidden-xs"> 刷新</span></a>
                    <a href="{{ url('admin/articleAdd') }}" class="btn btn-sm btn-success" title="新增"><i class="fa fa-plus"></i><span class="hidden-xs"> 新增</span></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="overflow-x: auto;overflow-y: auto;">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 40px">ID</th>
                            <th>标题</th>
                            <th>所属栏目</th>
                            <th>发布用户</th>
                            <th>点击量</th>
                            <th>创建时间</th>
                            <th>修改时间</th>
                            <th>操作</th>
                        </tr>
                        @if (count($articles) > 0)
                            <form action="" method="post">
                            @foreach ($articles as $key=>$value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->title }}</td>
                                    @if (count($categorys) > 0)
                                        @foreach ($categorys as $keyTwo=>$valueTwo)
                                            @if ($value->category_id == $valueTwo->id)
                                                <td>@if ($valueTwo->parent_id == 0) ｜ @endif {{ str_repeat('－',$valueTwo->level*4) }} {{ $valueTwo->name }}</td>
                                            @endif
                                        @endforeach
                                    @else
                                        <dt>暂无栏目</dt>
                                    @endif
                                    <td>{{ $value->admin->username }}</td>
                                    <td>{{ $value->click }}</td>
                                    <td>{{ date('Y-m-d H:i:s',strtotime($value->created_at)) }}</td>
                                    <td>{{ date('Y-m-d H:i:s',strtotime($value->updated_at)) }}</td>
                                    <td>
                                        <a href="{{ url('admin/articleInfo') }}?id={{ $value->id }}"><i class="fa fa-eye"></i></a>
                                        <a href="{{ url('admin/articleEdit') }}?id={{ $value->id }}"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" onclick="warning('确定要删除?','{{ url('admin/articleDel') }}?id={{ $value->id }}')" class="grid-row-delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </form>
                        @else
                            <tr>
                                <td colspan="8" align="center">暂无数据</td>
                            </tr>
                        @endif
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix text-center">
                    {{ $articles->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col-md-12 -->
    </div>
    <!-- /.row -->
</section>

<!-- jQuery 3 -->
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<!-- toastr -->
<script src="https://cdn.bootcss.com/toastr.js/2.1.4/toastr.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdn.bootcss.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('static/admin/dist/js/adminlte.min.js') }}"></script>
<!-- function warning -->
<script type="text/javascript">
    function warning(info, url){
        if(window.confirm(info)){
            window.location.href = url;
        }
    }
    toastr.options = {closeButton: true,progressBar: true};
    $(function () {
        @if ($errors->has('success'))
        toastr.success('{{ $errors->first('success') }}');
        @endif
        @if ($errors->has('error'))
        toastr.error('{{ $errors->first('error') }}');
        @endif

    });
</script>

</body>
</html>
