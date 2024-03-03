@extends('backend.layouts.admin_master')

@section('permissions')
active show-sub
@endsection()

@section('all-permission')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Permission Management</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-list"></i> Permission List
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr class="{{ $permission->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $permission->role->name }}</td>
                                <td>
                                    <a href="{{ route('permission.edit',$permission->id) }}" class="btn btn-success btn-sm" style="float: left; margin-right: 5px;"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('permission.destroy',$permission->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                      <button class="btn btn-sm btn-danger" title="delete data" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div>

    </div><!-- row -->
</div><!-- sl-pagebody -->
@endsection
