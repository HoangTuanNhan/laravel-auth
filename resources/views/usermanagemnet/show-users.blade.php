@extends('layouts.app')
@section('title', Lang::get('usersmanagement.user-management'))
@section('template_linked_css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }
        .users-table tr td:first-child {
            padding-left: 15px;
        }
        .users-table tr td:last-child {
            padding-right: 15px;
        }
        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: 0;
        }

    </style>
@endsection

@section('content')
       <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                @lang('usersmanagement.showing-all-users')
                            </span>

                            <div class="btn-group pull-right btn-group-xs">

                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        @lang('usersmanagement.show user management menu')
                                    </span>
                                </button>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/users/create">
                                            <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                            @lang('usersmanagement.create new user')
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/users/deleted">
                                            <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                            @lang('usersmanagement.show delete user')
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">

                        @include('partials.search-users-form')

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-condensed data-table">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th class="hidden-xs">Email</th>
                                        <th class="hidden-xs">First Name</th>
                                        <th class="hidden-xs">Last Name</th>
                                        <th>Role</th>
                                        <th class="hidden-sm hidden-xs hidden-md">Created</th>
                                        <th class="hidden-sm hidden-xs hidden-md">Updated</th>
                                        <th>Actions</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td class="hidden-xs"><a href="mailto:{{$user->email}}">{{$user->email}}}</a></td>
                                            <td class="hidden-xs">{{$user->first_name}}</td>
                                            <td class="hidden-xs">{{$user->last_name}}</td>
                                            <td>
                                                @foreach($user->roles as $role)
                                                    @if($role->name == 'User')
                                                        <?php $labelClass = 'primary' ?>
                                                    @endif
                                                     @if($role->name == 'Admin')
                                                        <?php $labelClass = 'warning' ?>
                                                    @endif
                                                     @if($role->name == 'Unverified')
                                                        <?php $labelClass = 'default' ?>
                                                    @endif
                                                    <span class="label label-{{$labelClass}}">{{$role->name}}</span>
                                                @endforeach
                                            </td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$user->created_at}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$user->updated_at}}</td>
                                            <td>
                                                {!! Form::open(array('url' => 'users/' . $user->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Delete</span><span class="hidden-xs hidden-sm hidden-md"> User</span>', array('class' => 'btn btn-danger btn-sm', 'type'=> 'button', 'style' =>'width: 100%;', 'data-toggle'=> 'modal', 'data-target'=> '#confirmDelete')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-success btn-block" href="{{url('users/'.$user->id)}}" data-toggle="tooltip" title="Show">
                                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Show</span><span class="hidden-xs hidden-sm hidden-md"> User</span>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="#" data-toggle="tooltip" title="Edit">
                                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Edit</span><span class="hidden-xs hidden-sm hidden-md"> User</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                            </table>

                            <span id="user_count"></span>
                            <span id="user_pagination">
                                 {{ $users->links() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     @include('modals.modal-delete')
@endsection
@section('footer_scripts')

    @include('scripts.delete-modal-script')
   

@endsection


