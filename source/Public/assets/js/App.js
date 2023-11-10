// document.addEventListener('contextmenu', (e) => {
//   console.log('salut');
//   e.preventDefault();
// }, false)

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

if (window.location.href == "http://127.0.0.1:8000/User/Profile") {
  function CloseOpen(button, div, display) {
    let target = document.querySelector(button);
    target.addEventListener("click", () => {
      document.querySelector(div).style.display = display;
    });
  }

  CloseOpen(".paiementButton", "#paiementCoor", "flex");
  CloseOpen("#closeButton", "#paiementCoor", "none");
  CloseOpen("#resiliationProfil", "#resiliationCoor", "flex");
  CloseOpen("#closeRes", "#resiliationCoor", "none");
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

  // Bloc de code pour la page bundle
  (function () {
    // Déclaration de la variable counter en dehors des fonctions
    let counter = 5;

    // Récupération des éléments DOM une seule fois
    let addCount = document.querySelector(".addCount");
    let produitTargets = document.querySelectorAll(".cardBundle");
    let produitTargetsHide = document.querySelectorAll(".cardBundle_hide");
    let cardBundleHide = document.querySelectorAll(".cardBundle_hide");
    let cardBundleArr = [];

    // Mettre à jour le texte du compteur
    function updateCounter() {
      addCount.innerText = `Vous pouvez ajouter encore ${counter} produit${
        counter !== 1 ? "s" : ""
      }`;
      if (counter === 0) {
        addCount.innerText = "Vous ne pouvez plus ajouter de produit";
        addCount.style.color = "red";
      }
    }

    // Fonction pour afficher l'élément correspondant
    function showCorrespondingElement(button, index) {
      let buttonId = button.name;
      let correspondingHideElement = produitTargetsHide[index];

      if (
        correspondingHideElement &&
        counter >= 1 &&
        !cardBundleArr.includes(correspondingHideElement)
      ) {
        correspondingHideElement.style.display = "flex";
        counter--;
        cardBundleArr.push(correspondingHideElement);
        // Mettre à jour le compteur après chaque ajout
        updateCounter();
      }
    }

    // Fonction pour supprimer un produit
    function deleteProductFromBundle() {
      let countColor = document.querySelector(".addCount");
      cardBundleHide.forEach((produitTargetHide) => {
        let target = produitTargetHide.querySelector(".deleteProdBundle");
        target.addEventListener("click", (e) => {
          e.preventDefault();
          produitTargetHide.style.display = "none";
          countColor.style.color = "black";
          counter++;
          updateCounter();
        });
      });
    }

    // Ajouter des écouteurs d'événements pour chaque produit
    produitTargets.forEach((produitTarget, index) => {
      let target = produitTarget.querySelector("button");
      target.addEventListener("click", () => {
        showCorrespondingElement(target, index);
      });
    });

    // Appeler la fonction pour initialiser le compteur
    updateCounter();

    // Appeler la fonction pour supprimer un produit
    deleteProductFromBundle();
  })();
}