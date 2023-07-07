$(document).ready(function () { //Esto significa que se empezará a ejecutar una vez cargada la pagina

    let edit = false;
    fetchTask('');

    $('#search').keyup(function (e) {
        let search = $(this).val();
        fetchTask(search);
    });

    function fetchTask(search){
        $.ajax({
            url: '../php/mostrarTabla.php',
            type: 'POST',
            data: {search: search},
            success: function(response){
                let tasks = JSON.parse(response);
                let tabla = '';
                tasks.forEach(task=>{
                    tabla += `
                    <tr>
                        <td>${task.titulo}</td>
                        <td>${task.descripcion}</td>
                        <td><button class="edit-row" taskId="${task.id}">Editar</button>
                        <button class="delete-row" taskId="${task.id}">Borrar</button></td>
                    </tr>`;
                })
            
                $('#all-tasks').html(tabla);
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        })
    }

    $('#user-form').submit(function(e){
        e.preventDefault();

        let url = edit === false ? '../php/addUser.php' : '../php/updateUser.php';

        $.ajax({
            url: url,
            type: 'POST',
            data: {id: $('#taskId').val(), titulo: $('#taskTitle').val(), descripcion: $('#taskDesc').val()},
            success: function(response){
                edit = false;
                fetchTask('');
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
        let id = $(this).attr('taskId');
        
        $.ajax({
            url: '../php/dataUser.php',
            type: 'POST',
            data: {id: id},
            success: function(response){
                let task = JSON.parse(response);
                $('#taskId').val(task[0].id);
                $('#taskTitle').val(task[0].titulo);
                $('#taskDesc').val(task[0].descripcion);
                edit = true;  
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });

    $(document).on('click', '.delete-row', function() {
        let id = $(this).attr('taskId');
        
        $.ajax({
            url: '../php/eraseUser.php',
            type: 'POST',
            data: {id: id},
            success: function(response){
                fetchTask('');
                console.log(response);
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });
});