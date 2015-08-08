@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $job->name }}[{{ $job->command }}]  调度历史</div>
				<div class="panel-body">
                    <div>
                        <table class="table table-striped">
                            <tr class="row">
                                <th class="col-lg-1">调度ID</th>
                                <th class="col-lg-1">执行机器</th>
                                <th class="col-lg-1">开始时间</th>
                                <th class="col-lg-1">结束时间</th>
                                <th class="col-lg-1">是否运行</th>
                                <th class="col-lg-1">退出码</th>
                                <th class="col-lg-2">结果</th>
                                <th class="col-lg-4">操作</th>
                            </tr>
                            @foreach ($schedules as $schedule)
                            <tr class="row">
                                <td>
                                    {{ $schedule->id }}
                                </td>
                                <td>
                                    {{ $schedule->worker }}
                                </td>
                                <td>
                                    {{ date('Y-m-d H:i:s', $schedule->gmt_start) }}
                                </td>
                                <td>
                                    {{ date('Y-m-d H:i:s', $schedule->gmt_end) }}
                                </td>
                                <td>
                                    {{ $schedule->is_running }}
                                </td>
                                <td>
                                    {{ $schedule->exit_code }}
                                </td>
                                <td>
                                    {{ $schedule->result }}
                                </td>
                                <td>
                                    <form action="{{ URL('job/schedule/'. $schedule->id) }}" method="POST" style="display: inline;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-sm btn-danger">取消</button>
                                    </form>
                                    <a href="{{ URL('job/log/' . $schedule->id) }}" class="btn btn-sm">日志</a>
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
