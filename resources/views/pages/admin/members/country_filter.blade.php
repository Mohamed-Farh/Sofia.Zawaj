
        <meta charset="UTF-8">
        <title>Country-Region DropDown Menu</title>

        <!-- link for jquery style -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- link for bootstrap style -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script src="{{ URL::asset('country-region-dropdown-menu-master/assets/js/geodatasource-cr.js')}}"></script>
        <link rel="stylesheet" href="{{ URL::asset('country-region-dropdown-menu-master/assets/css/geodatasource-countryflag.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Strait|Chonburi" rel="stylesheet">

        <!-- link to ar language po file -->
        <link rel="gettext" type="application/x-po" href="{{ URL::asset('country-region-dropdown-menu-master/languages/ar/LC_MESSAGES/ar.po')}}" />
        <script type="text/javascript" src="{{ URL::asset('country-region-dropdown-menu-master/assets/js/Gettext.js')}}"></script>
        <style type="text/css">
            .ui-selectmenu-button.ui-button {
                width: 100%;
            }
            h2 {
                font-family: "Strait";
                font-size: 280%;
                font-weight: bold;
            }
            .ui-widget {
                font-family: courier;
            }
            .form-control {
                font-family: courier;
                font-size: 1em;
            }
            #display {
                display: block;
                text-align: center;
                font-size: 180%;
                font-family: 'Chonburi', cursive;
                font-weight: normal;
            }
            label {
                font-family: 'Chonburi';
            }
        </style>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#gds-cr-one").on('change',function() {
                    $("#display").html($(this).children("option").filter(":selected").text() + " < " + $("#countrySelection").children("option").filter(":selected").text()  + "لقد قمت باختيار ");
                });
            });
        </script>



        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" style="margin-bottom:40px;">
                    <h2>COUNTRY-REGION DROPDOWN MENU</h2>
                </div>
                <div class="col-md-12">
                    <form class="form-horizontal">
                        <p class="text-center lead text-info">Example: Country-Region DropDown Menu in Arabic [AR]</p>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">بلد</label>
                            <div class="col-sm-10">
                                <select id="countrySelection" class="form-control gds-cr gds-countryflag" country-data-region-id="gds-cr-one" data-language="ar"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gds-cr-one" class="col-sm-2 control-label">منطقة</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="gds-cr-one"></select>
                            </div>
                        </div>
                    </form>
                    <br>
                    <label id="display"></label>
                </div>
            </div>
        </div>
