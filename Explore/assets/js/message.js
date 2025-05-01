document.querySelectorAll(".interestedButton").forEach(button => {
  button.addEventListener("click", function() {
    const projectId = this.getAttribute("data-project-id");
    const ownerEmail = this.getAttribute("data-owner-email");

    // Populate hidden fields in the modal form
    document.getElementById("project_id").value = projectId;
    document.getElementById("receiver_email").value = ownerEmail;

    // Display the modal
    document.getElementById("messageModal").style.display = "block";
  });
});

// Close the modal
function closeModal() {
  document.getElementById("messageModal").style.display = "none";
}

