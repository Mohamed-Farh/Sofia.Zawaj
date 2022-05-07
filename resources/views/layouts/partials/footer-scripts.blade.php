@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

<script src="{{asset('app-assets/js/popper.min.js')}}"></script>
<script src="{{asset('app-assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('app-assets/js/bootstrap.js')}}"></script>
<script src="jquery.min.js"></script>
<script src="toastr.js"></script>



<script>
    $(document).ready(function () {
        new get_message();
        new get_Notifications();
        setInterval(get_message, 2500);
        setInterval(get_Notifications, 2500);

    });


    function get_message(){
        $.ajax({  //create an ajax request to display.php
            type: "GET",
            url: "/getMessagesNumber",
            success: function (response) {
                // console.log(response);
                let p = document.getElementById('message_notifi');
                p.innerHTML=response;
                if( response > 0 ){
                    p.removeAttribute("hidden");
                }else{
                    p.setAttribute("hidden");
                }

            }
        });
    }

    function get_Notifications(){
        $.ajax({  //create an ajax request to display.php
            type: "GET",
            url: "/getNotificationsNumber",
            success: function (response) {
                let p = document.getElementById('order_notifi');
                p.innerHTML=response;
                if( response > 0 ){
                    p.removeAttribute("hidden");
                }else{
                    p.setAttribute("hidden");
                }

            }
        });
    }
</script>

