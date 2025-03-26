document.addEventListener("DOMContentLoaded", async () => {
  const tableBody = document.querySelector("#applications-table");

  // Fetch applications from backend
  async function loadApplications() {
    tableBody.innerHTML = ""; // Clear table before reloading

    const res = await fetch("http://localhost:5000/mentorship/applications");
    const applications = await res.json();

    applications.forEach((app) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${app.name}</td>
        <td>${app.email}</td>
        <td>${app.phone}</td>
        <td>${app.motivation}</td>
        <td>${app.status}</td>
        <td>
          <button class="approve-btn" data-id="${app._id}">Approve</button>
          <button class="reject-btn" data-id="${app._id}">Reject</button>
          <button class="delete-btn" data-id="${app._id}">Delete</button>
        </td>
      `;
      tableBody.appendChild(row);
    });

    // Add event listeners to buttons
    document.querySelectorAll(".approve-btn").forEach(button => {
      button.addEventListener("click", () => updateApplicationStatus(button.dataset.id, "Approved"));
    });

    document.querySelectorAll(".reject-btn").forEach(button => {
      button.addEventListener("click", () => updateApplicationStatus(button.dataset.id, "Rejected"));
    });

    document.querySelectorAll(".delete-btn").forEach(button => {
      button.addEventListener("click", () => deleteApplication(button.dataset.id));
    });
  }

  // Approve or reject an application
  async function updateApplicationStatus(id, status) {
    const res = await fetch(`http://localhost:5000/mentorship/applications/${id}`, {
      method: "PUT",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ status }),
    });

    if (res.ok) {
      alert(`Application ${status}`);
      loadApplications(); // Reload applications
    } else {
      alert("Error updating application");
    }
  }

  // Delete an application
  async function deleteApplication(id) {
    if (!confirm("Are you sure you want to delete this application?")) return;

    const res = await fetch(`http://localhost:5000/mentorship/applications/${id}`, {
      method: "DELETE",
    });

    if (res.ok) {
      alert("Application deleted");
      loadApplications();
    } else {
      alert("Error deleting application");
    }
  }

  // Load applications on page load
  loadApplications();
});
