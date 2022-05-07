@extends('layouts.master')
@section('css')
    @toastr_css

@section('title')
{{__('اتـصـل بـنـا') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('اتـصـل بـنـا') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<link href="{{URL::asset('assets/libs/custombox/custombox.min.css')}}" rel="stylesheet">

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
                            <th>{{__('الاســم')}}</th>
                            <th>{{__('رقـم الـهـاتـف')}}</th>
                            <th>{{__('البريد الالكتروني')}}</th>
                            <th>{{__('الدولة')}}</th>
                            <th>{{__('عنوان الرسالة')}}</th>
                            <th>{{__('محتوي الرسالة')}}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{__('الـحـالـة')}}</th>
                                <th>{{__('الـعـمـلـيـات')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($contacts as $contact)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->country }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#showMessage{{ $contact->id }}"
                                            title="{{__('رؤية الرسالة')}}">
                                            {{__('رؤية الرسالة')}}
                                    </button>
                                </td>


                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <td>
                                        @if  ($contact->status == '1')
                                            <button type="button" class="btn btn-primary" ><i class="fa fa-eye"></i> {{__('تم القراءة')}} </button>
                                        @elseif ($contact->status == '0')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_contact{{ $contact->id }}"
                                            title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye-slash"></i> {{__('تحديد كمقروءة')}} </button>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $contact->id }}"
                                            title="{{__('تـعـديـل')}}"><i
                                                class="fa fa-edit"></i></button>

                                        @if (auth()->user()->hasRole('super_admin'))
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $contact->id }}"
                                            title="{{__('حــذف')}}"><i
                                                class="fa fa-trash"></i></button>
                                        @endif
                                    </td>
                                @endif
                            </tr>


                             <!-- showMessage_modal_social -->
                             <div class="modal fade" id="showMessage{{ $contact->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #7272ee;">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('رؤية الرسالة')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            {{ $contact->message }}
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- edit_modal_social -->
                            <div class="modal fade" id="edit{{ $contact->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('تـعـديـل')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('contacts.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $contact->id }}">

                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="name" class="mr-sm-2">{{__('الاســم')}} :  <span style="color: red"> * </span> </label>
                                                            <input type="text" class="form-control" name="name" value="{{ $contact->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="phone" class="mr-sm-2">{{__('رقـم الـهـاتـف')}} :  <span style="color: red"> * </span> </label>
                                                            <input type="text" class="form-control" name="phone" value="{{ $contact->phone }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="email" class="mr-sm-2">{{__('البريد الالكتروني')}} :  <span style="color: red"> * </span> </label>
                                                            <input type="text" class="form-control" name="email" value="{{ $contact->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="country" class="mr-sm-2">{{__('بلد الاقامة')}} :  <span style="color: red"> * </span> </label>
                                                            <input type="text" class="form-control" name="country" value="{{ $contact->country }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="subject" class="mr-sm-2">{{__('عنوان الرسالة')}} :  </label>
                                                            <input type="text" class="form-control" name="subject" value="{{ $contact->subject }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="message" class="mr-sm-2">{{__('محتوي الرسالة')}} :  </label>
                                                            <textarea name="message" class="form-control">{{ $contact->message }}</textarea>
                                                        </div>
                                                    </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{__('اغــلاق') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{__('حفظ البيانات') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Make_contact_Visible -->
                            <div class="modal fade" id="vis_contact{{ $contact->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('قراءة رسالة تواصل ') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('contact/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                    @if  ($contact->status == '1')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @elseif ($contact->status == '0')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $contact->id }}">
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


                            <!-- delete_modal_social -->
                            <div class="modal fade" id="delete{{ $contact->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('حــــذف') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('contacts.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                    {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $contact->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{__('اغــلاق')}}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{__('حــذف')}}</button>
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


{{-- <a href="#custom-modal" class="btn btn-primary btn-sm waves-effect" data-animation="blur" data-plugin="custommodal" data-overlayColor="#36404a">Show me</a>
<!-- Modal -->
<div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Modal title</h4>
    <div class="custom-modal-text">
        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
    </div>
</div> --}}



<!-- add_modal_social -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{__('اضـافـة')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('contacts.store') }}" method="POST">
                    @csrf

                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{__('الاســم')}} :  <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="phone" class="mr-sm-2">{{__('رقـم الـهـاتـف')}} :  <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="email" class="mr-sm-2">{{__('البريد الالكتروني')}} :  <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="country" class="mr-sm-2">{{__('بلد الاقامة')}} :  <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="country">
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="subject" class="mr-sm-2">{{__('عنوان الرسالة')}} :  </label>
                            <input type="text" class="form-control" name="subject">
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="message" class="mr-sm-2">{{__('محتوي الرسالة')}} :  </label>
                            <textarea name="message" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{__('اغــلاق') }}</button>
                        <button type="submit"
                            class="btn btn-success">{{__('حفظ البيانات') }}</button>
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
