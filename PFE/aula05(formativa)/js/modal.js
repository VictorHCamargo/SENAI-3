const commentModal = document.getElementById('commentModal');
const commentButtons = document.querySelectorAll('.actions-left .action-btn:nth-child(2)');
const commentInput = document.getElementById('commentInput');

commentButtons.forEach(button => {
    button.addEventListener('click', () => {
        commentModal.classList.add('active');
        commentInput.focus();
    });
});

function closeModal() {
    commentModal.classList.remove('active');
    commentInput.value = '';
}

function sendComment() {
    const text = commentInput.value.trim();
    if (text !== '') {
        closeModal();
    }
}

commentModal.addEventListener('click', (e) => {
    if (e.target === commentModal) {
        closeModal();
    }
});