const btnAddPet = document.getElementById('btn_add_pet');
const Form = document.getElementById('form_pet');

const Message = document.getElementById('error_message');

btnAddPet.addEventListener('click', function(event){
    event.preventDefault();
    Form.classList.toggle('d-none'); // Basculer l'affichage
    Form.classList.toggle('d-block');
});


Form.addEventListener('submit', function(e){
    const name = document.getElementById('pet_name').value.trim();
    const type = document.getElementById('type').value.trim();

    if(!name || !type){
        e.preventDefault();
        Message.textContent='Tous les champs sont obligatoires.';
        return
    };

Message.textContent = "";
Message.className = "";

const formData = new FormData(Form);

fetch('add_pet.php',{
    method: 'POST',
    body: formData
})
.then(response =>response.json())
.then(data=>{
    if(data.success){
        Message.textContent = data.message;

        Form.reset();
    }else{
        Message.textContent = data.message;
        Message.className = 'error';
    }
})
.catch(error=>{
    console.error('Erreur :', error);
        Message.textContent = 'Erreur de communication avec le serveur.';
        Message.className = 'error';
})
});
