function validarLogin() {
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;

    if (email.trim() === '' || password.trim() === '') {
        alert('Por favor, complete todos los campos.');
        return;
    }

    // Aquí puedes realizar el envío del formulario o cualquier otra acción
    // Ejemplo: enviarDatosLogin(email, password);
}

function validarRegistro() {
    const name = document.getElementById('registerName').value;
    const email = document.getElementById('registerEmail').value;
    const username = document.getElementById('registerUsername').value;
    const password = document.getElementById('registerPassword').value;

    if (name.trim() === '' || email.trim() === '' || username.trim() === '' || password.trim() === '') {
        alert('Por favor, complete todos los campos.');
        return;
    }

    // Aquí puedes realizar el envío del formulario o cualquier otra acción
    // Ejemplo: enviarDatosRegistro(name, email, username, password);
}
