const formulario = document.querySelector('form');
import { Toast, validarFormulario } from './../funciones';

const registrar = async (e) => {
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
    const url = '/resolucion/API/usuarios/registrar';
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
                alert('hola')
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

formulario.addEventListener('submit', registrar)