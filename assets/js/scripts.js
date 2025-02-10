document.addEventListener("DOMContentLoaded", function() {
    // Manejar el botón de detalles
    const detailsButtons = document.querySelectorAll(".details-btn");

    detailsButtons.forEach(button => {
        button.addEventListener("click", function() {
            const taskTitle = this.getAttribute("data-title");
            const taskDescription = this.getAttribute("data-description");

            document.getElementById("detailsTitle").textContent = taskTitle;
            document.getElementById("detailsDescription").textContent = taskDescription;

            const modal = new bootstrap.Modal(document.getElementById("taskDetailsModal"));
            modal.show();
        });
    });

    // Manejar el botón de edición
    const editButtons = document.querySelectorAll(".edit-btn");

    editButtons.forEach(button => {
        button.addEventListener("click", function() {
            const taskId = this.getAttribute("data-id");
            const taskTitle = this.getAttribute("data-title");
            const taskDescription = this.getAttribute("data-description");

            document.getElementById("editTaskId").value = taskId;
            document.getElementById("editTitle").value = taskTitle;
            document.getElementById("editDescription").value = taskDescription;

            const modal = new bootstrap.Modal(document.getElementById("editTaskModal"));
            modal.show();
        });
    });
});
