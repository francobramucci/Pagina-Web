$(document).ready(function () { //Esto significa que se empezará a ejecutar una vez cargada la pagina

    let edit = false;
    fetchUsers();

    $('#search').keyup(function (e){
        
        let search = $('#search').val();

        if(search){
            $.ajax({
                url: '../php/searchUser.php',
                type: 'POST',
                data: {search: search},
                success: function(response){
                    let users = JSON.parse(response);
                    
                    let template = '';

                    users.forEach(user=>{
                        template += `<li>${user.nombre}</li>`;
                    });

                    $('#user-result').html(template);
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                } 

            });
        }
        else{
            $('#task-result ul').html('');
        }
    });

    function fetchUsers(){
        $.ajax({
            url: '../php/mostrarTabla.php',
            type: 'GET',
            success: function(response){
                let users = JSON.parse(response);
                let tabla = '';
                users.forEach(user=>{
                    tabla += `
                    <tr>
                        <td>${user.nombre}</td>
                        <td>${user.apellido}</td>
                        <td>${user.dni}</td>
                        <td>${user.email}</td>
                        <td><button class="edit-row" userId="${user.id}">Editar</button>
                        <button class="delete-row" userId="${user.id}">Borrar</button></td>
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

        let url = edit === false ? '../php/addUser.php' : '../php/updateUser.php';

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
            url: '../php/dataUser.php',
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

    $(document).on('click', '.delete-row', function() {
        let id = $(this).attr('userId');
        
        $.ajax({
            url: '../php/eraseUser.php',
            type: 'POST',
            data: {id: id},
            success: function(response){
                fetchUsers();
                console.log(response);
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });

    $('#signup').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '../php/signup.php',
            type: 'POST',
            data: {email: $('#signEmail').val(), password: $('#password').val()},
            success: function(response){
                //$('#signup').trigger('reset');
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });

    $('#login').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '../php/login.php',
            type: 'POST',
            data: {email: $('#logEmail').val(), password: $('#password').val()},
            success: function(response){
                //$('#login').trigger('reset');
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });
});