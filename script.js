

const btnAddPet = document.getElementById('btn_add_pet');
const FormContainer = document.getElementById('form_pet_container');
const FormPet = document.getElementById('form_pet');
const FormCo = document.getElementById('form_connexion');

const Message = document.getElementById('message');

const btnListPet = document.getElementById('btn_list_pet');
const ListPet = document.getElementById('list_pet_container');



if (btnAddPet && FormContainer){
 btnAddPet.addEventListener('click', function(event){
    event.preventDefault();
    FormContainer.classList.remove('d-none'); // Basculer l'affichage
    FormContainer.classList.add('d-block');

    ListPet.classList.add('d-none'); // cache la liste
    ListPet.classList.remove('d-block');
})
};

if (btnListPet && ListPet){ 
 btnListPet.addEventListener('click', function(event){
    event.preventDefault();
    ListPet.classList.remove('d-none'); // Basculer l'affichage
    ListPet.classList.add('d-block');

    FormContainer.classList.add('d-none'); // cache le formulaire
    FormContainer.classList.remove('d-block');
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
        setTimeout(() => {
            Message.textContent = "";
        }, 3000);

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


         //Afficher tableau des animaux //

async function loadPets() {
    try {
        const response = await fetch('get_pets.php'); // Vérifie le chemin
        const pets = await response.json();

        const tbody = document.querySelector('#pets_table tbody');
        tbody.innerHTML = ''; // vide le tableau avant ajout

        if (pets.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4">Aucun animal trouvé</td></tr>';
            return;
        }

        pets.forEach(pet => {
            const row = `
                <tr>
                    <td>${pet.id}</td>
                    <td>${pet.name}</td>
                    <td>${pet.type}</td>
                    <td>${pet.gender}</td>
                </tr>
            `;
            tbody.innerHTML += row;
        });

    } catch (error) {
        console.error('Erreur lors du chargement des animaux :', error);
    }
}

loadPets();