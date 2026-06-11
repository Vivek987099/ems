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
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md mt-15 mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
            Create Department
        </h2>

        <form id="add-department-form" action="#" method="POST" class="space-y-5">
            
            <div>
                <label for="department_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Department Name
                </label>
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
                class="w-full bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700 transition duration-200 font-medium"
            >
                Create Department
            </button>

        </form>
    </div>
    @vite('resources/js/add-department.js')
</body>
</html>
