<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title??'Website' }}</title>
    <style>
        .cke_notification_warning {
            display: none !important;
        }
    </style>
    @include('includes.cssin')
</head>
<body>
    <header>
        @include('includes.navbar')
    </header>
    <div id="layoutSidenav">
        @include('includes.sidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    
                    @yield('content')
                </div>
            </main>
            @include('lookups.modal')
            
        </div>
    </div>
    
    @include('includes.scriptsin')
    <script type="text/javascript">
        window.onload = function() {
            var mainInput = document.getElementById("nepali-datepicker");
            if(mainInput){
            mainInput.NepaliDatePicker({
                'mode':'dark',
                'disableDaysAfter':1,
                'animation':'slide',
            });
            todayFullDate= NepaliFunctions.BS.GetCurrentDate('YYYY-MM-DD');
            mainInput.value = todayFullDate;
            
            // console.log(NepaliFunctions.BS.GetCurrentDate());
        };}
    </script>
    
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif
    @if($errors->has('db_error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            html: `{!! implode('<br>', $errors->all()) !!}`
        });
    </script>
    @endif
    
    @stack('scripts')
</body>
</html>