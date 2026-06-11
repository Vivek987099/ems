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
            
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-gray-800">Employees List</h1>
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

                    <tbody id="userdata" class="divide-y divide-gray-200">
                        {{-- employee data --}}
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    
<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>
@vite('resources/js/user.js')
</body>
</html>