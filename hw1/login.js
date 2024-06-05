function checkUsername() {
    const input = document.querySelector('.username input');
    const errorMessage = input.parentNode.querySelector('span');

    if (input.value.trim() === '') {
        document.querySelector('.username').classList.add('errorj');
        formStatus.username = false;
    } else {
        document.querySelector('.username').classList.remove('errorj');
        errorMessage.textContent = "";
        formStatus.username = true;
    }
}

function checkPassword() {
    const input = document.querySelector('.password input');
    const errorMessage = input.parentNode.querySelector('span');

    if (input.value.trim() === '') {
        document.querySelector('.password').classList.add('errorj');
        formStatus.password = false;
    } else {
        document.querySelector('.password').classList.remove('errorj');
        errorMessage.textContent = "";
        formStatus.password = true;
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
document.querySelector('.username input').addEventListener('blur', checkUsername);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('form').addEventListener('submit', checkSignup);
