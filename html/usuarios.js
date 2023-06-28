$(document).ready(function () {
    fetchUsers();

    function fetchUsers(){
        $.ajax({
            url: '../php/mostrarCuentas.php',
            type: 'GET',
            success: function(response){
                let users = JSON.parse(response);
                let tabla = '';
                users.forEach(user=>{
                    tabla += `
                    <tr>
                        <td>${user.email}</td>
                        <td>${user.sign_date}</td>
                        <td>${user.last_log}</td>
                        <td>${user.cant_log}</td>
                        <td>${user.bloq_text}</td>
                        <td>
                            ${
                                user.admins == 1 ? 
                                `<button id="admin" class="admin-row" userId="${user.id}">Eliminar admin</button>` :
                                `<button id="admin" class="admin-row" userId="${user.id}">Agregar admin</button>`
                            }
                        </td>
                        <td>
                            <form id="bloquear" class="bloquear-form">
                                ${
                                    user.bloq == 1 ? 
                                    `<button class="bloquear-row" type="submit">Desbloquear</button>` :
                                    `<button class="bloquear-row" type="submit">Bloquear</button>`
                                }
                                <input type="hidden" class="userId" value="${user.id}">
                                <input type="text" class="motivo" placeholder="Motivo">
                            </form>
                        </td>
                    </tr>`;
                })
            
                $('#all-accounts').html(tabla);
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        })
    }

    $('#all-accounts').on('click', '#admin', function() {
        let id = $(this).attr('userId');
        
        $.ajax({
            url: '../php/switchAdmin.php',
            type: 'POST',
            data: {id: id},
            success: function(response){
                fetchUsers();
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });

    $('#all-accounts').on('submit', '#bloquear', function(e){
        e.preventDefault();
        let id = $(this).find('.userId').val();
        let motivo = $(this).find('.motivo').val();

        $.ajax({
            url: '../php/bloqUser.php',
            type: 'POST',
            data: {id: id, bloq_text: motivo},
            success: function(response){
                fetchUsers();
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });
});