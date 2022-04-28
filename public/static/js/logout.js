function logout() {
    localStorage.removeItem("token");
    location.reload();
}
