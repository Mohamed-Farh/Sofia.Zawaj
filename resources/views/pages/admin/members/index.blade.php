@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ $title_name }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ $title_name }}
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

                <div class="row">
                    <div class="col">
                        @if (auth()->user()->hasRole(['super_admin', 'admin']))
                            {!! Form::open(['route' => 'members.create', 'method' => 'get']) !!}
                                {!! Form::submit( 'اضافة زوج', ['class' => 'button x-small', 'name' => 'submitbutton', 'value' => 'ذكر'])!!}

                                {!! Form::submit( 'اضافة زوجة', ['class' => 'button x-small', 'name' => 'submitbutton', 'value' => 'أنثي'])!!}
                            {!! Form::close() !!}
                        @endif
                    </div>
                    <div class="col">
                        <button type="button" class="button x-small" style="float: left">
                            <a href="{{ route('show_filter_page') }}">{{ trans('فلترة الاعضاء') }}</a>
                        </button>
                    </div>
                </div>
                <br><br>



                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        {{-- @include('pages.admin.properties.filter') --}}
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('الصورة') }}</th>
                                <th>{{__('الاسم') }}</th>
                                <th>{{__('العمر') }}</th>
                                <th>{{__('البريد الالكتروني') }}</th>
                                <th>{{__('النوع') }}</th>
                                <th>{{__('البلد') }}</th>
                                <th>{{__('المدينة') }}</th>
                                <th>{{__('الجنسية') }}</th>
                                <!--<th>{{__('ثنائي الجنسية') }}</th>-->
                                <th>{{__('نوع الزواج') }}</th>
                                <th>{{__('الحالة الاجتماعية') }}</th>
                                <th>{{__('تاريخ انضمامة') }}</th>
                                <th>{{__('صندوق الرسائل') }}</th>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <th>{{ trans('property_trans.Processes') }}</th>
                                @endif
                            </tr>
                        </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @forelse ($members as $member)
                                    <tr>
                                        <?php $i++; ?>
                                        <td>{{ $i }}</td>

                                        @if($member->image != '')
                                            <td><img class="img-responsive thumbnail" src="{{url('image/members/'.$member->image)}}" style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                        @else
                                            <td><img class="img-responsive thumbnail" src="{{url('image/members/avatar.png')}}" style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                        @endif

                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->age }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->gender }}</td>
                                        <td>{{ $member->country }}</td>
                                        <td>{{ $member->city }}</td>
                                        <td>{{ $member->nationality }}</td>
                                        <!--<td>{{ $member->dual_nationality }}</td>-->
                                        <td>{{ $member->marriage_type }}</td>
                                        <td>{{ $member->marital_status }}</td>
                                        <td>{{ $member->created_at->diffForHumans() }}</td>

                                        <td><a href="/member/show_member_inboxs/{{ $member->id }}" target="_blank" style="color: blue">{{trans('عرض الرسائل')}}</a></td>

                                        <td class="property-td">
                                            {{-- <button type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></button> --}}
                                            <a href="{{ route('members.show', $member) }}"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></button></a>
                                            <a href="{{ route('members.edit', $member) }}"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $member->id }}"
                                                title="{{ trans('Grades_trans.Delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>



                                    <!-- delete_modal_member -->
                                    <div class="modal fade" id="delete{{ $member->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('حذف عضو') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('members.destroy', 'test') }}" method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        {{ trans('هل أنت متأكد من حذف هذا العضو نهائياً ؟') }}
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $member->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('إغلاق') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ trans('front_trans.Delete') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                @empty
                                    <tr>
                                        <td colspan="14" class="text-center">No Members Were found</td>
                                    </tr>
                                @endforelse
                            </table>
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


