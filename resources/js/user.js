$(document).ready(function(){
    if(!localStorage.getItem('token')){
        window.location.href='/'
    }
    function loadUsers(page = 1){
        $.ajax({
            url:`/api/users?page=${page}`,
            type:'GET',
            headers:{
                'Authorization':`Bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                let data = response.data.data
                let rows=''
                $.each(data,function(index,user){
                    let roles = user.roles.map(role => role.name).join(', ');
                    rows += ` <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">${user.id}</td>
                            <td class="">${user.email}</td>
                            <td class="">${roles || 'no role assign'}</td>
                            <td class="px-6 py-4">
                                <button data-id="${user.id}" class="edit-btn text-white px-4 py-1 rounded cursor-pointer bg-green-500">Edit</button>
                                <button data-id="${user.id}" class="delete-btn text-white px-4 py-1 rounded cursor-pointer bg-red-500">Delete</button>
                            </td>
                    </tr>`;
                })
                generatePagination(response.data)
                $('#userdata').html(rows)
            },
            error:function(err){
                console.log(err);
            }
        })
    }
    function loadRoles(){
        $.ajax({
            url:'/api/roles',
            type:'GET',
            headers:{
                'Authorization':`Bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                let checkboxes ='';
                let data = response.data;
                $.each(data,function(index,role){
                    checkboxes += `<div>
                        <input
                        type="checkbox"
                        id="${role.id}"
                        name="role_id[]"
                        value="${role.id}"
                        class="px-4 py-2 inline border border-gray-300 rounded-lg "
                        >
                        <label for="${role.id}"  class="cursor-pointer">${role.name}</label>
                    </div>`;
                })
                $('#role').html(checkboxes)
            }
        })
    }
    
    $(document).on('click','.delete-btn',function(){
       let id = $(this).data('id')
       $.ajax({
            url:`/api/users/${id}`,
            type:'DELETE',
            headers:{
                'Authorization':`Bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                if(response.status){
                    alert(response.message)
                    loadUsers()
                }
            }
        })
    })
    $(document).on('click','.edit-btn',function(){
        let id = $(this).data('id')
        if(id){
            $('#update-user-model').removeClass('hidden').addClass('flex')
            $.ajax({
                url:`/api/users/${id}`,
                type:'GET',
                headers:{
                    'Authorization':`Bearer ${localStorage.getItem('token')}`
                },
                success:function(response){
                    if(response.status){
                        $('input[name="role_id[]"]').prop('checked', false);
                        $('#user-email').val(response.data.email)
                        $('#user-id').val(response.data.id)
                        $.each(response.data.roles, function(index, role) {
                            $(`input[value="${role.id}"]`).prop('checked', true);
                        });
                    }
                }
            })
        }
    })
    loadRoles()
    loadUsers()

    $(document).on('click','.close-update-user-btn',function(){
        $('#update-user-model').addClass('hidden').removeClass('flex')
    })

    $('#update-user-form').on('submit',function(e){
        e.preventDefault()
        let userId = $('#user-id').val()
        $.ajax({
            url:`/api/users/${userId}`,
            type:'PUT',
            data:$(this).serialize(),
            headers:{
                'Authorization':`Bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                if(response.status){
                    $('#update-user-model').addClass('hidden').removeClass('flex')
                    alert(response.message)
                    loadUsers()
                }
            },
            error:function(err){
                console.log(err);
            }
        })
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
        loadUsers(page)
    });
})