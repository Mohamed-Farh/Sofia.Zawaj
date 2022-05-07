@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{ trans('front_trans.company_location') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('front_trans.company_location') }}
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

            <?php
                $company_locations = \App\Models\Company_Location::all();
            ?>

            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('front_trans.add') }}
                </button>
            @endif
            <br><br>

            <!--start about us section-->
            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('front_trans.country') }}</th>
                            <th>{{ trans('front_trans.city') }}</th>
                            <th>{{ trans('front_trans.address') }}</th>
                            <th> {{__('خدمة العملاء') }}</th>
                            <th> {{__('الواتس') }}</th>
                            <th> {{__('الموقع') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ trans('feature_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                            <tr>
                            @foreach ($company_locations as $location)
                                <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $location->country }}</td>
                                    <td>{{ $location->city }}</td>
                                    <td>{{ $location->address }}</td>
                                    <td>{{ $location->phone }}</td>
                                    <td>{{ $location->whats }}</td>
                                    <th><a href="{{ $location->map_url }}" target="_blank" style="color: blue">{{__('الذهاب للرابط')}}</a></th>

                                    @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $location->id }}"
                                                title="{{ trans('feature_trans.Edit') }}"><i
                                                    class="fa fa-edit"></i></button>

                                            @if (auth()->user()->hasRole('super_admin'))
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{ $location->id }}"
                                                    title="{{ trans('feature_trans.Delete') }}"><i
                                                        class="fa fa-trash"></i></button>
                                            @endif
                                        </td>
                                    @endif
                            </tr>

                            <!-- edit_modal_feature -->
                            <div class="modal fade" id="edit{{ $location->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('front_trans.edit') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('company_location.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $location->id }}">
                                                <div class="row"  style="padding: 25px 0px 5px 0px;">
                                                    <div class="col">
                                                        <label for="country" class="mr-sm-2">{{ trans('front_trans.country') }} : <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="country" value="{{ $location->country }}" required>
                                                    </div>
                                                </div>

                                                <div class="row"  style="padding: 25px 0px 5px 0px;">
                                                    <div class="col">
                                                        <label for="city" class="mr-sm-2">{{ trans('front_trans.city') }} : <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="city" value="{{ $location->city }}" required>
                                                    </div>
                                                </div>

                                                <div class="row"  style="padding: 25px 0px 5px 0px;">
                                                    <div class="col">
                                                        <label for="address" class="mr-sm-2">{{ trans('front_trans.address') }} : <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="address" value="{{ $location->address }}" required>
                                                    </div>
                                                </div>

                                                <div class="row"  style="padding: 25px 0px 5px 0px;">
                                                    <div class="col-6">
                                                        <label for="phone" class="mr-sm-2">{{ __('خدمة العملاء') }} : <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="phone" value="{{ $location->phone }}" required>
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="whats" class="mr-sm-2">{{ __(' الواتس') }} : <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="whats" value="{{ $location->whats }}" required>
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="phone" class="mr-sm-2">{{ __('خدمة العملاء') }} : <span style="color: red"> *
                                                            </span> </label>
                                                        <input type="text" class="form-control" name="phone"value="{{ $location->phone }}">
                                                        @if ($errors->has('phone'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('phone') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="whats" class="mr-sm-2">{{ __(' الواتس') }} : <span style="color: red"> *
                                                            </span> </label>
                                                        <input type="text" class="form-control" name="whats"value="{{ $location->whats }}">
                                                        @if ($errors->has('whats'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('whats') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> --}}

                                                <div class="row"  style="padding: 25px 0px 5px 0px;">
                                                    <div class="col">
                                                        <label for="map_url" class="mr-sm-2">{{__('رابط الموقع الموجود في (URL)') }} : <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="map_url" value="{{ $location->map_url }}" required>
                                                    </div>
                                                </div>
                                                <div class="row"  style="padding: 25px 0px 5px 0px;">
                                                    <div class="col">
                                                        <label for="map_frame" class="mr-sm-2">{{__('رابط الموقع الموجود في (Embed)') }} : <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="map_frame" value="{{ $location->map_frame }}" required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('feature_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{ trans('feature_trans.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- delete_modal_feature -->
                            <div class="modal fade" id="delete{{ $location->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('front_trans.Delete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('company_location.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('social_trans.Warning_social') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $location->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('front_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ trans('front_trans.Delete') }}</button>
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


<!-- add_modal_feature -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('front_trans.add') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('company_location.store') }}" method="POST">
                    @csrf

                    <div class="row"  style="padding: 25px 0px 5px 0px;">
                        <div class="col">
                            <label for="country" class="mr-sm-2">{{ trans('front_trans.country') }} : <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="country" required>
                        </div>
                    </div>

                    <div class="row"  style="padding: 25px 0px 5px 0px;">
                        <div class="col">
                            <label for="city" class="mr-sm-2">{{ trans('front_trans.city') }} : <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="city" required>
                        </div>
                    </div>

                    <div class="row"  style="padding: 25px 0px 5px 0px;">
                        <div class="col">
                            <label for="address" class="mr-sm-2">{{ trans('front_trans.address') }} : <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                    </div>
                    <div class="row"  style="padding: 25px 0px 5px 0px;">
                        <div class="col-6">
                            <label for="phone" class="mr-sm-2">{{ __('خدمة العملاء') }} : <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="phone"  required>
                        </div>
                        <div class="col-6">
                            <label for="whats" class="mr-sm-2">{{ __(' الواتس') }} : <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="whats"  required>
                        </div>
                    </div>

                    <div class="row"  style="padding: 25px 0px 5px 0px;">
                        <div class="col">
                            <label for="map_url" class="mr-sm-2">{{__('رابط الموقع الموجود في (URL)') }} : <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="map_url" required>
                        </div>
                    </div>
                    <div class="row"  style="padding: 25px 0px 5px 0px;">
                        <div class="col">
                            <label for="map_frame" class="mr-sm-2">{{__('رابط الموقع الموجود في (Embed)') }} : <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="map_frame" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('feature_trans.Close') }}</button>
                        <button type="submit"
                            class="btn btn-success">{{ trans('feature_trans.submit') }}</button>
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

<script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
            tabSize: 2,
            height: 100,
        });
        $("#summernote").code()
                .replace(/<\/p>/gi, "\n")
                .replace(/<br\/?>/gi, "\n")
                .replace(/<\/?[^>]+(>|$)/g, "");
    });
</script>
@endsection
