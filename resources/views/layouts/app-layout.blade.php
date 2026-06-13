<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#e7e7e7]">
    <!-- header -->
    @include('header')

    <!-- main content -->
    @yield('content')
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#logout-btn').on('click',function(){
            $.ajax({
                url:'/api/logout',
                type:'POST',
                headers:{
                    'Authorization':`Bearer ${localStorage.getItem('token')}`
                },
                success:function(response){
                    if(response.status){
                        localStorage.removeItem('token')
                        window.location.href='/'
                    }
                },
                error:function(err){
                    console.log(err);
                }
            })
        })
    })
</script>
</body>
</html>