document.getElementById("editBtn").addEventListener("click", function() {
    let inputs = document.querySelectorAll("#userForm input");
    inputs.forEach(input => input.removeAttribute("disabled"));

    document.getElementById("editBtn").classList.add("d-none");
    document.getElementById("saveBtn").classList.remove("d-none");
});

document.getElementById("saveBtn").addEventListener("click", function() {
    let inputs = document.querySelectorAll("#userForm input");
    inputs.forEach(input => input.setAttribute("disabled", "true"));

    document.getElementById("editBtn").classList.remove("d-none");
    document.getElementById("saveBtn").classList.add("d-none");
});