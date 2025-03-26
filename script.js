document.addEventListener("DOMContentLoaded", function () {
    // Smooth Scrolling for Navigation Links
    document.querySelectorAll("nav ul li a").forEach(anchor => {
        anchor.addEventListener("click", function (event) {
            if (this.getAttribute("href").startsWith("#")) {
                event.preventDefault();
                const targetId = this.getAttribute("href").substring(1);
                document.getElementById(targetId).scrollIntoView({ behavior: "smooth" });
            }
        });
    });

    // Toggle Mobile Menu
    const menuToggle = document.querySelector(".menu-toggle");
    const navMenu = document.querySelector("nav ul");
    
    if (menuToggle) {
        menuToggle.addEventListener("click", function () {
            navMenu.classList.toggle("active");
        });
    }

    // Form Validation for Apply Pages
    const applyForms = document.querySelectorAll(".apply-form");
    
    applyForms.forEach(form => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            
            let valid = true;
            const inputs = form.querySelectorAll("input, textarea, select");
            
            inputs.forEach(input => {
                if (input.value.trim() === "") {
                    valid = false;
                    input.style.border = "2px solid red";
                } else {
                    input.style.border = "1px solid #ccc";
                }
            });

            if (valid) {
                alert("Application submitted successfully!");
                form.reset();
            } else {
                alert("Please fill out all required fields.");
            }
        });
    });

    // Join Button Alert
    const joinButtons = document.querySelectorAll(".btn-join");
    
    joinButtons.forEach(button => {
        button.addEventListener("click", function () {
            alert("Thank you for your interest in joining HerImpactHub!");
        });
    });

    // Mentor Card Hover Effect
    const mentorCards = document.querySelectorAll(".mentor-card");

    mentorCards.forEach(card => {
        card.addEventListener("mouseenter", function () {
            this.style.transform = "scale(1.05)";
            this.style.boxShadow = "0 4px 10px rgba(0,0,0,0.2)";
        });
        
        card.addEventListener("mouseleave", function () {
            this.style.transform = "scale(1)";
            this.style.boxShadow = "none";
        });
    });
});
