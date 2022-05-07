@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ 'باقات التمييز' }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ 'باقات التمييز' }}
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
                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                    <button type="button" class="button x-small">
                        <a href="{{ route('packages.create') }}">{{ trans('اضافة باقة جديدة') }}</a>
                    </button>
                @endif

                <br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('اسم الباقة') }}</th>
                                <th>{{__('مدة الباقة') }}</th>
                                <th>{{__('سعر الباقة') }}</th>
                                <th>{{__('مميزات الباقة') }}</th>
                                <th>{{__('تاريخ اضافتها') }}</th>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <th>{{__('الحالة') }}</th>
                                    <th>{{ trans('property_trans.Processes') }}</th>
                                @endif
                            </tr>
                        </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @forelse ($packages as $package)
                                    <tr>
                                        <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{ $package->name }}</td>
                                        <td>{{ $package->month_no }}</td>
                                        <td>{{ $package->price }}</td>

                                        <td><a href="/package/show_package_features/{{ $package->id }}" target="_blank" style="color: blue">{{trans('عرض المميزات')}}</a></td>

                                        <td>{{ $package->created_at->diffForHumans() }}</td>
                                        @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                            <td>
                                                @if  ($package->status == '0')
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#vis_package{{ $package->id }}" > <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}}</button>
                                                @elseif ($package->status == '1')
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#vis_package{{ $package->id }}" > <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('packages.show', $package) }}"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></button></a>
                                                <a href="{{ route('packages.edit', $package) }}"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{ $package->id }}"
                                                    title="{{ trans('Grades_trans.Delete') }}"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        @endif
                                    </tr>



                                    <!-- Make_package_Visible -->
                                    <div class="modal fade" id="vis_package{{ $package->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{__('عـرض/اخـفاء بالصـفحـة الرئيـسـيـة') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('packages/visible', 'test') }}" method="post">
                                                        {{ method_field('post') }}
                                                        @csrf
                                                            @if  ($package->status == '1')
                                                                           {{__('هـل أنـت مـتـأكـد مـن اظـهـار هـذة الـبـاقـة ')}}
                                                            @elseif ($package->status == '0')
                                                            {{__('هـل أنـت مـتـأكـد مـن اخـفـاء هـذة الـبـاقـة ')}}
                                                            @endif
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $package->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{__('اغــلاق')}}</button>
                                                            <button type="submit"
                                                                class="btn btn-info">{{__('حفظ البيانات') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete_modal_package -->
                                    <div class="modal fade" id="delete{{ $package->id }}" tabindex="-1" role="dialog"
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
                                                    <form action="{{ route('packages.destroy', 'test') }}" method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        {{ trans('هل أنت متأكد من حذف هذة الباقة نهائياً ؟') }}
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $package->id }}">
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
                                        <td colspan="12" class="text-center">No Packages Were Found</td>
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


