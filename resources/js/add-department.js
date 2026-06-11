let addDepartmentForm = document.querySelector('#add-department-form');
addDepartmentForm.addEventListener('submit', (e)=>{
    e.preventDefault();
    let departmentName = document.querySelector('#department_name').value;
    let departmentDetails ={
        department_name:departmentName
    }
    fetch('/api/departments',{
        method:'POST',
        body:JSON.stringify(departmentDetails),
        headers:{
            'Content-Type':'application/json',
            'Authorization':`bearer ${localStorage.getItem('token')}`
        }
    }).then(response=>response.json()).then(data=>{
        if(data.status){
            addDepartmentForm.reset();
            window.location.href = '/departments'
        }
    })
})
let deleteDepartment=(id)=>{
    alert(`department id ${id}`)
}