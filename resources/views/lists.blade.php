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
                <div id="example2_wrapper" class="dataTables_wrapper  dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <div>
                                <div>
                                    <div class='body-box'>
                                        @if (count($file) > 0 || count($dir) > 0 )
                                            <table id="example2"
                                                   class="table table-bordered table-hover dataTable"
                                                   role="grid" aria-describedby="example2_info">
                                                <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0"
                                                        aria-controls="example2" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        文件或文件夹
                                                    </th>
                                                    <th class="sorting" tabindex="0"
                                                        aria-controls="example2" rowspan="1"
                                                        colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        操作
                                                    </th>


                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if (count($dir) > 0  )
                                                    @foreach($dir as $data)
                                                        <tr role="row" class="odd">
                                                            <td class="sorting_1"><a href="/lists?dir={{$data}}">{{$data}}</a></td>
                                                            <td class="sorting_1"><a href="/file/delete?dir={{$data}}" class="btn btn-danger">删除</a></td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                @if (count($file) > 0  )
                                                @foreach($file as $data)
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1"><a href="/lists?dir={{$data}}">{{$data}}</a></td>
                                                        <td class="sorting_1">
                                                            <a href="/lists?dir={{$data}}" class="btn btn-default">编辑</a>
                                                            <a href="/file/delete?dir={{$data}}" class="btn btn-danger">删除</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @endif

                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


