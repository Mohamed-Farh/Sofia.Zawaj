@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('الاعـلانـات') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('الاعـلانـات') }}
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
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{__('اضـافـة')}}
                </button>
            @endif
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('الصورة') }}</th>
                            <th>{{__('العنوان') }}</th>
                            <th>{{__('نص الاعلان') }}</th>
                            <th>{{__('بلد العرض') }}</th>
                            {{-- <th>{{__('الرابط') }}</th> --}}
                            <th>{{ trans('users_trans.created_at') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{__('الـحـالـة')}}</th>
                                <th>{{ trans('users_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($advs as $adv)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>

                                <td><img class="img-responsive thumbnail" src="{{url('image/advertising/'.$adv->image)}}" style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>

                                <td>{{ $adv->name }}</td>
                                <td>{{ $adv->word }}</td>
                                <td>{{ $adv->country }}</td>
                                {{-- <td>{{ $adv->link }}</td> --}}
                                <td>{{ $adv->created_at->diffForHumans() }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))

                                    <td>
                                        @if  ($adv->status == '1')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_contact{{ $adv->id }}"
                                            title="{{ trans('عـرض') }}"> <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                        @elseif ($adv->status == '0')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_contact{{ $adv->id }}"
                                            title="{{ trans('اخـفـاء') }}"> <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}} </button>
                                        @endif
                                    </td>

                                    <td class="#">
                                        <button type="button" class="btn btn-info btn-sm given" data-toggle="modal"
                                            data-target="#edit{{ $adv->id }}"
                                            title="{{ trans('users_trans.Edit') }}"><i class="fa fa-edit"></i></button>

                                            @if (auth()->user()->hasRole('super_admin'))
                                                <form action="{{ route('advs.destroy', 'test') }}" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $adv->id }}">
                                                    <button type="button" class="btn btn-danger btn-sm given"
                                                        onclick="confirm('{{ __("هل انت متاكد من عملية الحذف ؟") }}') ? this.parentElement.submit() : ''" style="position:absolute; margin-right: 20px; margin-top:-26px;"><i class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                    </td>
                                @endif
                            </tr>

                            <!-- edit_modal_user -->
                            <div class="modal fade" id="edit{{ $adv->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('تعديل الاعلان') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('advs.update', 'test') }}" method="post" enctype="multipart/form-data">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $adv->id }}">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="name" class="mr-sm-2 space_top">{{ trans('العنوان') }} :</label>
                                                        <input id="name" type="text" name="name" class="form-control" value="{{ $adv->name }}" required autocomplete="name" autofocus>
                                                    </div>

                                                    <div class="col-md-12  make-space">
                                                        <label for="word"
                                                            class="mr-sm-2">{{ __('نص العنوان') }}
                                                            : <span style="color: red"> * </span> </label>
                                                        <textarea class="form-control" name="word" rows="5">{{ $adv->word }}</textarea>
                                                        @error('word')<span
                                                            class="text-danger">{{ $message }}</span>@enderror
                                                    </div>

                                                    <div class="col-md-12  make-space">
                                                        <label class="mr-sm-2" for="country">{{__('بلد العرض') }} : </label>
                                                        <select name="country" required class="form-control custom-select selectpicker">
                                                            <option value="كل الدول"                   <?php if($adv->country == "كل الدول") echo "selected"; ?>  >كل الدول</option>
                                                            {{-- <?php $all_countries = \App\Models\Country::where('status', 1)->get(['id', 'name']); ?>
                                                            @forelse ($all_countries as $country)
                                                                <option value="{{ $country->name }}" {{ old('country', $adv->country) == $country->name ? 'selected' : null }}>{{ $country->name }}</option>
                                                            @empty
                                                            @endforelse --}}

                                                            <option value="" style="background-color: grey; color:white"  disabled>{{__("الوطن العربي") }}</option>
                                                            <?php $countries = \App\Models\Country::where('status', 1)->where('arabic', '1')->orderBy('name', 'asc')->get(['id', 'name']); ?>
                                                            @forelse ($countries as $country)
                                                                <option value="{{ $country->name }}" {{ old('country', $adv->country) == $country->name ? 'selected' : null }}>{{ $country->name }}</option>
                                                            @empty
                                                            @endforelse
                                                            <option value="" style="background-color: grey; color:white"  disabled>{{__("باقي دول العالم") }}</option>
                                                            <?php $countries = \App\Models\Country::where('status', 1)->where('arabic', '0')->orderBy('name', 'asc')->get(['id', 'name']); ?>
                                                            @forelse ($countries as $country)
                                                                <option value="{{ $country->name }}" {{ old('country', $adv->country) == $country->name ? 'selected' : null }}>{{ $country->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </div>


                                                    <div class="col-md-12  make-space">
                                                        <label for="image" class="mr-sm-2">{{__('الصورة الخاصة بالاعلان') }} : </label>
                                                        <input type="file" class="form-control" name="image">
                                                        @if ($errors->has('image'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('image') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- <div class="col-md-12">
                                                        <label for="link" class="mr-sm-2 space_top">{{ trans('الرابط') }} :</label>
                                                        <input id="link" type="text" name="link" class="form-control" value="{{ $adv->link }}" required autocomplete="link" autofocus>
                                                    </div> --}}
                                                    <br><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('users_trans.Close') }}</button>
                                                    <button type="submit" class="btn btn-success">{{ trans('users_trans.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Make_contact_Visible -->
                            <div class="modal fade" id="vis_contact{{ $adv->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('عرض / اخفاء بالصفحة الرئيسية') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('advs/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                    @if  ($adv->status == '1')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @elseif ($adv->status == '0')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $adv->id }}">
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
                    {{ trans('اضافة اعلان جديدة') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('advs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name" class="mr-sm-2 space_top">{{ trans('عنوان') }} :</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>

                        <div class="col-md-12  make-space">
                            <label for="word"
                                class="mr-sm-2">{{ __('نص الاعلان') }}
                                : <span style="color: red"> * </span> </label>
                            <textarea class="form-control" name="word" rows="5"></textarea>
                            @error('word')<span
                                class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-12  make-space">
                            <label class="mr-sm-2" for="country">{{__('مكان العرض') }} : </label>
                            <select name="country" required class="form-control custom-select selectpicker">
                                <option value="كل الدول">كل الدول</option>
                                <option value="" style="background-color: grey; color:white" disabled>
                                    {{ __('الوطن العربي') }}</option>
                                <?php $countries = \App\Models\Country::where('status', 1)
                                    ->where('arabic', '1')
                                    ->orderBy('name', 'asc')
                                    ->get(['id', 'name']); ?>
                                @forelse ($countries as $country)
                                    <option value="{{ $country->name }}"
                                        {{ old('country') == $country->name ? 'selected' : null }}>
                                        {{ $country->name }}</option>
                                @empty
                                @endforelse
                                <option value="" style="background-color: grey; color:white" disabled>
                                    {{ __('باقي دول العالم') }}</option>
                                <?php $countries = \App\Models\Country::where('status', 1)
                                    ->where('arabic', '0')
                                    ->orderBy('name', 'asc')
                                    ->get(['id', 'name']); ?>
                                @forelse ($countries as $country)
                                    <option value="{{ $country->name }}"
                                        {{ old('country') == $country->name ? 'selected' : null }}>
                                        {{ $country->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>


                        <div class="col-md-12  make-space">
                            <label for="image" class="mr-sm-2">{{__('الصورة الخاصة بالاعلان') }} : </label>
                            <input type="file" class="form-control" name="image">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>

                        {{-- <div class="col-md-12">
                            <label for="link" class="mr-sm-2 space_top">{{ trans('الرابط') }} :</label>
                            <input id="link" type="text" name="link" class="form-control" value="{{ old('link') }}" required autocomplete="link" autofocus>
                        </div> --}}
                        <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('users_trans.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('users_trans.submit') }}</button>
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

