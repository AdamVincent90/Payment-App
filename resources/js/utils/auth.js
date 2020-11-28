export function checkLoggedIn() {
    return localStorage.getItem('isLoggedIn') === 'true';
}

export function logIn() {
    localStorage.setItem('isLoggedIn', true);
}

export function logOut() {
    localStorage.setItem('isLoggedIn', false);
}