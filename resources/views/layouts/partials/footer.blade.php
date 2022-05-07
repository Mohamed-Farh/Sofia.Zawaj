<!-- start footer -->
<div class="footer-1 py-4 text-center">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <img src="{{asset('app-assets/images/Mask Group 1.png')}}" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="row mt-2 text-center">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                        <ul>
                            <li>
                                <i class="fas fa-heart"></i><a href="{{ route('secondHome') }}">الرئيسية</a>
                            </li>
                            <li>
                                <i class="fas fa-heart"></i><a href="{{ route('privacy_page') }}">سياسة الخصوصية </a>
                            </li>
                            <li>
                                <i class="fas fa-heart"></i><a href="{{ route('common_question_page') }}">الاسئلة الشائعة</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                        <ul>
                            <li>
                                <i class="fas fa-heart"></i><a href="{{ route('about_sofia_page') }}">عن صوفيا</a>
                            </li>
                            <li>
                                <i class="fas fa-heart"></i><a href="{{ route('rules_page') }}">الشروط والاحكام</a>
                            </li>
                            <li>
                                <i class="fas fa-heart"></i><a href="{{ route('login_page') }}">التسجيل</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                        <ul>
                            <li>
                                <i class="fas fa-heart"></i>
                                <a href="{{ route('search_full_page') }}">بحث متقدم</a>
                            </li>
                            <li>
                                <i class="fas fa-heart"></i>
                                <a href="{{ route('home') }}">معلومات</a>
                            </li>
                            <li>
                                <i class="fas fa-heart"></i>
                                <a href="{{ route('contact_us_page') }}">اتصل بنا</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col">
                        <?php
                        $whats = \App\Models\Company_Location::pluck('whats')->first();
                        $Twitters = \App\Models\Social_Mail::where('type', 'Twitter')->get();
                        $Facebooks = \App\Models\Social_Mail::where('type', 'Facebook')->get();
                        $YouTubes = \App\Models\Social_Mail::where('type', 'YouTube')->get();
                        $Instagrams = \App\Models\Social_Mail::where('type', 'Instagram')->get();
                        $G_Mails = \App\Models\Social_Mail::where('type', 'G_Mail')->get();
                        $Yahoos = \App\Models\Social_Mail::where('type', 'Yahoo')->get();
                        $Telegrams = \App\Models\Social_Mail::where('type', 'Telegram')->get();
                        $Linkeds = \App\Models\Social_Mail::where('type', 'Linked')->get();
                        ?>

                        @if ($whats)
                            <a href="https://api.whatsapp.com/send?phone={{ $whats }}" target="_blank" style="margin: 10px"><i
                                    class="fab fa-whatsapp whats"></i></a>
                        @endif

                        @foreach ($Facebooks as $Facebook)
                            @if ($Facebook->status == '0')
                                <a href="{{ $Facebook->link }}" target="_blank"><i class="fab fa-facebook" style="margin: 10px"></i></a>
                            @endif
                        @endforeach

                        @foreach ($Instagrams as $Instagram)
                            @if ($Instagram->status == '0')
                                <a href="{{ $Instagram->link }}" target="_blank"><i class="fab fa-instagram" style="margin: 10px"></i></a>
                            @endif
                        @endforeach

                        @foreach ($YouTubes as $YouTube)
                            @if ($YouTube->status == '0')
                                <a href="{{ $YouTube->link }}" target="_blank"><i class="fab fa-youtube" style="margin: 10px"></i></a>
                            @endif
                        @endforeach

                        @foreach ($Twitters as $Twitter)
                            @if ($Twitter->status == '0')
                                <a href="{{ $Twitter->link }}" target="_blank"><i class="fab fa-twitter" style="margin: 10px"></i></a>
                            @endif
                        @endforeach


                        @foreach ($G_Mails as $G_Mail)
                            @if ($G_Mail->status == '0')
                                <a href="{{ $G_Mail->link }}" target="_blank"><i class="fa fa-envelope" style="margin: 10px"></i></a>
                            @endif
                        @endforeach

                        @foreach ($Linkeds as $Linked)
                            @if ($Linked->status == '0')
                                <a href="{{ $Linked->link }}" target="_blank"><i class="fab fa-linkedin" style="margin: 10px"></i></a>
                            @endif
                        @endforeach

                        @foreach ($Yahoos as $Yahoo)
                            @if ($Yahoo->status == '0')
                                <a href="{{ $Yahoo->link }}" target="_blank"><i class="fab fa-yahoo" style="margin: 10px"></i></a>
                            @endif
                        @endforeach

                        @foreach ($Telegrams as $Telegram)
                            @if ($Telegram->status == '0')
                                <a href="{{ $Telegram->link }}" target="_blank"><i class="fab fa-telegram" style="margin: 10px"></i></a>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <button>Google Play</button>
                <br />
                <button>App Store</button>
            </div>
        </div>
    </div>
</div>

<!-- end footer -->
<!-- start last footer -->
<div class="last-footer py-2 text-center">
    <div class="container">
        <p>جميع الحقوق محفوظة الى موقع زواج صوفيا للزواج الاسلامي 2021</p>
    </div>
</div>
<!-- end last footer -->
