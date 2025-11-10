const registerMessage = document.getElementById('register_message');
const formRegister = document.getElementById('form_register');


if(formRegister){
formRegister.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(formRegister);

    try {
        const response = await fetch('register.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (result.success) {
            registerMessage.textContent = 'Inscription réussie !';
            registerMessage.classList.add('colormessage');
            formRegister.reset();
             setTimeout(() => {
                window.location.href = 'dashboard_user.php';
            }, 3000);
        } else {
            registerMessage.textContent = result.error;
        registerMessage.classList.add('errormessage');
        }
    } catch (error) {
        console.error('Erreur:', error);
        registerMessage.textContent = 'Erreur serveur, veuillez réessayer.';
        registerMessage.classList.add('errormessage');
    }
});
}