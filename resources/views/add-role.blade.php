<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>role || make role</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include('header')
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md mt-15 mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
            Create Role
        </h2>

        <form id="add-role-form" action="#" method="POST" class="space-y-5">
            
            <div>
                <label for="department_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Role Name
                </label>
                <input
                    type="text"
                    id="department_name"
                    name="name"
                    placeholder="Enter role name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2.5 cursor-pointer rounded-lg hover:bg-blue-700 transition duration-200 font-medium"
            >
                Create Role
            </button>

        </form>
    </div>
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $('#add-role-form').on('submit',function(e){
        e.preventDefault()
        $.ajax({
            url:'/api/roles',
            type:'POST',
            data:$(this).serialize(),
            headers:{
                "Authorization":`bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                if(response.status){
                    alert(response.message)
                    window.location.href = '/roles'
                }
            },
            error:function(error){
                console.log(error);
            }
        })
    })
})
</script>
</body>
</html>
