<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees Table</title>
    <script src="https://kit.fontawesome.com/cfea9fe99d.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')

</head>
<body class="bg-gray-100 p-8">
    @include('header')
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
    </div>

    {{-- <div id="add-emp-model" class="min-h-screen w-full bg-gray-700/30 absolute top-0 left-0">
        <div class="flex justify-center items-center h-screen">

            
          
        </div>

    </div> --}}
    
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
@vite('resources/js/emp.js')
</body>
</html>