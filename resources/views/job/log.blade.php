@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $job->name }}[{{ $job->command }}] 执行日志</div>
				<div class="panel-body">
                    <div>
                        <table class="table table-striped">
                            <tr class="row">
                                <th class="col-lg-1">任务ID</th>
                                <th class="col-lg-1">任务名称</th>
                                <th class="col-lg-1">调度ID</th>
                                <th class="col-lg-7">日志</th>
                                <th class="col-lg-2">时间</th>
                            </tr>
                            @foreach ($logs as $log)
                            <tr class="row">
                                <td>
                                    {{ $job->id }}
                                </td>
                                <td>
                                    {{ $job->name }}
                                </td>
                                <td>
                                    {{ $log->schedule_id }}
                                </td>
                                <td>
                                    {{ $log->log }}
                                </td>
                                <td>
                                    {{ date('Y-m-d H:i:s', $log->gmt_create) }}
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
