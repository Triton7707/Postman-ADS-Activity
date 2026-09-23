function showModal(modal) {
    modal.style.display = "flex";
}

function hideModal(modal) {
    modal.style.display = "none";
}

function escapeHTML(value) {
    const div = document.createElement("div");
    div.textContent = value;
    return div.innerHTML;
}