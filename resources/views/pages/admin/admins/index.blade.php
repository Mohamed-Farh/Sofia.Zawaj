@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('الادمــن') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('الادمــن') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    @if ($errors->any())
        <div class="error">{{ $errors->first('Name') }}</div>
    @endif



    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('admins_trans.add_user') }}
                </button>
                <br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('admins_trans.Name') }}</th>
                                <th>{{ trans('admins_trans.email') }}</th>
                                <th>{{ __('مـهـمـتـه') }}</th>
                                <th>{{ trans('admins_trans.created_at') }}</th>
                                <th>{{ trans('admins_trans.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($users as $user)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $index => $role)
                                            {{ $role->display_name }}
                                            {{ $index + 1 < $user->roles->count() ? ',' : '' }}
                                        @endforeach
                                    </td>

                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $user->id }}"
                                            title="{{ trans('admins_trans.Edit') }}"><i
                                                class="fa fa-edit"></i></button>

                                        @if ($user->id != auth()->id())
                                            <form action="{{ route('admins.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $user->id }}">
                                                <button type="button" class="btn btn-danger btn-sm given"
                                                    onclick="confirm('{{ __('Are You Sure You Want To Delete This Admin ?') }}') ? this.parentElement.submit() : ''"
                                                    style="position:absolute;     margin-right: 20px;
                                                margin-top: -27px;"><i class="fa fa-trash"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>

                                <!-- edit_modal_user -->
                                <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('admins_trans.edit_user') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('users.update', 'test') }}" method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="col-md-12 make-space">
                                                                <label for="name"
                                                                    class="mr-sm-2">{{ trans('admins_trans.name') }}
                                                                    :</label>
                                                                <input id="name" type="text" name="name"
                                                                    class="form-control" value="{{ $user->name }}"
                                                                    required>
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $user->id }}">
                                                            </div>

                                                            <div class="col-md-12 make-space">
                                                                <label for="email"
                                                                    class="mr-sm-2">{{ trans('admins_trans.email') }}
                                                                    :</label>
                                                                <input type="email" class="form-control" name="email"
                                                                    value="{{ $user->email }}">
                                                            </div>

                                                            <div class="col-md-12 make-space">
                                                                <label for="password"
                                                                    class="mr-sm-2">{{ trans('admins_trans.password') }}
                                                                    :</label>
                                                                <input type="password" class="form-control"
                                                                    name="password" value="">
                                                            </div>

                                                            <div class="col-md-12 make-space">
                                                                <label class="mr-sm-2"
                                                                    for="input-password-confirmation">{{ trans('admins_trans.confirm_password') }}
                                                                    :</label>
                                                                <input type="password" name="password_confirmation"
                                                                    id="input-password-confirmation"
                                                                    class="form-control" value="">
                                                            </div>

                                                            <div class="col-md-12 make-space">
                                                                <label class="mr-sm-2"
                                                                    for="roles">{{ __('المهمة / النوع') }} :</label>
                                                                <br>
                                                                <?php $roles = \App\Role::all(); ?>
                                                                @foreach ($roles as $role)
                                                                    <input type="checkbox" name="roles[]"
                                                                        value="{{ $role->name }}"
                                                                        {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                                                    {{ $role->display_name }} <br>
                                                                @endforeach
                                                            </div>
                                                            <br><br>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('admins_trans.Close') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">{{ trans('admins_trans.submit') }}</button>
                                                            </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- delete_modal_user -->
                                {{-- <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('admins_trans.delete_user') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admins.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('admins_trans.Warning_user') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $user->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('admins_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ trans('admins_trans.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}


                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- add_modal_user -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('admins_trans.add_user') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('admins.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="admin" value="1" id="admin">
                        <div class="row">
                            <div class="col-md-12 make-space">
                                <label for="name" class="mr-sm-2">{{ trans('admins_trans.name') }} :</label>
                                <input id="name" type="text" name="name" class="form-control"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>

                            <div class="col-md-12 make-space">
                                <label for="email" class="mr-sm-2">{{ trans('admins_trans.email') }} :</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    required autocomplete="email">
                            </div>

                            <div class="col-md-12 make-space">
                                <label for="password" class="mr-sm-2">{{ trans('admins_trans.password') }}
                                    :</label>
                                <input type="password" class="form-control" name="password" required
                                    autocomplete="new-password">
                            </div>

                            <div class="col-md-12 make-space">
                                <label class="mr-sm-2"
                                    for="input-password-confirmation">{{ trans('admins_trans.confirm_password') }}
                                    :</label>
                                <input type="password" name="password_confirmation" id="input-password-confirmation"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-12 make-space">
                                <label class="mr-sm-2" for="roles">{{ __('المهمة / النوع') }} :</label> <br>
                                <?php $roles = \App\Role::all(); ?>
                                @foreach ($roles as $role)
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}">
                                    {{ $role->display_name }} <br>
                                @endforeach
                            </div>
                            <br><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('admins_trans.Close') }}</button>
                            <button type="submit" class="btn btn-success">{{ trans('admins_trans.submit') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
