document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#admin-login-form");
    const errorMessage = document.querySelector("#error-message");

    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const email = document.querySelector("#email").value;
        const password = document.querySelector("#password").value;

        // Dummy admin credentials (replace with backend API request)
        const adminCredentials = {
            email: "admin@herimpacthub.com",
            password: "admin123"
        };

        if (email === adminCredentials.email && password === adminCredentials.password) {
            localStorage.setItem("adminToken", "secure-token"); // Store login session
            window.location.href = "admin-dashboard.html"; // Redirect to dashboard
        } else {
            errorMessage.textContent = "Invalid email or password!";
        }
    });
});
