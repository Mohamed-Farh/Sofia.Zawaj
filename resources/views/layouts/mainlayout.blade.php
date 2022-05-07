<!DOCTYPE html>

<html lang="en">

 	<head>

   		@include('layouts.partials.head')
           @toastr_css

 	</head>

     <body style="background-image: url('app-assets/images/Web\ 1920\ –\ 1.png'); background-repeat: no-repeat;background-size: cover;" >

		{{-- @include('layouts.partials.nav') --}}

            <div class="row">
                <div class="col-12">
                    @include('layouts.partials.flash')
                </div>
            </div>



		@yield('content')

        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

        {{-- @include('layouts.partials.footer') --}}
		@include('layouts.partials.footer-scripts')

 	</body>

     @jquery
     @toastr_js
     @toastr_render
</html>
