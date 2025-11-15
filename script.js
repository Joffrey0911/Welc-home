

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

    const Add = document.querySelector('#form_pet');
    Add.scrollIntoView({ behavior: 'smooth', block: 'center' });
})
};

if (btnListPet && ListPet){ 
 btnListPet.addEventListener('click', function(event){
    event.preventDefault();
    ListPet.classList.remove('d-none'); // Basculer l'affichage
    ListPet.classList.add('d-block');

    FormContainer.classList.add('d-none'); // cache le formulaire
    FormContainer.classList.remove('d-block');

    const table = document.querySelector('#pets_table');
    table.scrollIntoView({ behavior: 'smooth', block: 'center' });
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
//formulaire de connexion //





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

        if(data.success === true && data.role_id == 1){


            window.location.href='dashboard_admin.php';
        }else if(data.success === true && data.role_id == 0){
             window.location.href='dashboard_user.php';
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
         
        const tbody = document.querySelector('#pets_table tbody');
  
        const row = document.createElement('tr');


            let genderClass = '';
        if (pet.gender === 'Mâle') {
            genderClass = 'male';
        } else if (pet.gender === 'Femelle') {
            genderClass = 'female';
        } else {
            genderClass = 'unknown';
            
        }
        let actionButton = '';
            if (userRole === 1) { 
                actionButton = `<button class="btn btn-danger btn-sm" onclick="deletePet(${pet.id}, this)">Supprimer</button>`;
            } else {
                actionButton = `<button class="btn btn-success btn-sm" onclick="adoptPet(${pet.id})">Adopter</button>`;
            }

    
            //Classe name pour modifier le style en fonction du genre //
            row.innerHTML = `
            <td>${pet.id}</td>
            <td class="pet-name ${genderClass}">${pet.name}</td>  
            <td>${pet.type}</td>
            <td>${pet.gender}</td>
            <td>
                ${actionButton}
            </td>`;
 

            tbody.appendChild(row);
        });

    } catch (error) {
        console.error('Erreur lors du chargement des animaux :', error);
    }
}
const tbody = document.querySelector('#pets_table tbody');
if (tbody) {
    tbody.innerHTML = '';
loadPets();
}



     //FONCTION DE SUPPRESSION DE L'ANIMAL//

async function deletePet(id, btn){
    if (!confirm('Voulez vous vraiment supprimer cet animal?')) return;

    try{
        const response = await fetch('delete_pets.php',{
            method : 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `id=${id}`
    });

        const result = await response.json();
        if (result.success) {
      // Supprime la ligne du tableau
      const row = btn.closest('tr');
      row.remove();
      alert("Animal supprimé avec succès !");
    } else {
      alert("Erreur : " + result.message);
    }

  } catch (error) {
    console.error("Erreur lors de la suppression :", error);
  }
};
        
    
 //RECHERCHE ANIMAL//

 // Fonction pour filtrer les animaux par nom
function filterPetsByName() {
  const searchValue = document.querySelector('#search_pet').value.toLowerCase();
  const rows = document.querySelectorAll('#pets_table tbody tr');

  rows.forEach(row => {
    const nameCell = row.querySelector('td.pet-name');
    if (!nameCell) return; // sécurité
    const name = nameCell.textContent.toLowerCase();
    // Si le nom contient la valeur recherchée, on affiche la ligne, sinon on la cache
    row.style.display = name.includes(searchValue) ? '' : 'none';
  });
}

// On écoute l'événement input du champ de recherche
const searchInput = document.querySelector('#search_pet');
if (searchInput) {
    searchInput.addEventListener('input', filterPetsByName);
}

//UPDATE PHOTO USER//

/*const photoButton = document.getElementById('btn_photo');
const phot = document.getElementById('photo');
const messageProfil = document.getElementById('message_profil_form');
const buttonSubmitPhoto = document.getElementById('btn_form_profil');
const formProfil = document.getElementById('profilForm');


if (formProfil) {
    formProfil.addEventListener('submit', (e) => {
        e.preventDefault();

        const fileInput = document.getElementById('photo');
        const file = fileInput.files[0];

        if (!file) {
            messageProfil.innerHTML = "<p class='text-danger'>Veuillez choisir une image.</p>";
            return;
        }

        let formData = new FormData();
        formData.append('photo', file);

        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {

            if (data.success) {
                messageProfil.textContent = data.message;
                messageProfil.style.color = 'green';
                formProfil.reset();

                setTimeout(() => {
                    messageProfil.textContent = "";
                }, 3000);

            } else {
                messageProfil.textContent = data.message;
                messageProfil.style.color = 'red';
            }
        })
        .catch(error => {
            console.error('Erreur :', error);
            messageProfil.textContent = 'Erreur de communication avec le serveur.';
            messageProfil.style.color = 'red';
        });
    });
}
*/

const btnUserListPet = document.getElementById('btn_user_listpet');
const Profil = document.getElementById('btn_profil');

const zoneProfil = document.getElementById('zoneProfil');
const zoneTableau = document.getElementById('zoneTableau');
const dynamicContainer = document.getElementById('dynamicContainer');

// Afficher formulaire profil
Profil.addEventListener('click', () => {
    dynamicContainer.classList.remove('d-none');

    zoneProfil.classList.remove('d-none');
    zoneTableau.classList.add('d-none');
});

// Afficher tableau des animaux
btnUserListPet.addEventListener('click', () => {
    dynamicContainer.classList.remove('d-none');

    zoneProfil.classList.add('d-none');
    zoneTableau.classList.remove('d-none');
});