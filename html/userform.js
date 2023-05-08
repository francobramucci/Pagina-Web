$(document).ready(function () { //Esto significa que se empezará a ejeutar una vez cargada la página

    //let edit = false;
    fetchTasks();


    function fetchTasks(){
        $.ajax({
            url: 'mostrarTabla.php',
            type: 'GET',
            success: function(response){
                let users = JSON.parse(response);
                let tabla = '';
                users.forEach(user=>{
                    template += `
                    <tr userId="${user.id}">
                        <td>${user.id}</td>
                        <td>${user.nombre}</td>
                        <td>${user.apellido}</td>
                        <td>${user.dni}</td>
                        <td>${user.email}</td>
                    </tr>`;
                })
            
                $('#all-users').html(template);
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        })
    }








});