document.addEventListener('DOMContentLoaded', function () {

    // Mise en hauteur automatique de tous les textarea
    var textareas = document.querySelectorAll('textarea');

    textareas.forEach(function (textarea) {
        textarea.style.height = textarea.scrollHeight + 'px'; // Set height to scrollHeight

        textarea.addEventListener('input', function () {
            this.style.height = this.scrollHeight + 'px'; // Set height to scrollHeight on input event
        });
    });

    /** Filtres des cours */
    // Sélectionner le formulaire avec l'ID "courseFilters"
    const form = document.getElementById('courseFilters');
    const inputs = form.querySelectorAll('input');

    // Fonction pour construire l'URL avec les champs non vides
    function buildUrl() {
        const baseUrl = "courses";
        const search = document.getElementById('search').value.trim();
        const topics = Array.from(form.querySelectorAll('.topics:checked')).map(option => option.value).join(',');
        const levels = Array.from(form.querySelectorAll('.levels:checked')).map(option => option.value).join(',');
        const types = Array.from(form.querySelectorAll('.types:checked')).map(option => option.value).join(',');

        // Construire l'URL en fonction des champs non vides
        let url = baseUrl;
        if (search !== '') {
            url += '?search=' + encodeURIComponent(search);
        }
        if (topics !== '') {
            url += (search !== '' ? '&' : '?') + 'topic=' + encodeURIComponent(topics);
        }
        if (levels !== '') {
            url += (search !== '' || topics !== '' ? '&' : '?') + 'level=' + encodeURIComponent(levels);
        }
        if (types !== '') {
            url += (search !== '' || topics !== '' || levels !== '' ? '&' : '?') + 'type=' + encodeURIComponent(types);
        }

        // Rediriger vers la nouvelle URL
        window.location.href = url;
    }


    inputs.forEach(function (input) {
        input.addEventListener('change', function submitForm() {
            buildUrl();
        });
    });
});
