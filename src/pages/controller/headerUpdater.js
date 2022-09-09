function updateHeader(login) {
    if(login) {
        let loggedOut = document.getElementById("loggedOut");
        let loggedIn = document.getElementById("loggedIn");

        loggedOut.style.display = 'none';
        loggedIn.style.display = 'flex';
    }
}