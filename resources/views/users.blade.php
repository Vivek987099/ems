@extends('layouts.app-layout')

@section('title','users')
    
@section('content')
    <div class="max-w-7xl mx-auto mt-5">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            
            <div class="p-6 border-b flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Users List</h1>
                <a href="{{ route('web.users.add') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">Add User</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <!-- table body -->
                    <tbody id="userdata" class="divide-y divide-gray-200">
                        {{-- employee data --}}
                    </tbody>
                </table>
            </div>
        </div>
        <div id="pagination" class="mt-4 flex gap-2"></div>
    </div>

    <!-- update user model -->
    <div id="update-user-model" class="w-full hidden  h-screen bg-gray-500/40 absolute left-0 top-0  justify-center items-center">

        <form id="update-user-form" action="#" method="POST" class="space-y-5 bg-white p-8 rounded mx-auto min-w-2xl">
            <input type="hidden" id="user-id">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl text-center font-semibold uppercase text-gray-600">Update User</h1>
                <span class="close-update-user-btn outline-2 cursor-pointer rounded px-3 py-2 outline-red-500 text-red-500">X</span>
            </div>
            <div>
                <label for="user-email" class="block text-sm font-medium text-gray-700 mb-2">
                    User Email
                </label>
                <input
                    type="text"
                    id="user-email"
                    name="email"
                    placeholder="Enter user email"
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
    @vite('resources/js/user.js')
@endsection
