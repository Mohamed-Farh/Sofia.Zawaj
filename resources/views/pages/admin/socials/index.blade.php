@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{ trans('main_trans.social') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('main_trans.social') }}
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

            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('social_trans.add_social') }}
                </button>
            @endif
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            {{-- <th>{{ trans('main_trans.way') }}</th> --}}
                            <th> {{ trans('main_trans.type') }}</th>
                            <th> {{__('الـرابـط') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ trans('main_trans.visible') }}</th>
                                <th>{{ trans('social_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($social_mails as $social)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                {{-- <td>{{ $social->name }}</td> --}}
                                <td>{{ $social->type }}</td>
                                <th><a href="{{ $social->link }}" target="_blank" style="color: blue">{{__('الذهاب للرابط')}}</a></th>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <td>
                                    @if  ($social->status == '1')
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#vis_social{{ $social->id }}"
                                        title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                    @elseif ($social->status == '0')
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#vis_social{{ $social->id }}"
                                        title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}} </button>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $social->id }}"
                                        title="{{ trans('social_trans.Edit') }}"><i
                                            class="fa fa-edit"></i></button>

                                    @if (auth()->user()->hasRole('super_admin'))
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $social->id }}"
                                            title="{{ trans('social_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    @endif
                                </td>
                                @endif
                            </tr>

                            <!-- edit_modal_social -->
                            <div class="modal fade" id="edit{{ $social->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('socials.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $social->id }}">
                                                {{-- <div class="form-group">
                                                    <div class="col">
                                                        <label for="name" class="mr-sm-2">{{ trans('main_trans.way') }} :</label>
                                                        <input type="text" class="form-control" name="name" value="{{ $social->name }}">
                                                    </div>
                                                </div> --}}
                                                <div class="form-group">
                                                    <div class="col">
                                                        <label class="mr-sm-2" for="type">{{ trans('main_trans.type') }}</label>
                                                        <select name="type" required class="form-control custom-select selectpicker">
                                                            <option value="0"           <?php if($social->type == "0")          echo "selected"; ?> >  --Please Select-- </option>
                                                            {{-- <option value="What's App"  <?php if($social->type == "What's App") echo "selected"; ?> >       What's App   </option> --}}
                                                            <option value="Twitter"     <?php if($social->type == "Twitter")    echo "selected"; ?> >       Twitter      </option>
                                                            <option value="Facebook"    <?php if($social->type == "Facebook")   echo "selected"; ?> >       Facebook     </option>
                                                            <option value="YouTube"    <?php if($social->type == "YouTube")   echo "selected"; ?> >       YouTube     </option>
                                                            <option value="G_Mail"      <?php if($social->type == "G_Mail")     echo "selected"; ?> >       G_Mail       </option>
                                                            <option value="Yahoo"       <?php if($social->type == "Yahoo")      echo "selected"; ?> >       Yahoo        </option>
                                                            <option value="Telegram"    <?php if($social->type == "Telegram")   echo "selected"; ?> >       Telegram     </option>
                                                            <option value="Linked In"   <?php if($social->type == "Linked In")  echo "selected"; ?> >       Linked In    </option>
                                                            <option value="Instagram"   <?php if($social->type == "Instagram")  echo "selected"; ?> >       Instagram    </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="link" class="mr-sm-2">{{ __('الـرابـط') }} : </label>
                                                        <input type="text" class="form-control" name="link" value="{{ $social->link }}">
                                                        @if ($errors->has('link'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('link') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('social_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{ trans('social_trans.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Make_Image_Visible -->
                            <div class="modal fade" id="vis_social{{ $social->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('socials/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                    @if  ($social->status == '1')
                                                        {{ trans('social_trans.unvisible_social') }}
                                                    @elseif ($social->status == '0')
                                                        {{ trans('social_trans.visible_social') }}
                                                    @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $social->id }}">
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


                            <!-- delete_modal_social -->
                            <div class="modal fade" id="delete{{ $social->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('social_trans.delete_social') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('socials.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('social_trans.Warning_social') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $social->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('social_trans.Close') }}</button>
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


<!-- add_modal_social -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('social_trans.add_social') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('socials.store') }}" method="POST">
                    @csrf
                    {{-- <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ trans('main_trans.way') }} :</label>
                            <input type="text" class="form-control" name="name">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> --}}
                    <div class="form-group modual_space">
                        <div class="col">
                            <label class="mr-sm-2" for="type">{{ trans('main_trans.type') }} : </label>
                            <select name="type" required class="form-control custom-select selectpicker">
                                <option value="0">       {{ trans('social_trans.0') }}                   </option>
                                {{-- <option value="What's App">     What's App   </option> --}}
                                <option value="Twitter">        Twitter      </option>
                                <option value="Facebook">       Facebook     </option>
                                <option value="YouTube">       YouTube     </option>
                                <option value="G_Mail">         G_Mail       </option>
                                <option value="Yahoo">          Yahoo        </option>
                                <option value="Telegram">       Telegram     </option>
                                <option value="Linked In">      Linked In    </option>
                                <option value="Instagram">      Instagram    </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="link" class="mr-sm-2">{{ __('الـرابـط') }} : </label>
                            <input type="text" class="form-control" name="link">
                            @if ($errors->has('link'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('link') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('social_trans.Close') }}</button>
                        <button type="submit"
                            class="btn btn-success">{{ trans('social_trans.submit') }}</button>
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
                    height: 200,
                });
                $("#summernote").code()
                    .replace(/<\/p>/gi, "\n")
                    .replace(/<br\// ** end_phptag ** //gi, "\n")
                        .replace(/<\/?[^>]+(>|$)/g, "");
                    });

</script>
@endsection
