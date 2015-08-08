@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">任务列表</div>
				<div class="panel-body">
                    <div class="panel-title">
                        <a href="{{ URL('job/create') }}" class="btn btn-lg">新增</a>
                    </div>
                    <div>
                        <table class="table table-striped">
                            <tr class="row">
                                <th class="col-lg-1">id</th>
                                <th class="col-lg-2">名称</th>
                                <th class="col-lg-1">类型</th>
                                <th class="col-lg-1">命令</th>
                                <th class="col-lg-2">执行计划</th>
                                <th class="col-lg-2">创建时间</th>
                                <th class="col-lg-4">操作</th>
                            </tr>
                            @foreach ($jobs as $job)
                            <tr class="row">
                                <td>
                                    {{ $job->id }}
                                </td>
                                <td>
                                    {{ $job->name }}
                                </td>
                                <td>
                                    @if ($job->type == 0)                                    
                                        固定间隔
                                    @else
                                        持续运行
                                    @endif
                                </td>
                                <td>
                                    {{ $job->command }}
                                </td>
                                <td>
                                    @if ($job->type == 0)                                    
                                        {{ $job->period }}
                                    @endif
                                </td>
                                <td>
                                    {{ date('Y-m-d H:i:s', $job->gmt_create) }}
                                </td>
                                <td>
                                    <form action="{{ URL('job/destroy/'. $job->id) }}" method="POST" style="display: inline;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-sm btn-danger">删除</button>
                                    </form>
                                    <a href="{{ URL('job/edit/' . $job->id) }}" class="btn btn-sm">更新</a>
                                    <a href="{{ URL('job/schedule/' . $job->id) }}" class="btn btn-sm">执行</a>
                                </td>
                            </tr>
                            @endforeach
                        </table> 
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
