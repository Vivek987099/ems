@extends('layouts.app-layout')

@section('title','employees')

@section('content')
    <div class="max-w-7xl mx-auto mt-5">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            
            <div class="p-6 border-b flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Employees List</h1>
                <a href="{{ route('web.employee.add') }}" class="px-4 py-2 rounded cursor-pointer bg-indigo-500 hover:bg-indigo-600 text-white">Add Employees</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-4">Profile</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Gender</th>
                            <th class="px-6 py-4">Address</th>
                            <th class="px-6 py-4">Phone</th>
                            <th class="px-6 py-4">City</th>
                            <th class="px-6 py-4">Department</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>

                    <tbody id="empdata" class="divide-y divide-gray-200">
                        {{-- employee data --}}
                    </tbody>
                </table>
            </div>

        </div>

        <div id="update-emp-model" class="hidden w-full min-h-screen absolute top-0 left-0 bg-gray-700/30">
            <div class=" w-[80%] mx-auto">
                <div class="bg-white shadow-lg rounded-lg p-8 w-full  mt-15 mx-auto">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                            Update Employee Details
                        </h2>
                        <span class="close-update-employee-btn outline-2 cursor-pointer rounded px-3 py-2 outline-red-500 text-red-500">X</span>
                    </div>

                    <form id="update-employee-form" enctype="multipart/form-data"  method="POST" class="space-y-5 w-[80%] mx-auto">
                    <img src="" alt="" id="profile" class="size-50 mx-auto">
                        <input type="hidden" id="emp-id">
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
                                >
                            </div>
                        </div>
                
                        <button
                            type="submit"
                            class="w-full cursor-pointer bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700 transition duration-200 font-medium"
                        >
                            Update
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
    @vite('resources/js/emp.js')
@endsection
