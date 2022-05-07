<!DOCTYPE html>
<html>

<head>
    {{-- Done --}}
    <title>القصص الناجحة</title>
    @include('layouts.partials.head')
    @toastr_css
    <style>
        .pagination {
            display: flex !important;
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
    <div class="search-result py-4 text-center">
        <div class="container">
            <div class="row">
                <div class="col search-result-col">
                    <h3>القصص الناجحة</h3>
                    <p>تعرف على قصص الزواج الناجحه من خلال موقع صوفيا</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end search result sec -->
    <!-- start sidebar-section -->
    <div class="sidebar-sec py-4 search-information">
        <div class="container container-1">
            <div class="row">

                @include('includes.sidebar')

                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 all-result-sec">

                    @include('includes.adv')

                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            {{-- <p>القصص الناجحة في مصر<span>1500</span></p> --}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        @if ($stories_counts != '0')
                            @foreach ($stories as $story)
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 mt-3">
                                    <div class="card" style="width: 100%">
                                        <div class="row media">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <img src="{{url('image/success_relation/'.$story->image)}}" class="" alt=" ..." style="width:100%; height:auto "/>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 media-body">
                                                <h5 class="mt-0" style="font-weight: 600; padding-top: 0px;">
                                                    {{ $story->name }} , {{ $story->age }} سنة
                                                </h5>
                                                <p class="words-in-card">
                                                    {{ $story->word }}
                                                </p>
                                                <p>{{ $story->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col" style="text-align: center">
                                <h3 style="text-align: center">عفوا لا يوجد قصص في الوقت الحالي</h3>
                            </div>
                        @endif
                    </div>
                    <div class="pagination-sec text-center py-4">
                        <div class="pagination">
                            <p>{{ $stories->links() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end sidebar-section -->





    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
