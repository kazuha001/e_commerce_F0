const { response } = require("express");

document.getElementById("myform2").addEventListener("submit", function(event) {

    event.preventDefault();

    var redwarningId = document.getElementById("redwarning")

    let formData = new FormData(this)

    fetch("php/api_protection.php", {

        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message)
        }else {
            alert("Error" + data.message)

            redwarningId.style.border = "2px solid #f00"
        }
    })

})

window.addEventListener("beforeunload", () => {

    window.location.href = "logout.php"

})