@extends('layouts.app-layout')

@section('title','departments')

@section('content')
    <div class="max-w-7xl mx-auto mt-5">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            
            <div class="p-6 border-b flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Employees List</h1>
                <a href="{{ route('web.departments.add') }}" class="px-4 py-2 rounded cursor-pointer bg-indigo-500 hover:bg-indigo-600 text-white">Add Department</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-center">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-4">Department ID</th>
                            <th class="px-6 py-4">Department Name</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>

                    <tbody id="departdata" class="divide-y divide-gray-200">
                        {{-- employee data --}}
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div id="update-department-model" class="hidden w-full min-h-screen bg-gray-500/40 absolute left-0 top-0 ">
        <div class=" flex justify-center items-center h-screen">
            <form id="update-department-form" action="#" method="POST" class="space-y-5 bg-white p-8 rounded mx-auto min-w-2xl">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl text-center font-semibold uppercase text-gray-600">Update Department</h1>
                <span class="close-update-department-btn outline-2 cursor-pointer rounded px-3 py-2 outline-red-500 text-red-500">X</span>
            </div>
            <div>
                <label for="department_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Department Name
                </label>
                <input type="hidden" id="department-id">
                <input
                    type="text"
                    id="department_name"
                    name="department_name"
                    placeholder="Enter department name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2.5 cursor-pointer rounded-lg hover:bg-blue-700 transition duration-200 font-medium"
            >
                Update Department
            </button>

        </form>
        </div>

        
    </div>
    <script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
    @vite('resources/js/script.js')
@endsection
