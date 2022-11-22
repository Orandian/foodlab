let peye = document.querySelector(".pwd-eye"),
    peyeSlash = document.querySelector(".pwd-eye-slash");

// for password eye icon addEventListener
peyeSlash.addEventListener("click", function() {
    peyeSlash.style.display = "none";
    peye.style.display = "block";
    password.setAttribute("type", "text");
});

peye.addEventListener("click", function() {
    peye.style.display = "none";
    peyeSlash.style.display = "block";
    password.setAttribute("type", "password");
});