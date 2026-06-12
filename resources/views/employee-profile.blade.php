@extends('layouts.app-layout')

@section('title','employee profile')

@section('content')
    <div id="profileData" class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden mt-5 mb-8">

        <!-- Header -->
        

        <!-- Profile Section -->
       
    </div>
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        function loadProfile(){
            let id = window.location.pathname.split('/').pop();
            $.ajax({
                url:`/api/employees/${id}`,
                type:'GET',
                headers:{
                    'Authorization':`Bearer ${localStorage.getItem('token')}`
                },
                success:function(response){
                    if(response.status){
                        let profile = '<div class="bg-linear-to-r from-blue-600 to-indigo-700 h-40"></div>';
                        let data = response.data;
                        profile += ` <div class="px-8 pb-8">
                        <div class="flex flex-col md:flex-row items-center md:items-end gap-6 -mt-16">

                        <img
                            src="/storage/${data.profile_image}"
                            alt="Profile"
                            class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover"
                        >

                        <div class="text-center md:text-left">
                            <h1 class="text-3xl font-bold text-white">
                                ${data.name}
                            </h1>

                            <p class="text-gray-500">
                                ${data.department.department_name} Department
                            </p>

                            <span class="inline-block mt-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">
                                Employee ID: ${data.id}
                            </span>
                            </div>
                            </div>

                            <!-- Information Cards -->
                            <div class="grid md:grid-cols-2 gap-6 mt-10">

                                <div class="bg-gray-50 p-5 rounded-xl">
                                    <h2 class="text-lg text-blue-600 font-semibold mb-4">
                                        Personal Information
                                    </h2>

                                    <div class="space-y-3">
                                        <p>
                                            <span class="font-semibold">Name:</span>
                                            ${data.name}
                                        </p>

                                        <p>
                                            <span class="font-semibold">Gender:</span>
                                            ${data.gender}
                                        </p>

                                        <p>
                                            <span class="font-semibold">Phone:</span>
                                            ${data.phone}
                                        </p>

                                        <p>
                                            <span class="font-semibold">City:</span>
                                            ${data.city}
                                        </p>

                                        <p>
                                            <span class="font-semibold">Address:</span>
                                            ${data.address}
                                        </p>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-5 rounded-xl">
                                    <h2 class="text-lg text-blue-600 font-semibold mb-4">
                                        Account Information
                                    </h2>

                                    <div class="space-y-3">
                                        <p>
                                            <span class="font-semibold">Email:</span>
                                            ${data.user.email}
                                        </p>

                                        <p>
                                            <span class="font-semibold">Department:</span>
                                            ${data.department.department_name}
                                        </p>

                                        <p>
                                            <span class="font-semibold">User ID:</span>
                                            ${data.user_id}
                                        </p>

                                        <p>
                                            <span class="font-semibold">Employee ID:</span>
                                            ${data.id}
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <!-- Footer -->
                            <div class="mt-8 border-t pt-5 text-sm text-gray-500">
                                <p>
                                    Created At:
                                    2026-06-11 08:07:19
                                </p>

                                <p>
                                    Updated At:
                                    2026-06-11 08:07:19
                                </p>
                            </div>
                        </div>`;

                        $('#profileData').html(profile)
                        
                    }
                }
            })
        }
        loadProfile()
    })
</script>

@endsection