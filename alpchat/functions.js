const checkbox = document.getElementById('checkboxInput');

checkbox.addEventListener('change', function() {
    var login = document.querySelector(".form-login");
    var register = document.querySelector(".form-register");
    if (this.checked) {
        console.log('Checkbox is checked');
        register.style.display = "none";
        login.style.display = "block";
    } else {
        console.log('Checkbox is not checked');
        login.style.display = "none";
        register.style.display = "block";
    }
});

function login() {
    var email = document.getElementById("email1").value;
    var password = document.getElementById("password1").value;
    console.log(email);
    
    var formData = new FormData();
    formData.append("email1", email);
    formData.append("password1", password);

    fetch("login.php", {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(result => {
        if (result.startsWith("Error")) {
            alert(result); 
        } else {

            window.location.href = "http://127.0.0.1:3000"; // Adjusted URL
        }
    })
    .catch(error => {
        console.error('Error sending data:', error);
    });
}







function sendmail(authentication_token1,email)
{
    var formData = new FormData();
    formData.append("email", email);
    formData.append("authentication_token1", authentication_token1);




    fetch("send_email.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        if (result.startsWith("Error")) {
            alert(result);
        } else {
            console.log(result); 
        }
    })
    .catch(error => console.error('Error sending data:', error));
}



function authentication_token(length) {
    const charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    let token = '';
    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * charset.length);
        token += charset[randomIndex];
    }
    return token;
}





function register() {
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value
    var authentication_token1 = authentication_token(20);
    var authentication_flag = 0; // Assuming authentication_flag is a tinyint

    var formData = new FormData();
    formData.append("username", username);
    formData.append("email", email);
    formData.append("password", password);
    formData.append("authentication_token1", authentication_token1);
    formData.append("authentication_flag", authentication_flag);

    console.log(authentication_token1);
    console.log(username);


    fetch("register.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        console.log(result);
    })
    .catch(error => console.error('Error sending data:', error));
    sendmail(authentication_token1,email)

}





