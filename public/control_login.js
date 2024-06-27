const form = document.querySelector('#login');
const usernameInput = document.querySelector('#username');
const passwordInput = document.querySelector('#password');

const responses = {};

form.addEventListener('submit', checkReg);
usernameInput.addEventListener('blur', checkUser);
passwordInput.addEventListener('blur', checkPassword);

function saveResponse(inputName, Valid) {
    responses[inputName] = Valid;
}

function checkReg(event) {
    event.preventDefault();
    if (responses['username'] && responses['password']) 
    {
        form.submit();
    } else {
        alert('Compilare tutti i campi');
    }
}

function OnUserJson(json) {
    const errorUsername = document.createElement('p');
    console.log(json);
    const errori = usernameInput.parentNode.querySelectorAll('.Error');
    errori.forEach(error => error.remove());

    if (json.exists === true) {
        saveResponse('username', true);
    } else {
        errorUsername.textContent = "Username non esistente, registrati";
        errorUsername.classList.add('Error');
        usernameInput.parentNode.appendChild(errorUsername);
        saveResponse('username', false);
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
        fetch(BASE_URL + 'checkUsername/' + username_encoded).then(OnUserResponse).then(OnUserJson);
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
