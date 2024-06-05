function checkName(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.name] = input.value.length > 0) {
        input.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.classList.add('errorj');
    }
}

function checkSurname(event) {
    const input = event.currentTarget;
    
    if (formStatus[input.surname] = input.value.length > 0) {
        input.parentNode.classList.remove('errorj');
    } else {
        input.parentNode.classList.add('errorj');
    }
}

function jsonCheckUsername(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.username = !json.exists) {
        document.querySelector('.username').classList.remove('errorj');
    } else {
        document.querySelector('.username span').textContent = "Nome utente già utilizzato";
        document.querySelector('.username').classList.add('errorj');
    }
}

function jsonCheckEmail(json) {
    // Controllo il campo exists ritornato dal JSON
    if (formStatus.email = !json.exists) {
        document.querySelector('.email').classList.remove('errorj');
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('errorj');
    }
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function checkUsername(event) {
    const input = document.querySelector('.username input');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
        input.parentNode.querySelector('span').textContent = "Sono ammesse lettere, numeri e underscore. Max. 15";
        document.querySelector('.username').classList.add('errorj');
        formStatus.username = false;
    } else {
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(jsonCheckUsername);
        document.querySelector('.username').classList.remove('errorj');
    }    
}

function checkBirthday(event) {
    const input = document.querySelector('.birthday input');
    const errorMessage = document.querySelector('.birthday span');
    
    // Ottieni la data di nascita dall'input
    const birthday = new Date(input.value);
    
    // Ottieni la data odierna
    const today = new Date();
    
    // Calcola l'età sottraendo l'anno di nascita dall'anno corrente
    const age = today.getFullYear() - birthday.getFullYear();
    
    // Controlla se il compleanno dell'utente è già avvenuto quest'anno
    // Se non è ancora passato, sottrai 1 all'età
    if (today.getMonth() < birthday.getMonth() || 
        (today.getMonth() === birthday.getMonth() && today.getDate() < birthday.getDate())) {
        age--;
    }

    if (age < 14) {
        errorMessage.textContent = "Devi avere almeno 14 anni per registrarti.";
        document.querySelector('.birthday').classList.add('errorj');
        formStatus.birthday = false;
    } else {
        errorMessage.textContent = "";
        document.querySelector('.birthday').classList.remove('errorj');
        formStatus.birthday = true;
    }
}

function checkEmail(event) {
    const emailInput = document.querySelector('.email input');
    if(!/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailInput.value).toLowerCase())) {
        document.querySelector('.email').classList.add('errorj');
        formStatus.email = false;
    } else {
        fetch("check_email.php?q="+encodeURIComponent(String(emailInput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
        document.querySelector('.email').classList.remove('errorj');
    }
}

function checkPassword(event) {
    const passwordInput = document.querySelector('.password input');
    const password = passwordInput.value;

    const minLength = password.length >= 8;
    const hasLowercase = /[a-z]/.test(password);
    const hasUppercase = /[A-Z]/.test(password);
    const hasNumber = /\d/.test(password);
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>[\]\\/`~;'_+-=]/.test(password);
    
    formStatus.password = minLength && hasLowercase && hasUppercase && hasNumber && hasSpecialChar;

    if (formStatus.password) {
        document.querySelector('.password').classList.remove('errorj');
    } else {
        document.querySelector('.password').classList.add('errorj');
    }
}

function checkConfirmPassword(event) {
    const confirmPasswordInput = document.querySelector('.confirm_password input');
    if (formStatus.confirmPassword = confirmPasswordInput.value === document.querySelector('.password input').value) {
        document.querySelector('.confirm_password').classList.remove('errorj');
    } else {
        document.querySelector('.confirm_password').classList.add('errorj');
    }
}

function checkSignup(event) {
    const checkbox = document.querySelector('.allow input');
    formStatus[checkbox.name] = checkbox.checked;
    if (Object.keys(formStatus).length !== 7 || Object.values(formStatus).includes(false)) {
        event.preventDefault();
    }
}


const formStatus = {};
document.querySelector('.name input').addEventListener('blur', checkName);
document.querySelector('.surname input').addEventListener('blur', checkSurname);
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.birthday input').addEventListener('blur', checkBirthday);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.confirm_password input').addEventListener('blur', checkConfirmPassword);
document.querySelector('form').addEventListener('submit', checkSignup);
