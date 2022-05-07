<!DOCTYPE html>
<html>

<head>
    <title>الرسائل الواردة</title>
    @include('layouts.partials.head')
    @toastr_css
    <style>
        .pagination {
            display: flex !important;
        }

        button.like_message{
            background: white;
            border: none;
            color: white;
            width: 10px;
            border-radius: unset;
            margin-bottom: 0;
            margin-left: 15px;
        }

        .sidebarSearchBotton {
            width: 100% !important;
            margin: 10px 0px !important;
        }

    </style>
</head>

<body
    style="background-image: url('app-assets/images/Web\ 1920\ –\ 1.png'); background-repeat: no-repeat;background-size: cover;">
    @include('layouts.partials.nav')
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.flash')
        </div>
    </div>



    <!-- start search result sec -->
    <div class=" search-result py-4 text-center">
        <div class="container">
            <div class="row">
                <div class="col search-result-col">
                    <h3>الرسائل الواردة</h3>
                    <p>عرض تفاصيل وبيانات العضو التي قد تهمك </p>
                </div>
            </div>
        </div>
    </div>
    <!-- end search result sec -->



    <!-- start sidebar-section -->
    <div class="sidebar-sec py-4">
        <div class="container container-1">
            <div class="row">

                @include('includes.sidebar')


                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 all-result-sec">

                    @include('includes.adv')


                    @if ($messages_count != '0')
                        <div class="login-data mt-3">
                            <div class="col" style="text-align: center">
                                <h3 style="text-align: center">قم بفتح صندوق الرسائل الواردة كل يوم</h3>
                            </div>
                            @foreach ($messages  as $message)
                                <?php
                                    $member         = \App\Models\Member::where('id', $message->sender_member_id)->first();
                                    $auth_id        = Auth::guard('member')->id();
                                    $blocked_member = App\Models\Member_Relation::where(['my_id'=> $auth_id, 'member_id'=>($member->id), 'ignore_list'=> '1'])->first();
                                ?>
                                @if (!$blocked_member)
                                    <div class="row mt-2" id="myDiv{{ $message->id }}">
                                        <div class="col">
                                            <div class="card" style="width: 100%;">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <div class="adv-sale py-4">
                                                            <div class="container">
                                                                <div>
                                                                    {{-- <i class="fas fa-times close" onclick="document.getElementById('myDiv{{ $message->id }}').style.display='none'" style="float: left;color: #ff8c6a;"></i> --}}

                                                                    {{-- <form action="{{ url('/read_my_message') }}" method="post">
                                                                        {{ method_field('post') }}
                                                                        @csrf
                                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                                            value="TEST">

                                                                        <button type="submit" class="btn btn-info">{{ trans('social_trans.submit') }}</button>
                                                                    </form> --}}

                                                                    <button data-toggle="modal" data-target="#block{{ $member->id }}" class="like_message" title="حظر هذا العضو">
                                                                        {{-- <i class="fa fa-lock"></i> --}}
                                                                        <i class="fa fa-lock" style="  color: #ff8c6a; font-size: 20px; padding-left: 7px; padding-top: 2px;"></i>

                                                                    </button>


                                                                    <?php
                                                                        $relation = \App\Models\Member_Relation::where(['my_id' => $auth_id, 'member_id' => $member->id])
                                                                            ->where('care_list', '1')
                                                                            ->first();
                                                                    ?>

                                                                    @if ($relation)
                                                                        <button data-toggle="modal" data-target="#care{{ $member->id }}"
                                                                            class="like_message" title="الغاء اعجابي">
                                                                            <i class="fas fa-heart" style="  color: #ff8c6a; font-size: 20px; padding-left: 7px; padding-top: 2px;"></i>
                                                                        </button>
                                                                    @else
                                                                        <button data-toggle="modal" data-target="#care{{ $member->id }}"
                                                                            class="like_message" title="تسجيل اعجابي">
                                                                            <i class="far fa-heart" style="  color: #ff8c6a; font-size: 20px; padding-left: 7px; padding-top: 2px;"></i>
                                                                        </button>
                                                                    @endif


                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="media">
                                                                                <img src="{{ url(asset('image/members/'.$member->image)) }}"
                                                                                    class="" alt=" ..."
                                                                                    style="    border-radius: 50%;">
                                                                                <div class="media-body">
                                                                                    <h5 class="mt-0">
                                                                                        <a href="/show_member_details_page/{{ $member->id }}"> <span>{{ $member->name }}</span> , <span>{{ $member->age }}</span> </a>
                                                                                    </h5>
                                                                                    <p>{{ $message->created_at->diffForHumans() }}</p>
                                                                                    <p><b>{{ $message->subject }}</b></p>
                                                                                    <p>{{ $message->message }}</p>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Member Care Another Member -->
                                    <div class="modal fade text-right" id="care{{ $member->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('member_give_like', 'test') }}" method="post">
                                                        {{ method_field('post') }}
                                                        @csrf
                                                        @if ($relation)
                                                            {{ __('هـل أنـت مـتـأكـد من الغاء اعجابك بهذا العضو ؟ ') }}
                                                        @else
                                                            {{ __('هـل أنـت مـتـأكـد من تسجيل اعجابك بهذا العضو ؟ ') }}
                                                        @endif

                                                        <input id="member_id" type="hidden" name="member_id"
                                                            class="form-control" value="{{ $member->id }}">

                                                        <div class="row modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('admins_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ __('تـأكـيـد') }}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Member Block Another Member -->
                                    <div class="modal fade text-right" id="block{{ $member->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('member_block', 'test') }}" method="post">
                                                        {{ method_field('post') }}
                                                        @csrf
                                                        {{ __('هـل أنـت مـتـأكـد مـن هـذة الـعـمـلـيـة') }}

                                                        <input id="member_id" type="hidden" name="member_id"
                                                            class="form-control" value="{{ $member->id }}">

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('admins_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ __('تـأكـيـد') }}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="pagination-sec text-center py-4">
                            <div class="pagination">
                                <p>{{ $messages->links() }}</p>
                            </div>
                        </div>
                    @else
                        <div class="login-data mt-3">
                            <div class="col" style="text-align: center">
                                <h3 style="text-align: center">صندوق الرسائل الواردة فارغ</h3>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>



    <!-- end sidebar-section -->
    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).read(function(){
            $("form").on('submit', function(e){
            e.preventDefault();
                var formData=$('form').serialize();
                console.log(formData);
            });
        });
    </script> --}}

</body>
@jquery
@toastr_js
@toastr_render

</html>
