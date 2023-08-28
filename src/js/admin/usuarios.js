import Datatable from "datatables.net-bs5";
import { lenguaje  } from "../lenguaje";
import { Toast, validarFormulario } from "../funciones";
import { Dropdown, Modal } from 'bootstrap';

let contador = 1;
let roles = [];
const modalElement = document.getElementById('modalPassword')
const formulario = document.getElementById('formPassword')
const modalPassword = new Modal(modalElement)
const datatable = new Datatable('#tablaUsuarios', {
    language : lenguaje,
    data : null,
    columns: [
        {
            title : 'NO',
            render : () => contador ++
            
        },
        {
            title : 'CATALOGO',
            data: 'catalogo'
        },
        {
            title : 'ROL',
            data: 'rol',
            render : (data, type, row, meta) => {
                let select = `<select class='form-control form-control-sm' data-usu_id='${row.usu_id}' data-asi_id='${row.asi_id}' id='rolSelect${contador}'>`
                select+=`<option value='' ${!data && 'selected'}>SIN ROL</option>`
                roles.forEach(r => {
                    select+=`<option value='${r.rol_id}' ${data == r.rol_id && 'selected'}>${r.rol_desc}</option>`
                })
                select+=`</select>`
                return select;
            }
        },
        {
            title : 'ESTADO',
            data: 'estado',
            render : (data, type, row, meta) => {
                let estado = 'SIN ESTADO'
                switch (data) {
                    case '1':
                        estado = 'REGISTRADO'
                        break;
                    case '2':
                        estado = 'ACTIVO'
                        break;
                    case '0':
                        estado = 'INACTIVO'
                        break;
                
                    default:
                        break;
                }
                return estado;
            }
        },
        {
            title : 'CONTRASEÑA',
            data: 'usu_id',
            searchable : false,
            width:'10%',
            orderable : false,
            render : (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-bs-toggle='modal' data-bs-target='#modalPassword' >Modificar</button>`
        },
        {
            title : 'ACTIVAR/DESACTIVAR',
            data: 'usu_id',
            searchable : false,
            orderable : false,
            width:'10%',
            render : (data, type, row, meta) => {
                if(row.estado == 1 || row.estado == 0){
                    return `<button class="btn btn-success" data-id='${data}' id='btnActivar${contador}'>Activar</button>`
                }else{
                    return `<button class="btn btn-danger" data-id='${data}' id='btnDesactivar${contador}'>Desactivar</button>`

                }
            }
        },

    ]
})

const buscar = async () => {

    // let producto_nombre = formulario.producto_nombre.value;
    // let producto_precio = formulario.producto_precio.value;
    const url = `/resolucion/API/admin/usuarios`;
    const config = {
        method : 'GET'
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();

        console.log(data);
        datatable.clear().draw()
        if(data){
            contador = 1
            datatable.rows.add(data).draw();
        }else{
            Toast.fire({
                title : 'No se encontraron registros',
                icon : 'info'
            })
        }
       
    } catch (error) {
        console.log(error);
    }
}
const getRoles = async () => {

    // let producto_nombre = formulario.producto_nombre.value;
    // let producto_precio = formulario.producto_precio.value;
    const url = `/resolucion/API/admin/roles`;
    const config = {
        method : 'GET'
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        console.log(data);
        roles = data;
       
    } catch (error) {
        console.log(error);
    }
}

const modificarRol = async e => {
    let usu_id = e.target.dataset.usu_id
    let asi_id = e.target.dataset.asi_id
    let rol = e.target.value
    if(rol.trim() == ''){
        Toast.fire({
            'title' : 'Rol vacio',
            'text' : 'Debe seleccionar un rol',
            'icon' : 'warning'
        })
        return
    }

    const body = new FormData()
    asi_id != '' && body.append('asi_id', asi_id)
    body.append('asi_usuario', usu_id)
    body.append('asi_rol', rol)
    const url = '/resolucion/API/admin/modificar/rol';
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");
    const config = {
        method : 'POST',
        body,
        headers
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        console.log(data);
        const {codigo, mensaje,detalle} = data;
        let icon = 'info'
        switch (codigo) {
            case 1:
                icon = 'success'
                buscar();
                break;
            case 0:
                icon = 'error'
                console.log(detalle)
                break;
        
            default:
                break;
        }

        Toast.fire({
            icon,
            title: mensaje
        })

    } catch (error) {
        console.log(error);
    }
}

const activarDesactivarUsuario = async e => {
    let id = e.target.dataset.id
   
    const body = new FormData()
    body.append('id', id)
    const url = '/resolucion/API/admin/activar-desactivar';
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");
    const config = {
        method : 'POST',
        body,
        headers
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        console.log(data);
        const {codigo, mensaje,detalle} = data;
        let icon = 'info'
        switch (codigo) {
            case 1:
                icon = 'success'
                buscar();
                break;
            case 0:
                icon = 'error'
                console.log(detalle)
                break;
        
            default:
                break;
        }

        Toast.fire({
            icon,
            title: mensaje
        })

    } catch (error) {
        console.log(error);
    }
}

const modificarPassword = async (e) => {
    e.preventDefault();
    if(!validarFormulario(formulario)){
        Toast.fire({
            'title' : 'Campos vacios',
            'text' : 'Debe llenar todos los campos',
            'icon' : 'warning'
        })
        return;
    }

    if(formulario.usu_password.value != formulario.usu_password2.value){
        Toast.fire({
            'title' : 'Contraseñas no coinciden',
            'text' : 'Revise la información ingresada',
            'icon' : 'warning'
        })
        return
    }

    const body = new FormData(formulario)
    const url = '/resolucion/API/admin/modificar/password';
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");
    const config = {
        method : 'POST',
        body,
        headers
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        console.log(data);
        
        const {codigo, mensaje,detalle} = data;
        let icon = 'info'
        switch (codigo) {
            case 1:
                formulario.reset();
                modalPassword.hide();
                icon = 'success'
                break;
        
            case 2:
                icon = 'warning'
                break;
            case 0:
                icon = 'error'
                console.log(detalle)
                break;
        
            default:
                break;
        }

        Toast.fire({
            icon,
            title: mensaje
        })

    } catch (error) {
        console.log(error);
    }
}


await getRoles();
await buscar()

datatable.on('change','[id^=rolSelect]', modificarRol )
datatable.on('click','[id^=btnActivar]', activarDesactivarUsuario )
datatable.on('click','[id^=btnDesactivar]', activarDesactivarUsuario )
formulario.addEventListener('submit', modificarPassword)
modalElement.addEventListener('show.bs.modal', (e) => {
    formulario.reset();
    formulario.usu_id.value = e.relatedTarget.dataset.id
})