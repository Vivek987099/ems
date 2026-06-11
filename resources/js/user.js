$(document).ready(function(){
    if(!localStorage.getItem('token')){
        window.location.href='/'
    }
    function loadUsers(){
        $.ajax({
            url:'/api/users',
            type:'GET',
            headers:{
                'Authorization':`Bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                let data = response.data
                let roles =''
                let rows=''
                $.each(data,function(index,user){
                    $.each(user.roles,function(index,role){
                        roles += role.name
                    }).join(',')
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
                        name="roles[]"
                        value="${role.id}"
                        class="px-4 py-2 inline border border-gray-300 rounded-lg "
                        required
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
                    loadRoles()
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
                        $('#user-email').val(response.data.email)
                        $('#user-id').val(response.data.id)
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
})