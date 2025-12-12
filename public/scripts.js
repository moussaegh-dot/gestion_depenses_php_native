const container = document.querySelector('.container');
const registerBtn = document.querySelector('.register-btn');
const loginBtn = document.querySelector('.login-btn');

registerBtn.addEventListener('click', () =>{
    container.classList.add('active'); //Afficher Register
});

loginBtn.addEventListener('click', () => {
    container.classList.remove('active'); // Affiche login
});