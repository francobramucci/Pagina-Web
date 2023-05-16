$(document).ready(function () { //Esto significa que se empezará a ejecutar una vez cargada la pagina

    let edit = false;
    fetchUsers();


    function fetchUsers(){
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
                        <td><button class="edit-row" userId="${user.id}">Editar</button><button class="erase-row" userId="${user.id}">Borrar</button></td>
                    </tr>`;
                    //console.log(tabla);
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

        let url = edit === false ? 'addUser.php' : 'updateUser.php';

        $.ajax({
            url: url,
            type: 'POST',
            data: postData,
            success: function(response){
                edit = false;
                fetchUsers();
                //Al agregar un usuario y tocar el boton de "Guardar Datos"
                //reseteo el formulario.
                $('#user-form').trigger('reset');
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });

    $(document).on('click', '.edit-row', function() {
        let id = $(this).attr('userId');
        
        $.ajax({
            url: 'dataUser.php',
            type: 'POST',
            data: {id: id},
            success: function(response){
                let user = JSON.parse(response);
                console.log(user[0].nombre);
                $('#userId').val(user[0].id);
                $('#userName').val(user[0].nombre);
                $('#userLastname').val(user[0].apellido);
                $('#dni').val(user[0].dni);
                $('#userEmail').val(user[0].email);
                edit = true;  
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });

    $(document).on('click', '.erase-row', function() {
        let id = $(this).attr('userId');
        
        $.ajax({
            url: 'dataUser.php',
            type: 'POST',
            data: {id: id},
            success: function(response){
                fetchUsers();
                console.log(response)
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });


});