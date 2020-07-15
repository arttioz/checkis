<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />

<title>@yield('pagename') - IS Checking : DIP</title>

<!-- load bootstrap from a cdn -->
{{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
{{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"  crossorigin="anonymous">--}}

{{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>--}}



<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />



<!-- text fonts -->
<link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />

<!-- ace styles -->
<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet"
      id="main-ace-style" />


<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />

<script src="{{ asset('assets/js/ace-extra.min.js') }}"> </script>

<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@200;400&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />

<link href="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css" rel="stylesheet" />
<script src="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

<style>
    select.form-control+.chosen-container.chosen-container-single .chosen-single {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.428571429;
        color: #555;
        vertical-align: middle;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        background-image: none;
    }

    select.form-control+.chosen-container.chosen-container-single .chosen-single div {
        top: 4px;
        color: #000;
    }

    select.form-control+.chosen-container .chosen-drop {
        background-color: #FFF;
        border: 1px solid #CCC;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 4px;
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
        background-clip: padding-box;
        margin: 2px 0 0;

    }

    select.form-control+.chosen-container .chosen-search input[type=text] {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.428571429;
        color: #555;
        vertical-align: middle;
        background-color: #FFF;
        border: 1px solid #CCC;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        background-image: none;
    }

    select.form-control+.chosen-container .chosen-results {
        margin: 2px 0 0;
        padding: 5px 0;
        font-size: 14px;
        list-style: none;
        background-color: #fff;
        margin-bottom: 5px;
    }

    select.form-control+.chosen-container .chosen-results li,
    select.form-control+.chosen-container .chosen-results li.active-result {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: normal;
        line-height: 1.428571429;
        color: #333;
        white-space: nowrap;
        background-image: none;
    }

    select.form-control+.chosen-container .chosen-results li:hover,
    select.form-control+.chosen-container .chosen-results li.active-result:hover,
    select.form-control+.chosen-container .chosen-results li.highlighted {
        color: #FFF;
        text-decoration: none;
        background-color: #428BCA;
        background-image: none;
    }

    select.form-control+.chosen-container-multi .chosen-choices {
        display: block;
        width: 100%;
        min-height: 34px;
        padding: 6px;
        font-size: 14px;
        line-height: 1.428571429;
        color: #555;
        vertical-align: middle;
        background-color: #FFF;
        border: 1px solid #CCC;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        background-image: none;
    }

    select.form-control+.chosen-container-multi .chosen-choices li.search-field input[type="text"] {
        height: auto;
        padding: 5px 0;
    }

    select.form-control+.chosen-container-multi .chosen-choices li.search-choice {

        background-image: none;
        padding: 3px 24px 3px 5px;
        margin: 0 6px 0 0;
        font-size: 14px;
        font-weight: normal;
        line-height: 1.428571429;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid #ccc;
        border-radius: 4px;
        color: #333;
        background-color: #FFF;
        border-color: #CCC;
    }

    select.form-control+.chosen-container-multi .chosen-choices li.search-choice .search-choice-close {
        top: 8px;
        right: 6px;
    }

    select.form-control+.chosen-container-multi.chosen-container-active .chosen-choices,
    select.form-control+.chosen-container.chosen-container-single.chosen-container-active .chosen-single,
    select.form-control+.chosen-container .chosen-search input[type=text]:focus {
        border-color: #66AFE9;
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
    }

    select.form-control+.chosen-container-multi .chosen-results li.result-selected {
        display: list-item;
        color: #ccc;
        cursor: default;
        background-color: white;
    }
</style>

<style>
html,body,h1,h2,h3,h4,h5,h6 { font-family: 'Sarabun', sans-serif;}
</style>

<script>
    function myHide()
    {
        document.getElementById('hidepage').style.display='block';//content ที่ต้องการแสดงหลังจากเพจโหลดเสร็จ
        document.getElementById('hidepage2').style.display='none';//content ที่ต้องการแสดงระหว่างโหลดเพจ
    }
</script>
