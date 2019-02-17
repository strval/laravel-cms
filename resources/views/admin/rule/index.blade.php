<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('bower_components/toastr/build/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">

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
        权限列表
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void(0)" onclick="top.location.href='{{ url('admin/index') }}'"><i class="fa fa-dashboard"></i> 首页</a></li>
        <li><a href="javascript:void(0)">用户管理</a></li>
        <li class="active">权限列表</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a class="btn btn-sm btn-primary grid-refresh" title="刷新" onclick="location.reload()"><i class="fa fa-refresh"></i><span class="hidden-xs"> 刷新</span></a>
                    <a href="{{ url('admin/addRule') }}" class="btn btn-sm btn-success" title="新增"><i class="fa fa-plus"></i><span class="hidden-xs"> 新增</span></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="overflow-x: auto;overflow-y: auto;">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 40px">ID</th>
                            <th>名称</th>
                            <th>标题</th>
                            <th>图标</th>
                            <th>状态</th>
                            <th>菜单栏</th>
                            <th>排序</th>
                            <th>创建时间</th>
                            <th>修改时间</th>
                            <th>操作</th>
                        </tr>
                        @if (count($rule) > 0)
                            <form action="" method="post">
                            @foreach ($rule as $key=>$value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>@if ($value->parent_id === 0) ｜ @endif {{ str_repeat('－',$value->level*4) }} {{ $value->title }}</td>
                                    <td>{{ $value->icon }}</td>
                                    <td>@if ($value->status === 1) 正常 @else 禁用 @endif</td>
                                    <td>@if ($value->ismenu === 1) 是 @else 否 @endif</td>
                                    <td><input type="text" name="sort[{{ $value->id }}]" value="{{ $value->sort }}" style="width: 50px;text-align: center"></td>
                                    <td>{{ date('Y-m-d H:i:s',strtotime($value->created_at)) }}</td>
                                    <td>{{ date('Y-m-d H:i:s',strtotime($value->updated_at)) }}</td>
                                    <td>
                                        <a href="{{ url('admin/infoRule') }}?id={{ $value->id }}"><i class="fa fa-eye"></i></a>
                                        <a href="{{ url('admin/editRule') }}?id={{ $value->id }}"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" onclick="warning('确定要删除?','{{ url('admin/delRule') }}?id={{ $value->id }}')" class="grid-row-delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                                <tr>
                                    {{ csrf_field() }}
                                    <td colspan="10"><input type="submit" value="排序"></td>
                                </tr>
                            </form>
                        @else
                            <tr>
                                <td colspan="10" align="center">暂无数据</td>
                            </tr>
                        @endif
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix text-center">
                    {{ $rule->links() }}
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col-md-12 -->
    </div>
    <!-- /.row -->
</section>

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- toastr -->
<script src="{{ asset('bower_components/toastr/build/toastr.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
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