import './bootstrap';

$(document).ready(function(){
    function loadEmployees(){
        $.ajax({
            url:'api/employees',
            type:'GET',
            headers:{
                'Authorization':`bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                let employees = response.data;
                let rows = '';
                $.each(employees,function(index,emp){
                    rows += ` <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <img
                                    src="http://localhost:8000/storage/${emp.profile_image}"
                                    alt="Profile"
                                    class="w-12 h-12 rounded-full object-cover"
                                >
                            </td>
                            <td class="px-6 py-4 font-medium">${emp.name}</td>
                            <td class="">${emp.gender}</td>
                            <td class="px-6 py-4">${emp.phone}</td>
                            <td class="px-6 py-4">${emp.address}</td>
                            <td class="px-6 py-4">${emp.city}</td>
                            <td class="px-6 py-4">${emp.department?.department_name ? emp.department?.department_name : '<span class="text-red-500">No Department Assign</span>'}</td>
                            <td class="px-6 py-4">
                                <button class="text-white px-4 py-1 rounded cursor-pointer bg-green-500">Edit</button>
                                <button data-id="${emp.id}" class="delete-btn text-white px-4 py-1 rounded cursor-pointer bg-red-500">Delete</button>
                            </td>
                             
                        </tr>`;
                })
                $('#empdata').html(rows)
            }
        })
    }
    loadEmployees()
    $(document).on('click','.delete-btn',function(){
        let id = $(this).data('id');
        $.ajax({
            url:`api/employees/${id}`,
            type:'DELETE',
            headers:{
                'Authorization':`bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                if(response.status){
                    alert(response.message);
                    loadEmployees()
                }
            }
        })
    })
})