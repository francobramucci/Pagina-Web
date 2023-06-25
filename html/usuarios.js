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
                        <td>${user.bloq}</td>
                        <td>${user.bloq_text}</td>
                        <td><button class="admin-row" userId="${user.id}">Admin</button></td>
                        <td>
                            <form class="bloquear-form">
                                <button type="submit">Bloquear</button>
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

    $(document).on('click', '.admin-row', function() {
        let id = $(this).attr('userId');
        
        $.ajax({
            url: '../php/switchAdmin.php',
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

    $(document).on('submit', '.bloquear-form', function(e){
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