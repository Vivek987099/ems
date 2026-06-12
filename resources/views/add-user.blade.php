@extends('layouts.app-layout')

@section('title','add user')

@section('content')

 <!-- add user form -->
    <div id="add-user-model" class="w-full   h-screen bg-gray-500/40 flex justify-center items-center">

        <form id="add-user-form" action="#" method="POST" class="space-y-5 bg-white p-8 rounded mx-auto min-w-2xl">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl text-center font-semibold uppercase text-gray-600">Add User</h1>
            </div>
            <div>
                <label for="department_name" class="block text-sm font-medium text-gray-700 mb-2">
                    User Email
                </label>
                <input
                    type="text"
                    id="user-email"
                    name="email"
                    placeholder="Enter department name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required
                >
            </div>
            <div>
                <label for="department_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter department name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required
                >
            </div>
            <div>
                <h4 class="text-sm font-medium text-gray-700 mb-2">
                    Assign Role
                </h4>
                <div id="role" class="role" >
                    <!-- showing roles -->
                </div>
                
            </div>
            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2.5 cursor-pointer rounded-lg hover:bg-blue-700 transition duration-200 font-medium"
            >
                Update
            </button>

        </form>
    </div>
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        if(!localStorage.getItem('token')){
        window.location.href='/'
        }
        function loadRoles(){
            $.ajax({
                url:'/api/roles',
                type:'GET',
                headers:{
                    'Authorization':`Bearer ${localStorage.getItem('token')}`
                },
                success:function(response){
                    let checkboxes ='';
                    let data = response.data;
                    $.each(data,function(index,role){
                        checkboxes += `<div>
                            <input
                            type="checkbox"
                            id="${role.id}"
                            name="role_id[]"
                            value="${role.id}"
                            class="px-4 py-2 inline border border-gray-300 rounded-lg "
                            >
                            <label for="${role.id}"  class="cursor-pointer">${role.name}</label>
                        </div>`;
                    })
                    $('#role').html(checkboxes)
                }
            })
        }
        loadRoles()
        $('#add-user-form').on('submit',function(e){
            e.preventDefault()
            $.ajax({
                url:'/api/register-user',
                type:'POST',
                data:$(this).serialize(),
                headers:{
                    'Authorization':`Bearer ${localStorage.getItem('token')}`
                },
                success:function(response){
                    if(response.status){
                        alert(response.message)
                        window.location.href='/users'
                    }
                },
                error:function(err){
                    console.log(err);
                }
            })
        })
    })
</script>
    
@endsection