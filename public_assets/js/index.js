document.addEventListener("DOMContentLoaded", function () {
  // Select forms and error display
  const signupForm = document.getElementById("signupForm");
  const loginForm = document.getElementById("loginForm");
  const errorMsgDiv = document.getElementById("error-msg");

  // --- Regex Patterns ---

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  const usernameRegex = /^[a-zA-Z0-9_]{3,20}$/;

  const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/;

  // Helper function to show errors
  function showError(message) {
    if (errorMsgDiv) {
      errorMsgDiv.textContent = message;
      errorMsgDiv.style.display = "block";
      errorMsgDiv.style.color = "#dc2626";
      errorMsgDiv.style.backgroundColor = "#fee2e2";
      errorMsgDiv.style.padding = "10px";
      errorMsgDiv.style.marginBottom = "15px";
      errorMsgDiv.style.borderRadius = "5px";
      errorMsgDiv.style.textAlign = "center";
    }
  }

  if (signupForm) {
    signupForm.addEventListener("submit", function (e) {
      const username = document.getElementById("username").value.trim();
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirm_password").value;

      if (!usernameRegex.test(username)) {
        e.preventDefault();
        showError(
          "Username must be 3-20 characters long and can only contain letters, numbers, and underscores."
        );
        return;
      }
      // Validate Email
      if (!emailRegex.test(email)) {
        e.preventDefault();
        showError("Please enter a valid email address.");
        return;
      }

      if (!passwordRegex.test(password)) {
        e.preventDefault();
        showError(
          "Password must be at least 8 characters long and contain at least one letter and one number."
        );
        return;
      }

      if (password !== confirmPassword) {
        e.preventDefault();
        showError("Passwords do not match.");
        return;
      }
    });
  }

  // --- 2. Login Page Validation ---
  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value;

      // Validate Email Format
      if (!emailRegex.test(email)) {
        e.preventDefault();
        showError("Please enter a valid email address.");
        return;
      }

      if (password === "") {
        e.preventDefault();
        showError("Please enter your password.");
        return;
      }
    });
  }
});
