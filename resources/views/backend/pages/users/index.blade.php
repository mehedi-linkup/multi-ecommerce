@extends('backend.layouts.admin_master')

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">All User</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-user"></i> 
                    @php
                        $online_user = 0;
                    @endphp
                    
                    @foreach($users as $row)
                        @php
                            if($row->userIsOnline()){
                                $online_user = $online_user + 1;
                            }
                        @endphp
                    @endforeach
                    
                    Total User: <span class="badge badge-success">{{ count($users) }}</span>
                    And Active User : <span class="badge badge-warning">{{ $online_user }}</span>
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Online/Offline</th>
                                <th>Account</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="{{ $user->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td><img src="{{ asset('frontend/media/'.$user->image) }}" width="60" height="60" alt=""></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    @if($user->userIsOnline())
                                        <span class="badge badge-pill badge-success">Active Now</span>
                                    @else
                                        {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                    @endif
                                </td>
                                <td>
                                    @if($user->isban == 0)
                                        <span class="badge badge-pill badge-primary">Unbanned</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Banned</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->isban == 0)
                                        <a href="{{ route('admin.user.banned', $user->id) }}" title="Banned" class="btn btn-danger btn-sm"><i class="fa fa-user-times"></i></a>
                                    @else
                                        <a href="{{ route('admin.user.unbanned', $user->id) }}" title="Unbanned" class="btn btn-success btn-sm"><i class="fa fa-user"></i></a>
                                    @endif
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
