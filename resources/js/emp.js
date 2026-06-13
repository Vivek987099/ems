import './bootstrap';

$(document).ready(function(){
    if(!localStorage.getItem('token')){
        window.location.href='/'
    }
    function loadUser(){
        $.ajax({
            url:'/api/users/no-emp',
            type:'GET',
            headers:{
                'Authorization':`Bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                let data = response.data
                let options='<option value="">Select User</option>';
                $.each(data,function(index,user){
                    options += `<option value="${user.id}">${user.email}</option>`;
                    
                })
                $('#users').html(options)
            }
        })
    }
    function loadDepartment(){
        $.ajax({
            url:'/api/departments',
            type:'GET',
            headers:{
                'Authorization':`Bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                let data = response.data
                let options='<option value="">Select Department</option>';
                $.each(data,function(index,department){
                    options += `<option value="${department.id}">${department.department_name}</option>`;
                })
                $('#departments').html(options)
            }
        })
    }

    function loadEmployees(page = 1){
        $.ajax({
            url:`api/employees?page=${page}`,
            type:'GET',
            headers:{
                'Authorization':`bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                let employees = response.data.data;
                let rows = '';
                $.each(employees,function(index,emp){
                    rows += `<tr class="hover:bg-gray-50">
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
                            <td class="px-6 py-4"><a href="/employees/${emp.id}" data-id="${emp.id}" class="profile-btn text-white px-4 py-1 rounded cursor-pointer bg-blue-500">View</a></td>
                            <td class="px-6 py-4">
                                <button data-id="${emp.id}" class="edit-btn text-white px-4 py-1 rounded cursor-pointer bg-green-500">Edit</button>
                                <button data-id="${emp.id}" class="delete-btn text-white px-4 py-1 rounded cursor-pointer bg-red-500">Delete</button>
                            </td>
                        </tr>`;
                })
                generatePagination(response.data)
                $('#empdata').html(rows)
            }
        })
    }
    loadEmployees()
    loadUser()
    loadDepartment()
    $(document).on('click','.edit-btn',function(){
        let id = $(this).data('id')
        if(id){
            $('#update-emp-model').removeClass('hidden')      
            $.ajax({
                url:`/api/employees/${id}`,
                type:'GET',
                headers:{
                    'Authorization':`Bearer ${localStorage.getItem('token')}`
                },
                success:function(response){
                    if(response.status){
                        $('#profile').attr('src',`http://localhost:8000/storage/${response.data.profile_image}`)
                        $('#emp-id').val(response.data.id)
                        $('#name').val(response.data.name)
                        $('#address').val(response.data.address)
                        $('#city').val(response.data.city)
                        $(`input[name="gender"][value="${response.data.gender}"]`).prop('checked', true);
                        $('#phone').val(response.data.phone)
                        $('#departments').val(response.data.department.id)
                    }
                },
                error:function(err){
                    console.log(err);
                }
            })
        }
    })
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
    $('#update-employee-form').on('submit',function(e){
        e.preventDefault()
        let id = $('#emp-id').val()
        let formData = new FormData(this);
        formData.append('_method','PUT')
        $.ajax({
            url:`/api/employees/${id}`,
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
                    $('#update-emp-model').addClass('hidden') 
                    loadEmployees()
                }
            },
            error:function(err){
                console.log(err);
            }
        })
        
    })
    $('#profile-image').on('change',function(){
        let file = this.files[0]
        let imageUrl = URL.createObjectURL(file)
        $('#profile').attr('src',imageUrl)
    })
    $(document).on('click','.close-update-employee-btn',function(){
        $('#update-emp-model').addClass('hidden')
    })

    //  pagination function
    function generatePagination(data){
        $('#pagination').empty();
        $.each(data.links,function(index,link){
            $('#pagination').append(`
                <button class="page-btn ${link.active ? 'bg-blue-500 text-white' : 'bg-white'} disabled:text-gray-500 px-3 py-1.5"
                        data-page="${link.page}" ${link.page == null ? 'disabled' : ''}>
                    ${link.label}
                </button>
            `);
        })
    }
    $(document).on('click','.page-btn',function(){
        let page = $(this).data('page');
        loadEmployees(page);
    });
})