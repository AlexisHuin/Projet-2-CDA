
// let forms = document.querySelectorAll('form')

// forms.forEach((form) => {
//     form.addEventListener('submit', function (e) {
//         e.preventDefault();

//         let formData = new FormData(this);
        
//         console.log(formData);

//         if (e.submitter.name == 'Accept') {
//             formData.set("Accept", "ok");
//         }
//         else if (e.submitter.name == 'Validate') {
//             formData.set("Validate", "ok");
//         }
//         else {
//             formData.set("Deny", "ok");
//         }

//         let url = window.location.href

//         fetch(window.location.href, {
//             method: 'POST',
//             body: formData
//         })
//             .then(response => response.json())
//             .then(data => {
//                 console.log(data);
//                 window.location.href = "mailto:" + data['Email'] + "?subject=" + data['Subject'] + "&body=" + data['Motif'];
//                 setTimeout(() => {
//                     window.location.href = url;
//                 }, 1000);
//             })
//             .catch(error => console.error('Erreur:', error));
//     })
// });