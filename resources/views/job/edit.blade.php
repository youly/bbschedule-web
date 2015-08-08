@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">更新任务</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>糟了个糕!</strong> 请检查输入<br><br>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <form class="" action="{{ URL('job/update/' . $job->id) }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label>名称</label>
                            <input type="text" name="name" class="form-control" required="required" value="{{ $job->name }}">
                        </div> 
                        <div class="form-group">
                            <label>命令</label>
                            <input type="text" name="command" class="form-control" required="required" value="{{ $job->command }}">
                        </div>
                        <div class="form-group">
                            <label>类型</label>
                        </div>
                        <div class="radio">
                            <label>
                                @if ($job->type == 0)
                                <input type="radio" name="type" id="type0" value="0" checked>
                                @else
                                <input type="radio" name="type" id="type0" value="0">
                                @endif
                                固定间隔
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                @if ($job->type == 1)
                                <input type="radio" name="type" id="type1" value="1" checked>
                                @else
                                <input type="radio" name="type" id="type1" value="1">
                                @endif
                                持续运行
                            </label>
                        </div> 
                        <div class="form-group">
                            <label>优先级</label>
                            <input type="text" name="priority" class="form-control" required="required" value="{{ $job->priority }}">
                        </div> 
                        <div class="form-group">
                            <label>并发度</label>
                            <input type="text" name="concurrent" class="form-control" required="required" value="{{ $job->concurrent }}">
                        </div> 
                        <div class="form-group">
                            <label>调度计划</label>
                            <input type="text" name="period" class="form-control" required="required" placeholder="crontab表达式，支持到秒，例如1s运行一次，1/1 * * * * *。持续运行的任务无需填写" value="{{ $job->period }}">
                        </div> 
                        <div class="form-group">
                            <label>最大运行时间</label>
                            <input type="text" name="maxtime" class="form-control" required="required" placeholder="单位秒" value={{ $job->maxtime }}>
                        </div> 
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">更新</button>
                        </div> 
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
