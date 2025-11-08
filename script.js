

const btnAddPet = document.getElementById('btn_add_pet');
const FormContainer = document.getElementById('form_pet_container');
const FormPet = document.getElementById('form_pet');
const FormCo = document.getElementById('form_connexion');

const Message = document.getElementById('message');



if (btnAddPet && FormContainer){
 btnAddPet.addEventListener('click', function(event){
    event.preventDefault();
    FormContainer.classList.toggle('d-none'); // Basculer l'affichage
    FormContainer.classList.toggle('d-block');
})
};





//formulaire d'ajout animal//
if(FormPet){
FormPet.addEventListener('submit', function(e){

e.preventDefault();
const name = document.getElementById('pet_name').value.trim();
const type = document.getElementById('type').value.trim();

    if (!name || !type) {
        Message.textContent = "Tous les champs sont obligatoires.";
        Message.style.color = "red";
        return; // stoppe l'exécution, n'envoie pas le fetch
    }
const formData = new FormData(this);
fetch('add_pet.php',{
    method: 'POST',
    body: formData
})
.then(response =>response.json())
.then(data=>{
    if(data.success){
        Message.textContent = data.message;
        Message.style.color='green';
        FormPet.reset();

    }else{
        Message.textContent = data.message;
        Message.style.color = 'red';
    }
})
.catch(error=>{
    console.error('Erreur :', error);
        Message.textContent = 'Erreur de communication avec le serveur.';
        Message.style.color = 'red';
})
});
};
//formulaire de connexion user//

if(FormCo){

FormCo.addEventListener('submit', function(e){

    e.preventDefault();

    const formData = new FormData(this);
    const msg = document.getElementById('message');
    
    fetch('login_process.php',{
        method: 'POST',
        body: formData
    })
    .then(res=>res.json())
    .then(data=>{
   
        msg.textContent = '';
        msg.className = 'text-center mt-3';

        if(data.success === true){
           
            window.location.href='dashboard_admin.php';
        }else{
            msg.textContent = data.message;
             msg.classList.add('text-danger');
        }
    })

});
};