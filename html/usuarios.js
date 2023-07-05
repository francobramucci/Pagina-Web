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
                        <td>${user.is_current_user? `Tienes que ser admin`:
                            `<button id="admin" class="${user.admins == 1 ? 'users-critical' : 'users-actions'}" userId="${user.id}">
                                ${user.admins == 1 ? 'Eliminar admin' : 'Agregar admin'}
                            </button>`}
                        </td>
                        <td>${user.is_current_user? `Tienes que ser admin`:
                            `<form id="bloquear" class="bloquear-form">
                                <button class="${user.bloq == 1 ? 'users-actions' : 'users-critical'}" type="submit">
                                    ${user.bloq == 1 ? 'Desbloquear' : 'Bloquear'}
                                </button>
                                <input type="hidden" class="userId" value="${user.id}">
                                <input type="text" class="motivo" placeholder="Motivo">
                            </form>`}
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