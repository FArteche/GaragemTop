document.addEventListener('DOMContentLoaded', function() {

    // 1. Efeito de scroll na Navbar
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // 2. Lógica para o Modal de Confirmação de Exclusão
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    if (confirmDeleteModal) {
        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // O botão que acionou o modal
            const deleteUrl = button.getAttribute('data-delete-url'); // Pega a URL do atributo data
            const itemName = button.getAttribute('data-item-name'); // Pega o nome do item

            const modalBody = confirmDeleteModal.querySelector('.modal-body');
            const confirmDeleteBtn = confirmDeleteModal.querySelector('#confirmDeleteBtn');
            
            // Atualiza o texto do modal e o link do botão de confirmação
            modalBody.textContent = `Você tem certeza que deseja excluir o item "${itemName}"? Esta ação não pode ser desfeita.`;
            confirmDeleteBtn.setAttribute('href', deleteUrl);
        });
    }

    // 3. Lógica para mostrar notificações (Toasts)
    const toastElement = document.getElementById('notificationToast');
    if (toastElement) {
        const toast = new bootstrap.Toast(toastElement, {
            delay: 5000 // O toast desaparecerá após 5 segundos
        });
        toast.show();
    }
});