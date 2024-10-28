<script>
    const password_input = document.querySelector('#password')
    const [show, hidden] = document.querySelectorAll('#eye');

    hidden.addEventListener('click', () => {
        hidden.setAttribute('hidden', '')
        show.removeAttribute('hidden');
        password_input.setAttribute('type', 'text')
    })

    show.addEventListener('click', () => {
        show.setAttribute('hidden', '')
        hidden.removeAttribute('hidden');
        password_input.setAttribute('type', 'password')
    })
</script>