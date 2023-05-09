$(document).ready(function () { //Esto significa que se empezará a ejeutar una vez cargada la pagina

    let edit = false;
    fetchTasks();


    function fetchTasks(){
        $.ajax({
            url: 'mostrarTabla.php',
            type: 'GET',
            success: function(response){
                let users = JSON.parse(response);
                let tabla = '';
                users.forEach(user=>{
                    tabla += `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.nombre}</td>
                        <td>${user.apellido}</td>
                        <td>${user.dni}</td>
                        <td>${user.email}</td>
                    </tr>`;
                    console.log(tabla);
                })
            
                $('#all-users').html(tabla);
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        })
    }

    $('#user-form').submit(function(e){
        e.preventDefault();

        let postData = {
            id: $('#userId').val(),
            nombre: $('#userName').val(),
            apellido: $('#userLastname').val(),
            dni: $('#dni').val(),
            email: $('#userEmail').val()
        };

        //let url = edit === false ? 'addUser.php' : 'updateUser.php';

        $.ajax({
            url: 'addUser.php',
            type: 'POST',
            data: postData,
            success: function(response){
                edit = false;
                fetchTasks();
                //Al agregar un usuario y tocar el boton de "Guardar Datos"
                //reseteo el formulario.
                $('#user-form').trigger('reset');
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });




});