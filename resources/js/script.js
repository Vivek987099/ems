$(document).ready(function(){
    if(!localStorage.getItem('token')){
        window.location.href='/'
    }
    function loadDepartments(){
        $.ajax({
            url:'api/departments',
            type:'GET',
            headers:{
                'Authorization':`bearer ${localStorage.getItem('token')}`
            },
            success:(response)=>{
                let data = response.data;
                let rows ="";
                $.each(data,(index,department)=>{
                     rows += ` <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">${department.id}</td>
                            <td class="px-6 py-4 font-medium">${department.department_name}</td>
                            <td class="px-6 py-4">
                                <button data-id="${department.id}" class="edit-department-btn text-white px-4 py-1 rounded cursor-pointer bg-green-500">Edit</button>
                                <button data-id="${department.id}" class="delete-btn text-white px-4 py-1 rounded cursor-pointer bg-red-500">Delete</button>
                            </td>
                        </tr>`;
                })
                $('#departdata').html(rows)
            }
        })
    }
    $(document).on('click','.delete-btn',function(){
        let id = $(this).data('id')
        $.ajax({
            url:`/api/departments/${id}`,
            type:'DELETE',
            headers:{
                'Authorization':`bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                if(response.status){
                    alert(`${response.message}`)
                    window.location.href = '/departments'
                }
                
            }
        })
    })
    loadDepartments()

    $(document).on('click','.edit-department-btn',function(){
        let id = $(this).data('id')
        $.ajax({
            url:`/api/departments/${id}`,
            type:'GET',
            headers:{
                'Authorization':`bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                if(response.status){
                    $('#department_name').val(response.data.department_name)
                    $('#department-id').val(response.data.id)
                    $('#update-department-model').removeClass('hidden')
                }
            }
        })
    })

    $(document).on('click','.close-update-department-btn',function(){
        $('#update-department-model').addClass('hidden')
    })
    $(document).on('submit','#update-department-form',function(e){
        e.preventDefault()
        let id = $('#department-id').val()
        $.ajax({
            url:`/api/departments/${id}`,
            type:'PUT',
            data:$(this).serialize(),
            headers:{
                "Authorization":`bearer ${localStorage.getItem('token')}`
            },
            success:function(response){
                if(response.status){
                    $('#update-department-model').addClass('hidden');
                    loadDepartments();
                }
                
            },
            error:function(err){
                console.log(err);
                
            }
        })
    })

})