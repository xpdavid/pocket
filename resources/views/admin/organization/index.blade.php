@extends('layout._admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">管理颁奖机构</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    @include('admin.generic_index', ['table_id' => 'organization_table'])




@endsection