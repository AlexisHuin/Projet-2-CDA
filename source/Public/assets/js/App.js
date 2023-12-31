document.getElementById("GoBack").addEventListener("click", () => {
  // -_-
  history.back();
});

// Tableau pour stocker les liens visités
document.addEventListener(
  "contextmenu",
  (e) => {
    e.preventDefault();
  },
  false
);

document.addEventListener('DOMContentLoaded', () => {
  let cart = document.getElementById('Cart')
  if (cart != undefined) {
    cart.addEventListener('click', () => {
      alert('Veuillez vous connecter afin de commencer les achats !');
    })
  }
})

if (window.location.href == "http://127.0.0.1:8000/") {
  let type = document.getElementById("type");
  let productName = document.getElementById("productName");

  type.addEventListener("input", filterProducts);
  productName.addEventListener("input", filterProducts);

  let h2_exists = false;

  function filterProducts() {
    let products = document.querySelectorAll(".product");
    let results = 0;
    for (let i = 0; i < products.length; i++) {
      const product = products[i];
      const productNameText = product
        .getElementsByClassName("product-description")[0]
        .getElementsByClassName("produit")[0].innerText;
      const productCategorie = product
        .getElementsByClassName("product-description")[0]
        .getElementsByClassName("categorie")[0]
        .getAttribute("data-id");

      if (
        (type.value === "all" || productCategorie == type.value) &&
        productNameText.toLowerCase().includes(productName.value.toLowerCase())
      ) {
        product.style.display = "block";
        results++;
      } else {
        product.style.display = "none";
      }
    }
    console.log(results);
    if (results == 0) {
      if (document.querySelector("#nothing") == null) {
        let h2 = document.createElement("h2");
        h2.setAttribute("id", "nothing");
        h2.innerText = "Aucun produit correspondant";
        document.querySelector(".products").appendChild(h2);
        h2_exists = true;
      }
    } else {
      if (document.querySelector("#nothing") != null) {
        document.getElementById("nothing").remove();
        h2_exists = false;
      }
    }
  }

  // Fonction pour gérer l'événement de pression des touches
  (function konamiCodeHandler() {
    // Séquence du Konami Code
    const konamiCode = [
      "arrowup",
      "arrowup",
      "arrowdown",
      "arrowdown",
      "arrowleft",
      "arrowright",
      "arrowleft",
      "arrowright",
      "b",
      "a",
    ];

    let konamiCodeIndex = 0;

    // Écouteur d'événements pour détecter les touches
    document.addEventListener("keydown", function (event) {
      // Vérifie si la touche pressée correspond à la prochaine dans la séquence
      if (event.key.toLowerCase() === konamiCode[konamiCodeIndex]) {
        konamiCodeIndex++;

        // Vérifie si la séquence a été complètement entrée
        if (konamiCodeIndex === konamiCode.length) {
          // Exécutez l'action associée au Konami Code ici

          function getRandomElementFromArray(arr) {
            const randomIndex = Math.floor(Math.random() * arr.length);
            return arr[randomIndex];
          }

          const PlayList = [
            "1.mp3",
            "2.mp3",
            "3.mp3",
            "4.mp3",
            "5.mp3",
            "6.mp3",
            "7.mp3",
            "8.mp3",
            "9.mp3",
            "10.mp3",
            "11.mp3",
            "12.mp3",
            "13.mp3",
            "14.mp3",
            "15.mp3",
            "16.mp3",
            "17.mp3",
            "18.mp3",
            "19.mp3",
            "20.mp3",
            "21.mp3",
            "22.mp3",
            "23.mp3",
            "24.mp3",
          ];
          const song = new Audio(
            "/assets/sounds/" + getRandomElementFromArray(PlayList)
          );

          song.play();

          // let iframe = document.getElementById('lubulule');
          // iframe.style.display = "block";
          // iframe.setAttribute('src', "https://www.youtube.com/embed/hziZJQSyotQ?autoplay=1&start=2")

          // setTimeout(() => {
          //     iframe.style.display = "none";
          //     alert('God mode activated, now... FINISH HIM !')
          // }, 8000)

          // Réinitialise l'index pour pouvoir entrer le code à nouveau
          konamiCodeIndex = 0;
        }
      } else {
        // Réinitialise l'index si une touche incorrecte est pressée
        konamiCodeIndex = 0;
      }
    });
  })();
}

// fonction pour JS pour géré l'ouverture de mes modales, elle permet aussi bien d'ouvrir et fermer.

if (window.location.href == "http://127.0.0.1:8000/User") {
  // if (window.location.href == "http://127.0.0.1:8000/User/Profile") {
  document.addEventListener("DOMContentLoaded", function () {
    let targetAdhe = document.querySelector("#Adherent");
    let targetProd = document.querySelector("#Producteur");
    let showAdhe = document.querySelector("#champAdherent");
    let showProd = document.querySelector("#champProducteur");

    function createInput(type, name, placeholder) {
      let input = document.createElement("input");
      input.setAttribute("type", type);
      input.setAttribute("name", name);
      input.setAttribute("placeholder", placeholder);

      let div = document.createElement("div");

      if (name === "Titulaire") {
        // Ajoute un h1 au-dessus de l'entrée "Titulaire"
        let heading = document.createElement("h1");
        let price = document.createElement('p');
        heading.textContent = "Coordonnées Bancaires";
        heading.style.textAlign = "center";
        price.textContent = "Vous serez débité de 15 euros, sois le prix de l'adhésion";
        price.style.textAlign = "center";
        price.style.color = "grey";
        div.appendChild(heading);
        div.appendChild(price);
      }

      div.appendChild(input);

      return div;
    }

    function createHeading(text) {
      let heading = document.createElement("h1");
      heading.textContent = text;
      heading.style.textAlign = "center";
      return heading;
    }

    targetAdhe.addEventListener("change", () => {

      showProd.style.display = "none"
      showAdhe.style.display = "block"
      // Effacer le contenu actuel de showAdhe
      showAdhe.innerHTML = "";

      // Ajouter les nouveaux éléments au bloc showAdhe
      showAdhe.appendChild(createInput("text", "GPS", "Coordonneés GPS"));
      showAdhe.appendChild(
        createInput("text", "CodePostal", "Votre Code Postal")
      );
      showAdhe.appendChild(createInput("tel", "Tel", "Votre N° Telephone"));

      showAdhe.appendChild(createInput("text", "Titulaire", "Titulaire"));
      showAdhe.appendChild(
        createInput("text", "NumeroCB", "Numéro CB")
      );
      showAdhe.appendChild(
        createInput("date", "DateExpiration", "Date expiration")
      );
      showAdhe.appendChild(createInput("text", "CVV", "CVV"));
      // Cacher le bloc Producteur si Adherent est sélectionné
    })
    targetProd.addEventListener("change", () => {
      showAdhe.style.display = "none"
      showProd.style.display = "block"
      showProd.innerHTML = "";

      // Ajouter les nouveaux éléments au bloc showProd
      showProd.appendChild(
        createInput("text", "RaisonSociale", "Raison Sociale")
      );
      showProd.appendChild(createInput("text", "GPS", "Coordonneés GPS"));
      showProd.appendChild(
        createInput("text", "CodePostal", "Votre Code Postal")
      );
      showProd.appendChild(createInput("tel", "Tel", "Votre N° Telephone"));
      // Cacher le bloc Adherent si Producteur est sélectionné


    });

  })
}

// ? Gestion modale pour résiliation CB
if (window.location.href == "http://127.0.0.1:8000/User/Profile") {
  function CloseOpenRes(button, div, display) {
    let target = document.querySelector(button);
    target.addEventListener("click", (e) => {
      e.preventDefault();
      document.querySelector(div).style.display = display;
    });
  }

  CloseOpenRes("#resiliationProfil", "#resiliationCoor", "flex");
  CloseOpenRes("#closeRes", "#resiliationCoor", "none");
}
// Code JS pour l'api MapTiles
// https://www.maptilesapi.com/

if (window.location.href == "http://127.0.0.1:8000/Contact") {
  var map = L.map("map").setView([47.5851502, 1.3333517], 20);
  L.tileLayer(
    "https://maptiles.p.rapidapi.com/en/map/v1/{z}/{x}/{y}.png?rapidapi-key=c4820222c7msh65f46e1adff42efp19af5bjsnfe9965f14b4c",
    {
      attribution:
        'Tiles &copy: <a href="https://www.maptilesapi.com/">MapTiles API</a>, Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
      maxZoom: 19,
    }
  ).addTo(map);

  //Fonction pour définir le logo sur la map

  var cursor = L.marker(map.getCenter(), {
    icon: L.divIcon({
      className: "cursor-icon",
      iconSize: [20, 20],
      html: '<div style="width: 20px; height: 20px; border: 2px solid red; border-radius: 50%;"></div>',
    }),
  }).addTo(map);
}

// Vérifier si l'URL actuelle est celle du bundle
if (window.location.href == "http://127.0.0.1:8000/Bundle") {
  // Fonction pour filtrer les éléments de la page bundle
  (function FiltrageBundle() {
    let input = document.querySelector("#searchInput_produitBundle");
    let cardBundles = document.querySelectorAll(".cardBundle");

    input.addEventListener("input", () => {
      let filterValue = input.value.toLowerCase().trim();

      for (let i = 0; i < cardBundles.length; i++) {
        let cardBundle = cardBundles[i];
        let text = cardBundle.textContent.toLowerCase();

        if (text.includes(filterValue)) {
          cardBundle.style.display = "flex";
          cardBundle.style.flexDirection = "column";
        } else {
          cardBundle.style.display = "none"; // Masquer le cardBundle s'il ne correspond pas
        }
      }
    });
  })();

  (function () {
    let form = document.querySelector("#bundle_form");
    let counter = 5;
    let addCount = document.querySelector(".addCount");
    let containerRight = document.querySelector(".container_bundle_right");

    let produitTargets = document.querySelectorAll(".cardBundle");
    let addButtonLeft = document.querySelectorAll(".addButtonLeft");
    let cardBundleArr = [];

    // let quantiteProduit = document.querySelectorAll('')

    let buttonSubmit = document.querySelector("#button_form-bundle");
    buttonSubmit.addEventListener("click", (e) => {
      if (counter === 5) {
        alert("Vous ne pouvez pas ajouter un bunble vide");
        e.preventDefault();
      } else if (counter === 4) {
        alert("Un bundle comprend minimum 2 produits");
        e.preventDefault();
      }
    });
    // Initialisatin et gestion du message pour le counter
    function updateCounter() {
      addCount.innerText = `Vous pouvez ajouter encore ${counter} produit${counter !== 1 ? "s" : ""
        }`;
      if (counter === 0) {
        addCount.innerText = "Vous ne pouvez plus ajouter de produit";
        addCount.style.color = "#ff0000";
      } else {
        addCount.style.color = "black";
      }

      // je gére ici avec le counter si j'ajoute la class ou retire .hidden des élément de gauche
      addButtonLeft.forEach((button) => {
        if (counter === 0) {
          button.classList.add("hidden");
        } else {
          button.classList.remove("hidden");
        }
      });
    }

    // Fonction qui gére la suppression des élément de droite
    function removeFromRight(e) {
      e.remove();
      counter++;
      updateCounter();

      // Réapparition de l'élément à gauche
      let correspondingLeftElement = document.querySelector(".interface_left");
      if (correspondingLeftElement) {
        correspondingLeftElement.style.display = "block";
      }
    }

    // Fonction qui gére le cloneNode ( je ne connaissais pas, c'est fantastique)
    function showCorrespondingElement(index) {
      // Je stock ici l'index de chaque élément de mon produitTargets qui retourne querrySelectorAll
      let correspondingHideElement = produitTargets[index];

      // Je met un premier controle pour savoir si je peux ajouter ou non des élements a droite d'aprés mon counter
      if (correspondingHideElement && counter > 0 && cardBundleArr.length < 5) {
        // Je clone la card de gauche suivant son index
        let clonedElement = correspondingHideElement.cloneNode(true);
        counter--;

        // Je prépare cible le bouton ajouter pour le supprimer de mon clone

        let buttonAjouter = clonedElement.querySelector("button");
        let buttonAjouterValue = buttonAjouter.value;

        // si il existe je le delete
        if (buttonAjouter) {
          buttonAjouter.parentNode.removeChild(buttonAjouter);
        }

        // je prépare mon bouton supprimer, et je récupére la value qui contiens l'id de mon produit ( je ne l'utilise pas au final)
        let buttonSupprimer = document.createElement("button");
        buttonSupprimer.className = "deleteProdBundle";
        buttonSupprimer.innerText = "Supprimer";
        buttonSupprimer.value = buttonAjouterValue;

        // ici j'appelle ma fonction removeFromRight au clic sur le boutton supprimer sur la partie droite, pour retiré un élément
        buttonSupprimer.addEventListener("click", function () {
          removeFromRight(this.closest(".cardBundle_hide"));
        });

        // suite a un soucis de CSS, la balise style m'a posé probléme alors que pas présente dans le fichier CSS, je la supprime de force
        // pour évité les problémes
        clonedElement.removeAttribute("style");
        clonedElement.classList.remove("cardBundle");
        clonedElement.classList.add("cardBundle_hide");

        //j'ajoute le bouton supprimé a mon clone en ayant retiré le bouton ajouter
        clonedElement.appendChild(buttonSupprimer);

        // AJOUT DE NOUVEAUX ELEMENTS AU CLONE
        // je dois bouclé sur toutes les cards car je pars d'un querrySelectorAll

        // Ajout de l'icone du chariot dans chaque BundleRight depuis le clone
        let targetQuantite = clonedElement.querySelectorAll("#quantiteBundle");
        targetQuantite.forEach((quantiteElement) => {
          let imgElement = document.createElement("img");
          imgElement.style.width = "50%";
          imgElement.src = "assets/images/arrow-down.svg";
          quantiteElement.insertAdjacentHTML("afterend", imgElement.outerHTML);
        });

        // Ajout de l'input de quantité dans chaque BundleRight depuis le clone
        let inputQuantite = clonedElement.querySelectorAll("#svgBundle");
        inputQuantite.forEach((quantiteElement) => {
          let inputQuantite = document.createElement("input");
          inputQuantite.name = "QuantiteProduitsBundle[]";

          inputQuantite.type = "number";
          inputQuantite.style.width = "50%";
          inputQuantite.min = "0"; // Valeur minimale autorisée
          inputQuantite.required = true;

          inputQuantite.classList.add("bundleInput", "newInput");
          quantiteElement.insertAdjacentHTML(
            "afterend",
            inputQuantite.outerHTML
          );
        });

        form.addEventListener("submit", (e) => {
          let inputQuantite = document.querySelector(
            "input[name='QuantiteProduitsBundle[]']"
          );
          if (inputQuantite.value === "" || inputQuantite.value === "0") {
            alert(
              "La quantité ne peut pas être vide ou égale à 0. Veuillez saisir une valeur valide."
            );
            e.preventDefault();
          }
        });

        // // Ajout de l'input de prix dans chaque BundleRight depuis le clone
        // let inputPrix = clonedElement.querySelectorAll("#prixArticleBundle");
        // inputPrix.forEach((quantiteElement) => {
        //   let inputPrix = document.createElement("input");
        //   inputPrix.name = "PrixBundle[]";
        //   inputPrix.type = "number";
        //   inputPrix.style.width = "10%";
        //   inputPrix.style.flex = "1";
        //   console.log(inputPrix)
        //   quantiteElement.insertAdjacentHTML("afterend", inputPrix.outerHTML);
        // });

        // ici j'intégre mon éléments cloné, et complété dans la partie de droite
        containerRight.appendChild(clonedElement);

        // ? Fonction de vérification pour ne pas ajouter plus que la quantitée disponible
        let targetInputs = clonedElement.querySelectorAll(".newInput");

        targetInputs.forEach((targetInput) => {
          targetInput.addEventListener("input", () => {
            let inputValue = targetInput.value;
            let labelValue = targetInput
              .closest(".cardBundle_hide")
              .querySelector("#quantiteBundle")
              .getAttribute("data-label");
            console.log(inputValue);
            console.log(labelValue);

            let labelIntValue = parseInt(labelValue, 10);
            if (inputValue > labelIntValue) {
              targetInput.value = labelValue;
            }
          });
        });
        updateCounter();
      }
    }

    // le coeur de ma fonction, pour chaque boutons ajouter, j'écoute l'événement, et au click, je fais disparaitre la card a gauche, et grace a
    // showCorrespondingElement j'ajoute et personnalise la card de droite
    produitTargets.forEach((produitTarget, index) => {
      let targetButton = produitTarget.querySelector("button");
      if (targetButton) {
        targetButton.addEventListener("click", () => {
          produitTarget.style.display = "none";
          showCorrespondingElement(index);
        });
      }
    });

    updateCounter();
  })();
}
