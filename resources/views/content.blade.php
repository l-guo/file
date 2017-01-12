@extends(config("fileconfig.extends"))
@section('content')
    <section class="content-header">
        <h1>
            文件系统
        </h1>
    </section>
    @include('file::message')
    <section class="content">
        <div class="box" id="list">
            <div class="box-body">
                <form action="/file/update" method="post">
                    <div class="row" style="margin-bottom: 20px; padding-right:2%; text-align: right">
                        {{ csrf_field() }}
                        @if($type=='update')
                            <a href="/lists?dir={{$dir}}" class="btn btn-default">取消</a>
                            <input type="submit" class="btn btn-primary" value="保存">
                        @else
                            <a href="/file/select?dir={{$dir}}" class="btn btn-default">编辑</a>
                            <a href="/file/delete?dir={{$data}}" class="btn btn-danger">删除</a>
                        @endif
                    </div>
                    <input type="hidden" name="file" value="{{$dir}}">

                    @if($type=='update')
                        <textarea rows="100" name="content" style="width: 100%">{{$data}}</textarea>
                    @else
                        <pre>{{$data}}</pre>
                    @endif
                </form>

            </div>
        </div>
    </section>

@endsection


