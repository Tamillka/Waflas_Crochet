function toggleForm() {
    var form = document.getElementById('passwordForm');
    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
    } else {
        form.classList.add('hidden');
    }
}