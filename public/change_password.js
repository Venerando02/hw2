const form = document.querySelector('#modifica-password');
form.addEventListener('submit', ModifyPassword);
const old_password = document.querySelector('#old-password');
old_password.addEventListener('blur', ControlPassword);
const new_password = document.querySelector('#new-password');
new_password.addEventListener('blur', checkNewPassword);
const confirm_new_password = document.querySelector('#confirm-new-password');
confirm_new_password.addEventListener('blur', checkConfirmNewPassword);
const buttons = document.querySelectorAll('.bottone');
for(let button of buttons){
    button.addEventListener('click', MostraPassword);
}

function MostraPassword(event){
    event.stopPropagation();
    const button = event.currentTarget;
    const input = button.previousElementSibling;

    if (input.type === 'password') {
        input.type = 'text';
        button.textContent = 'NASCONDI';
    } else {
        input.type = 'password';
        button.textContent = 'MOSTRA';
    }
}


const responses = {};

function saveResponse(inputName, isValid) {
    responses[inputName] = isValid;
}

function ModifyPassword(event) {
    event.preventDefault();
    if (responses['password'] && responses['new-password'] && responses['confirm-new-password']) {
        form.submit();
    } else {
        alert("Campi non corretti!");
    }
}

function onJsonPassword(json) {
    console.log(json);
    const errorPassword = document.createElement('p');

    if (json.response === true) {
        console.log("La password che hai inserito coincide con quella del tuo account");
        saveResponse('password', true);
    } else {
        errorPassword.textContent = 'Password non corrispondente!';
        errorPassword.classList.add('Error');
        old_password.parentNode.appendChild(errorPassword);
        saveResponse('password', false);
    }
}

function onPasswordResponse(response) {
    return response.json();
}

function ControlPassword(event) {
    const oldPasswordValue = event.currentTarget.value.trim();
    const errorPassword = document.createElement('p');
    const errori = old_password.parentNode.querySelectorAll('.Error');
    errori.forEach(error => error.remove());

    if (oldPasswordValue === '') {
        errorPassword.textContent = 'Nessuna password!';
        errorPassword.classList.add('Error');
        old_password.parentNode.appendChild(errorPassword);
        saveResponse('password', false);
    } else {
        const pass_coded = encodeURIComponent(oldPasswordValue);
        fetch(BASE_URL + 'ControlPassword/' + pass_coded)
        .then(onPasswordResponse)
        .then(onJsonPassword);
    }
}

function checkNewPassword(event) {
    const PasswordNew = event.currentTarget.value.trim();
    const error_new_password = document.createElement('p');
    const errori = new_password.parentNode.querySelectorAll('.Error');
    errori.forEach(error => error.remove());

    if (PasswordNew === '') {
        error_new_password.textContent = 'Casella vuota';
        error_new_password.classList.add('Error');
        new_password.parentNode.appendChild(error_new_password);
        saveResponse('new-password', false);
    } else if (PasswordNew.length < 8) {
        error_new_password.textContent = 'Inserisci 8 caratteri';
        error_new_password.classList.add('Error');
        new_password.parentNode.appendChild(error_new_password);
        saveResponse('new-password', false);
    } else if (!/[A-Za-z]/.test(PasswordNew) || !/[0-9]/.test(PasswordNew) || !/[!@#$%^&*(),.?":{}|<>]/.test(PasswordNew)) {
        error_new_password.textContent = 'La password deve contenere numeri, lettere e caratteri speciali';
        error_new_password.classList.add('Error');
        new_password.parentNode.appendChild(error_new_password);
        saveResponse('new-password', false);
    } else {
        console.log('Password inserita correttamente!');
        saveResponse('new-password', true);
    }
}

function checkConfirmNewPassword(event) {
    const PasswordNewConfirm = event.currentTarget.value.trim();
    const passwordNew = new_password.value.trim();
    const error_confirm_new_password = document.createElement('p');
    const errori = confirm_new_password.parentNode.querySelectorAll('.Error');
    errori.forEach(error => error.remove());

    if (PasswordNewConfirm === '') {
        error_confirm_new_password.textContent = 'Casella vuota!';
        error_confirm_new_password.classList.add('Error');
        confirm_new_password.parentNode.appendChild(error_confirm_new_password);
        saveResponse('confirm-new-password', false);
    } else if (PasswordNewConfirm.length < 8) {
        error_confirm_new_password.textContent = 'La password deve contenere almeno 8 caratteri';
        error_confirm_new_password.classList.add('Error');
        confirm_new_password.parentNode.appendChild(error_confirm_new_password);
        saveResponse('confirm-new-password', false);
    } else if (!/[A-Za-z]/.test(PasswordNewConfirm) || !/[0-9]/.test(PasswordNewConfirm) || !/[!@#$%^&*(),.?":{}|<>]/.test(PasswordNewConfirm)) {
        error_confirm_new_password.textContent = 'La password deve contenere numeri, lettere e caratteri speciali';
        error_confirm_new_password.classList.add('Error');
        confirm_new_password.parentNode.appendChild(error_confirm_new_password);
        saveResponse('confirm-new-password', false);
    } else if (PasswordNewConfirm !== passwordNew) {
        error_confirm_new_password.textContent = 'Le due password non coincidono';
        error_confirm_new_password.classList.add('Error');
        confirm_new_password.parentNode.appendChild(error_confirm_new_password);
        saveResponse('confirm-new-password', false);
    } else {
        console.log('Password di conferma inserita correttamente!');
        saveResponse('confirm-new-password', true);
    }
}
