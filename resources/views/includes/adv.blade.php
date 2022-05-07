<!-- ADV -->

<style>
    #overlay {
      width: 100px;
      height: 100px;
      z-index: -1;
      position:absolute;
      top:50px;
      left:50px;
    }

    #originalDiv {
      width: 100px;
      height: 100px;
      z-index: 1;
      position:absolute;
      top:0px;
      left:0px;
    }

    .carousel-control-prev, .carousel-control-next {
        position: absolute;
        top: 0;
        bottom: 0;
        z-index: 1;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: center;
        justify-content: center;
        width: 15%;
        color: #fff;
        text-align: center;
        opacity: 0.5;
        transition: opacity 0.15s ease;
        /* padding-top: 100px; */
        margin-top: 90px;
    }
    button.close.advs {
        width: 85% !important;
        height: 50% !important;
    }
  </style>

@if (Auth::guard('member')->check())
    <?php
    $online_auth_member = \App\Models\Member::where('id', Auth::guard('member')->id())->first();
    $adv_count = \App\Models\Adv::where('status', '0')
        ->whereIn('country', ['كل الدول', $online_auth_member->country])
        ->orderBy('id', 'desc')
        ->count();
    ?>
    @if ($adv_count > 0)
        <div class="adv-sale py-4">
            <div class="container">
                <div id="myDiv">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="" id="originalDiv">
                                <button class="close advs" style="width: 100%; height: 75%;"
                                    onclick="document.getElementById('myDiv').style.display='none'"> X
                                </button>
                            </div>
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" id="overlay">
                                <ol class="carousel-indicators">
                                    @foreach (\App\Models\Adv::where('status', '0')->whereIn('country', ['كل الدول', $online_auth_member->country])->orderBy('id', 'desc')->get() as $advs)
                                        <li data-target="#carouselExampleIndicators"
                                            data-slide-to="{{ $loop->index }}"
                                            class="{{ $loop->first ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>

                                <div class="carousel-inner" role="listbox">

                                    @foreach (\App\Models\Adv::where('status', '0')->whereIn('country', ['كل الدول', $online_auth_member->country])->orderBy('id', 'desc')->get() as $advs)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ url('image/advertising/' . $advs->image) }}"
                                                class="d-block w-100" alt="...">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5 style="font-weight: bold !important;">{{ $advs->name }}</h5>
                                                <br>
                                                <p style="text-align: justify">{{ $advs->word }}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@else
    <?php
    $adv_count = \App\Models\Adv::where('status', '0')
        ->where('country', 'كل الدول')
        ->orderBy('id', 'desc')
        ->count();
    ?>
    @if ($adv_count > 0)
        <div class="adv-sale py-4">
            <div class="container">
                <div id="myDiv">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="" id="originalDiv">
                                <button class="close advs" style="width: 100%; height: 75%;"
                                    onclick="document.getElementById('myDiv').style.display='none'"> X
                                </button>
                            </div>
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" id="overlay">
                                <ol class="carousel-indicators">
                                    @foreach (\App\Models\Adv::where('status', '0')->where('country', 'كل الدول')->orderBy('id', 'desc')->get() as $advs)
                                        <li data-target="#carouselExampleIndicators"
                                            data-slide-to="{{ $loop->index }}"
                                            class="{{ $loop->first ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>

                                <div class="carousel-inner" role="listbox">

                                    @foreach (\App\Models\Adv::where('status', '0')->where('country', 'كل الدول')->orderBy('id', 'desc')->get() as $advs)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ url('image/advertising/' . $advs->image) }}"
                                                class="d-block w-100" alt="...">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5 style="font-weight: bold !important;">{{ $advs->name }}</h5>
                                                <br>
                                                {{-- <p style="text-align: justify">{{  \Str::limit($advs->word, 255) }}</p> --}}
                                                <p style="text-align: justify">{{ $advs->word }}</p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
<!--  -->

