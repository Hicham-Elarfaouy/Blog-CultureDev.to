function togglePassword(input){
    const togglePassword = document.querySelector('#iconPassword');
    const password = document.getElementById(input);

    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    togglePassword.classList.toggle('fa-eye');
    togglePassword.classList.toggle('fa-eye-slash');
}