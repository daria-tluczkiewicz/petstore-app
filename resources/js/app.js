import './bootstrap';

const deletePetButtons = document.querySelectorAll('.pet .delete');

if(deletePetButtons){
  deletePetButtons.forEach(deletePetButton => {
    deletePetButton.addEventListener('click', async (e) => {
      const pet = deletePetButton.closest('.pet')
      const petId = pet.getAttribute('data-id')
      try {
        await axios.delete(`/pets/${petId}`);
        pet.remove()
      } catch (error) {
        throw new Error(error);
      }
    })
  })
}


