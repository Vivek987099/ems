$(document).ready(function(){
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
    $(document).on('click','.delete-btn',function(){
       alert('This feature will be implemented soon')
    })
    $(document).on('click','.edit-btn',function(){
        let id = $(this).data('id')
        alert(`you id is ${id}`)
    })

    loadUsers()
})