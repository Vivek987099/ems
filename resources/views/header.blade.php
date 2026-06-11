<header class="bg-white rounded-2xl shadow-md">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <div>
                <h1 class="text-2xl font-bold text-blue-600">
                    Employee Management
                </h1>
            </div>

            <!-- Navigation Menu -->
            <nav>
                <ul class="flex items-center gap-8">
                    <li class="relative">
                        <a href="{{ route('web.employees.index') }}"
                           class="group flex justify-center  items-center gap-x-1 text-gray-700 hover:text-blue-600 font-medium transition">
                            Employees
                            <i class="fa-solid fa-angle-down text-sm"></i>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('web.departments.index') }}"
                           class="group flex justify-center  items-center gap-x-1 text-gray-700 hover:text-blue-600 font-medium transition">
                            Departments
                            <i class="fa-solid fa-angle-down text-sm"></i>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('web.users.index') }}"
                           class="group flex justify-center  items-center gap-x-1 text-gray-700 hover:text-blue-600 font-medium transition">
                            Users
                            <i class="fa-solid fa-angle-down text-sm"></i>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('web.roles.index') }}"
                           class="group flex justify-center  items-center gap-x-1 text-gray-700 hover:text-blue-600 font-medium transition">
                            Roles
                            <i class="fa-solid fa-angle-down text-sm"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <button class="bg-indigo-500 px-6 py-2 rounded text-white cursor-pointer hover:bg-indigo-600">Logout</button>

        </div>
    </div>
</header>