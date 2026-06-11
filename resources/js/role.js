$(document).ready(function(){
    function loadAllRoles(){
        $.ajax({
            url:'/api/roles',
            type:"GET",
            headers:{
                'Authorization':`bearer ${localStorage.getItem('token')}`,
                'accept':'application/json'
            },
            success:function(response){
                let data = response.data
                let rows =''
                $.each(data,function(index,role){
                     rows += ` <tr class="hover:bg-gray-50">
                           
                            <td class="px-6 py-4 font-medium">${role.id}</td>
                            <td class="">${role.name}</td>
                            <td class="px-6 py-4">
                                <button data-id="${role.id}" class="edit-btn text-white px-4 py-1 rounded cursor-pointer bg-green-500">Edit</button>
                                <button data-id="${role.id}" class="delete-btn text-white px-4 py-1 rounded cursor-pointer bg-red-500">Delete</button>
                            </td>
                        </tr>`;
                })
                $('#roledata').html(rows)
            }
        })
    }
    loadAllRoles()
    $(document).on('click','.delete-btn',function(){
        let id = $(this).data('id')
        $.ajax({
            url:`/api/roles/${id}`,
            type:'DELETE',
            headers:{
                "Authorization":`bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                if(response.status){
                    alert(response.message)
                    loadAllRoles()
                }
            },
            error:function(error){
                console.log(error);
            }
        })
    })
    $(document).on('click','.edit-btn',function(){
        let id = $(this).data('id');
        if(id){
            $('#update-role-model').removeClass('hidden')
            $.ajax({
                url:`/api/roles/${id}`,
                type:'GET',
                headers:{
                    "Authorization":`bearer ${localStorage.getItem('token')}`
                },
                success:function(response){
                    $('#role-name').val(response.data.name)
                    $('#role-id').val(response.data.id)
                },
                error:function(error){
                    console.log(error);
                    
                }
            })
        }
    })
    $('#update-role-form').on('submit',function(e){
        e.preventDefault()
        let id = $('#role-id').val()
        console.log(id);
        $.ajax({
            url:`/api/roles/${id}`,
            type:'PUT',
            data:$(this).serialize(),
            headers:{
                'Authorization':`bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                if(response.status){
                    alert(response.message)
                    $('#update-role-model').addClass('hidden')
                    loadAllRoles()
                }
                
            }
        })
        
        
    })
    $(document).on('click','.close-update-role-btn',function(){
        $('#update-role-model').addClass('hidden')
    })

})