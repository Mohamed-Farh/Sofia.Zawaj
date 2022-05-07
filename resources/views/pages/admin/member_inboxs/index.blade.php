@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
{{ trans(' صندوق الرسائل') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans(' صندوق الرسائل') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

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

            {{-- @if (auth()->user()->hasRole(['super_admin', 'super_admin_join', 'admin_join'])) --}}
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ __('اضـافـة') }}
                </button>
            {{-- @endif --}}
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('homy_trans.avatar') }}</th>
                            <th>{{ trans('admins_trans.Name') }}</th>
                            <th>{{ trans('عنوان الرسالة') }}</th>
                            <th>{{ __('الرسالة') }}</th>
                            <th>{{ trans('تاريخ الرسالة') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ trans('عرض الرسالة') }}</th>
                                <th>{{ trans('حالة الرسالة') }}</th>
                                <th>{{ trans('social_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                        ?>

                        @foreach ($member_inboxs as $inbox)
                            @if ($inbox)
                                <tr>
                                    <?php
                                        $i++;
                                            $member = \App\Models\Member::where('id', $inbox->member_id )->first();
                                            $sender_member = \App\Models\Member::where('id', $inbox->sender_member_id )->first();
                                        ?>
                                    <td>{{ $i }}</td>

                                    @if($member->image != '')
                                        <td><img class="img-responsive thumbnail" src="{{url('image/members/'.$sender_member->image)}}" style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                    @else
                                        <td><img class="img-responsive thumbnail" src="{{url('image/members/avatar.png')}}" style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                    @endif

                                    <td>{{ $sender_member->name }}</td>

                                    <td>{{ $inbox->subject }}</td>
                                    <td>{{ $inbox->message }}</td>

                                    <td>{{ $inbox->created_at->diffForHumans() }}</td>

                                    @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                        <td>
                                            @if  ($inbox->show == '0')
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#comment{{ $inbox->id }}"
                                                title="{{ trans('social_trans.Delete') }}"><i class="fa fa-eye-slash"></i> {{__('اخفاء')}}</button>
                                            @elseif ($inbox->show == '1')
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#comment{{ $inbox->id }}"
                                                title="{{ trans('social_trans.Delete') }}"><i class="fa fa-eye"></i> {{__('عرض')}}</button>
                                            @endif
                                        </td>

                                        <td>
                                            @if  ($inbox->read == '0')
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#read{{ $inbox->id }}"
                                                title="{{ trans('social_trans.Delete') }}"><i class="fa fa-eye-slash"></i> {{__('انتظار')}}</button>
                                            @elseif ($inbox->read == '1')
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#read{{ $inbox->id }}"
                                                title="{{ trans('social_trans.Delete') }}"><i class="fa fa-eye"></i> {{__('تم القراءة')}}</button>
                                            @endif
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $inbox->id }}"
                                                title="{{ trans('category_trans.Edit') }}"><i class="fa fa-edit"></i></button>

                                            @if (auth()->user()->hasRole('super_admin'))
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $inbox->id }}"
                                                title="{{ trans('category_trans.Delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                            @endif
                                        </td>
                                    @endif
                                </tr>


                                <!-- edit_modal_feature -->
                                <div class="modal fade" id="edit{{ $inbox->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{__('تعديل الكومنت') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('member_inboxs.update', 'test') }}" method="post"
                                                enctype="multipart/form-data" autocomplete="off">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $inbox->id }}">

                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="subject" class="mr-sm-2">{{ trans('عنوان الرسالة') }} : <span style="color: red"> *
                                                                </span> </label>
                                                                <input type="text" class="form-control" name="subject" value="{{ $inbox->subject }}">
                                                                @if ($errors->has('subject'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('subject') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="message" class="mr-sm-2">{{ trans('الرسالة') }} : <span style="color: red"> *
                                                                </span> </label>
                                                            <textarea name="message" class="form-control"  rows="8" >{{ $inbox->message }}</textarea>
                                                            @if ($errors->has('message'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('message') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label class="mr-sm-2" for="sender_member_id">{{ __('الشخص مرسل الرسالة') }} : <span
                                                                    style="color: red"> * </span> </label>
                                                            <select name="sender_member_id" required class="form-control custom-select selectpicker">
                                                                <option value="0"> {{ __('اخـتـر---') }} </option>
                                                                @foreach (\App\Models\Member::get() as $sender_member)
                                                                    <option value="{{ $sender_member->id }}" <?php if ($inbox->sender_member_id == $sender_member->id) { echo 'selected'; } ?>> {{ $sender_member->name }} </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('sender_member_id'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('sender_member_id') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('اغــلاق') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-success">{{ __('حفظ البيانات') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Make_comment_Visible -->
                                <div class="modal fade" id="comment{{ $inbox->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('social_trans.edit_social') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('/member_inbox/visible', 'test') }}" method="post">
                                                    {{ method_field('post') }}
                                                    @csrf
                                                        @if  ($inbox->show == '0')
                                                            {{ trans('social_trans.unvisible_social') }}
                                                        @elseif ($inbox->show == '1')
                                                            {{ trans('social_trans.visible_social') }}
                                                        @endif
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $inbox->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">{{ trans('social_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-info">{{ trans('social_trans.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Make_comment_Read -->
                                <div class="modal fade" id="read{{ $inbox->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('social_trans.edit_social') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('/member_inbox/read', 'test') }}" method="post">
                                                    {{ method_field('post') }}
                                                    @csrf
                                                        @if  ($inbox->read == '0')
                                                            {{ trans('هل انت متاكد انك قمت بقراءة الرسالة جيدا ؟') }}
                                                        @elseif ($inbox->read == '1')
                                                            {{ trans('هل انت متاكد من تغيير حالة الرسالة من مقروءة الي قائمة الانتظار ؟') }}
                                                        @endif
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $inbox->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">{{ trans('social_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-info">{{ trans('social_trans.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- delete_modal_feature -->
                                <div class="modal fade" id="delete{{ $inbox->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('feature_trans.Delete') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('member_inboxs.destroy', 'test') }}" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('feature_trans.Warning_feature') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $inbox->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('feature_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ trans('front_trans.Delete') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_social -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ __('اضـافـة') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('member_inboxs.store') }}" method="POST" enctype="multipart/form-data"
                autocomplete="off">
                    @csrf
                    <input type="hidden" class="form-control" name="member_id" value="{{ $member->id }}">

                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="subject" class="mr-sm-2">{{ trans('عنوان الرسالة') }} : <span style="color: red"> *
                                </span> </label>
                                <input type="text" class="form-control" name="subject">
                            @if ($errors->has('subject'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="message" class="mr-sm-2">{{ trans('الرسالة') }} : <span style="color: red"> *
                                </span> </label>
                            <textarea name="message" class="form-control" rows="8" ></textarea>
                            @if ($errors->has('message'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group modual_space">
                        <div class="col">
                            <label class="mr-sm-2" for="sender_member_id">{{ __('الشخص مرسل الرسالة') }} : <span
                                    style="color: red"> * </span> </label>
                            <select name="sender_member_id" required class="form-control custom-select selectpicker">
                                <option value="0"> {{ __('اخـتـر---') }} </option>
                                @foreach (\App\Models\Member::get() as $sender_member)
                                    <option value="{{ $sender_member->id }}"> {{ $sender_member->name }} </option>
                                @endforeach
                            </select>
                            @if ($errors->has('sender_member_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('sender_member_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('اغــلاق') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('حفظ البيانات') }}</button>
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
