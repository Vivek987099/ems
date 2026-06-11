<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add department</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include('header')
    <div class="bg-white shadow-lg rounded-lg p-8 w-full  mt-15 mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
            Create Department
        </h2>

        <form id="add-employee-form" enctype="multipart/form-data"  method="POST" class="space-y-5 w-[80%] mx-auto">
            <div class="grid grid-cols-2 gap-8 ">
                <div>
                    <label for="department_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Employee Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Employee name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                        Address
                    </label>
                    <input
                        type="text"
                        id="address"
                        name="address"
                        placeholder="Address"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                </div>
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                    City 
                    </label>
                    <input
                        type="text"
                        id="city"
                        name="city"
                        placeholder="Enter city"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                </div>
                <div>
                    <h4 class="block text-sm font-medium text-gray-700 mb-4">
                        Gender
                    </h4>
                    <div class="flex gap-x-5">
                        <div>
                            <input type="radio" value="Male" required name="gender" class="peer hidden" id="male">
                            <label for="male" class="ring-1 px-6 py-1.5 rounded ring-indigo-600 text-indigo-600 cursor-pointer peer-checked:bg-indigo-600 peer-checked:text-white ">Male</label>
                        </div>
                        <div>
                            <input type="radio" value="Female" required name="gender" class="peer hidden" id="female">
                            <label for="female" class="ring-1 px-6 py-1.5 rounded ring-indigo-600 text-indigo-600 cursor-pointer peer-checked:bg-indigo-600 peer-checked:text-white ">Female</label>
                        </div>
                    </div>
                </div>
                <div>
                    <label for="department_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Phone
                    </label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        placeholder="XXXXXXXXXX"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    >
                </div>
                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700 mb-2">
                        Department
                    </label>
                    <select name="department_id" id="departments" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <!-- options -->
                    </select>
                </div>
                <div>
                    <label for="users" class="block text-sm font-medium text-gray-700 mb-2">
                        User 
                    </label>
                    <select name="user_id" id="users" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <!-- options -->
                    </select>
                </div>
                <div>
                    <label for="profile-image" class="block text-sm font-medium text-gray-700 mb-2">
                        Profile Image
                    </label>
                    <input
                        type="file"
                        id="profile-image"
                        name="profile_image"
                        accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-blue-600 cursor-pointer text-white"
                        required
                    >
                </div>
            </div>
            
            <button
                type="submit"
                class="w-full cursor-pointer bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700 transition duration-200 font-medium"
            >
                Submit
            </button>

        </form>
    </div>
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        if(!localStorage.getItem('token')){
        window.location.href='/'
    }
        function loadDepartment(){
            $.ajax({
                url:'/api/departments',
                type:'GET',
                headers:{
                    'Authorization':`bearer ${localStorage.getItem('token')}`
                },
                success:function(response){
                    let data = response.data
                    let options = '<option value="">Select Department</option>';
                    $.each(data,(index,department)=>{
                        options += `<option value="${department.id}" class="text-gray-500">${department.department_name}</option>`
                    })
                    $('#departments').html(options)
                }
            })
        }
        loadDepartment()
        function loadUsers(){
            $.ajax({
                url:'/api/users/no-emp',
                type:'GET',
                headers:{
                    'Authorization':`Bearer ${localStorage.getItem('token')}`
                },
                success:function(response){
                    let data = response.data
                    let options = '<option value="">Select User</option>';
                    $.each(data,function(index,user){
                        options += `<option value="${user.id}" class="text-gray-500">${user.email}</option>`
                    })
                    $('#users').html(options)
                }
            })

        }
        loadUsers()

        $('#add-employee-form').on('submit',function(e){
            e.preventDefault()
            let formData = new FormData(this)
            $.ajax({
                url:'/api/employees',
                type:'POST',
                data:formData,
                processData: false,
                contentType: false,
                headers:{
                    'Authorization':`Bearer ${localStorage.getItem('token')}`,
                    'accept':'application/json'
                },
                success:function(response){
                    if(response.status){
                        alert(response.message)
                        window.location.href = '/employees'
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