
let forms = document.querySelectorAll('form')

forms.forEach((form) => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        if (e.submitter.name == 'Accept') {
            formData.set("Accept", "ok");

        }
        else {
            formData.set("Deny", "ok");
        }

        fetch('/Admin/Dashboard', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                window.location.href = "mailto:" + data['Email'] + "?subject=" + data['Subject'] + "&body=" + data['Motif'];
                setTimeout(() => {
                    window.location.href = "/Admin/Dashboard" ;
                }, 1000);
            })
            .catch(error => console.error('Erreur:', error));
    })
});