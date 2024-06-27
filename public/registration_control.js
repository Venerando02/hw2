const form = document.querySelector('#registrazione');
const nomeInput = document.querySelector('#nome');
const cognomeInput = document.querySelector('#cognome');
const emailInput = document.querySelector('#email');
const usernameInput = document.querySelector('#username');
const passwordInput = document.querySelector('#password');
const confirm_passwordInput = document.querySelector('#conferma_password');

const responses = {};

form.addEventListener('submit', checkReg);
nomeInput.addEventListener('blur', checkName);
cognomeInput.addEventListener('blur', checkSurname);
emailInput.addEventListener('blur', checkEmail);
usernameInput.addEventListener('blur', checkUser);
passwordInput.addEventListener('blur', checkPassword);
confirm_passwordInput.addEventListener('blur', checkConfirmPassword);

function saveResponse(inputName, isValid) 
{
    responses[inputName] = isValid;
}

function checkReg(event) {
    event.preventDefault();
    if (responses['nome'] && responses['cognome'] && responses['email'] && responses['username'] && responses['password'] && responses['conferma_password'])
    {
        form.submit();
    }
    else 
    {
        alert('Riempi tutti i campi');
    }
}

function checkName() {
    const name = nomeInput.value.trim();
    const error_name = document.createElement('p');

    const errori = nomeInput.parentNode.querySelectorAll('.Error');
    errori.forEach(error => error.remove());

    if (name === '') 
    {
        error_name.textContent = 'Casella vuota!';
        error_name.classList.add('Error');
        nomeInput.parentNode.appendChild(error_name);
        saveResponse('nome', false);
    } 
    else if (!/^[a-zA-Z\s]+$/.test(name)) 
    {
        error_name.textContent = 'Il nome deve contenere solamente lettere!';
        error_name.classList.add('Error');
        nomeInput.parentNode.appendChild(error_name);
        saveResponse('nome', false);
    } else {
        console.log('Nome inserito correttamente!');
        saveResponse('nome', true);
    }
}

function checkSurname() {
    const surname = cognomeInput.value.trim();
    const error_surname = document.createElement('p');

    const errori = cognomeInput.parentNode.querySelectorAll('.Error');
    errori.forEach(error => error.remove());

    if (surname === '') {
        error_surname.textContent = 'Casella vuota!';
        error_surname.classList.add('Error');
        cognomeInput.parentNode.appendChild(error_surname);
        saveResponse('cognome', false);
    } else if (!/^[a-zA-Z\s]+$/.test(surname)) {
        error_surname.textContent = 'Il cognome deve contenere solamente lettere!';
        error_surname.classList.add('Error');
        cognomeInput.parentNode.appendChild(error_surname);
        saveResponse('cognome', false);
    } else {
        console.log('Cognome inserito correttamente!');
        saveResponse('cognome', true);
    }
}

function OnUserJson(json) {
    const errorUsername = document.createElement('p');
    console.log(json);

    if (json.exists === true) {
        errorUsername.textContent = "L'username già esistente";
        errorUsername.classList.add('Error');
        usernameInput.parentNode.appendChild(errorUsername);
        saveResponse('username', false);
    } else {
        console.log('Username non trovato nel db, quindi puoi inserirlo correttamente');
        saveResponse('username', true);
    }
}

function OnUserResponse(response) {
    if (!response.ok) {
        return null;
    } else {
        return response.json();
    }
}

function checkUser() {
    const username = usernameInput.value.trim();
    const error_username = document.createElement('p');

    const errori = usernameInput.parentNode.querySelectorAll('.Error');
    errori.forEach(error => error.remove());

    if (username === '') {
        error_username.textContent = 'Casella vuota!';
        error_username.classList.add('Error');
        usernameInput.parentNode.appendChild(error_username);
        saveResponse('username', false);
    } else {
        const username_encoded = encodeURIComponent(username);
        fetch(BASE_URL + 'checkUsername/' + username_encoded)
        .then(OnUserResponse)
        .then(OnUserJson);
    }
}

function onEmailJson(json) {
    const errorEmail = document.createElement('p');
    console.log(json);

    if (json.exists === true) {
        errorEmail.textContent = "Email già esistente";
        errorEmail.classList.add('Error');
        emailInput.parentNode.appendChild(errorEmail);
        saveResponse('email', false);
    } else 
    {
        console.log('Email non trovata nel db, quindi puoi inserirla correttamente');
        saveResponse('email', true);
    }
}

function onEmailResponse(response) {
    if (!response.ok) {
        return null;
    } else {
        return response.json();
    }
}

function checkEmail() {
    const email = emailInput.value.trim();
    const error_email = document.createElement('p');

    const errori = emailInput.parentNode.querySelectorAll('.Error');
    errori.forEach(error => error.remove());

    if (email === '') {
        error_email.textContent = 'Casella vuota!';
        error_email.classList.add('Error');
        emailInput.parentNode.appendChild(error_email);
        saveResponse('email', false);
    }
    else {
        const email_encoded = encodeURIComponent(email);
        fetch(BASE_URL + 'checkEmail/' + email_encoded).then(onEmailResponse).then(onEmailJson);
    }
}

function checkPassword() {
    const Password = passwordInput.value.trim();
    const error_password = document.createElement('p');
    const errori = passwordInput.parentNode.querySelectorAll('.Error');
    errori.forEach(error => error.remove());

    if (Password === '') {
        error_password.textContent = 'Casella vuota';
        error_password.classList.add('Error');
        passwordInput.parentNode.appendChild(error_password);
        saveResponse('password', false);
    } else if (Password.length < 8) {
        error_password.textContent = 'La password deve contenere almeno 8 caratteri';
        error_password.classList.add('Error');
        passwordInput.parentNode.appendChild(error_password);
        saveResponse('password', false);
    } else if (!/[A-Za-z]/.test(Password) || !/[0-9]/.test(Password) || !/[!@#$%^&*(),.?":{}|<>]/.test(Password)) {
        error_password.textContent = 'La password deve contenere numeri, lettere e caratteri speciali';
        error_password.classList.add('Error');
        passwordInput.parentNode.appendChild(error_password);
        saveResponse('password', false);
    } else {
        console.log('Password inserita correttamente!');
        saveResponse('password', true);
    }
}

function checkConfirmPassword() {
    const confirmPassword = confirm_passwordInput.value.trim();
    const password = passwordInput.value.trim();
    const error_confirm_password = document.createElement('p');

    const errori = confirm_passwordInput.parentNode.querySelectorAll('.Error');
    errori.forEach(error => error.remove());

    if (confirmPassword === '') {
        error_confirm_password.textContent = 'Casella vuota!';
        error_confirm_password.classList.add('Error');
        confirm_passwordInput.parentNode.appendChild(error_confirm_password);
        saveResponse('conferma_password', false);
    } else if (confirmPassword.length < 8) {
        error_confirm_password.textContent = 'La password deve contenere almeno 8 caratteri';
        error_confirm_password.classList.add('Error');
        confirm_passwordInput.parentNode.appendChild(error_confirm_password);
        saveResponse('conferma_password', false);
    } else if (!/[A-Za-z]/.test(confirmPassword) || !/[0-9]/.test(confirmPassword) || !/[!@#$%^&*(),.?":{}|<>]/.test(confirmPassword)) {
        error_confirm_password.textContent = 'La password deve contenere numeri, lettere e caratteri speciali';
        error_confirm_password.classList.add('Error');
        confirm_passwordInput.parentNode.appendChild(error_confirm_password);
        saveResponse('conferma_password', false);
    } else if (confirmPassword !== password) {
        error_confirm_password.textContent = 'Le due password non coincidono';
        error_confirm_password.classList.add('Error');
        confirm_passwordInput.parentNode.appendChild(error_confirm_password);
        saveResponse('conferma_password', false);
    } else {
        console.log('Password di conferma inserita correttamente!');
        saveResponse('conferma_password', true);
    }
}
