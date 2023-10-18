
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="./assets/css/style.css?<?= time(); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <div class="logo-div">
                    <a href="/"><img class="logo_coop" src="./assets/images/logo-coop.png" alt="Logo-Cooperative"></a>
                </div>


                <div class="authentification-div">
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === "Adherent") : ?>
                        <a href="../source/assets/Panier.php"><img class="header_img" src="../assets/images/cart.svg" alt="Cart"></a>
                        <a href="../source/assets/Profile.php"><img class="header_img" src="./assets/images/profile.svg" alt="Profile"></a>
                        <a href="../source/assets/Deconnexion.php"><img class="header_img" src="./assets/images/logout.svg" alt="Logout"></a>

                    <?php elseif (isset($_SESSION['user']) && $_SESSION['user']['role'] === "Producteur") : ?>
                        <a href="../source/assets/Profile.php"><img class="header_img" src="./assets/images/profile.svg" alt="Profile"></a>
                        <a href="../source/assets/Deconnexion.php"><img class="header_img" src="./assets/images/logout.svg" alt="Logout"></a>

                    <?php else : ?>
                        <a href="../source/assets/.php"><img class="header_img" src="./assets/images/cart.svg" alt="Cart"></a>
                        <a href="../source/assets/Login.php"><img class="header_img" src="./assets/images/login.svg" alt="Login"></a>
                    <?php endif; ?>
                </div>
            </ul>
        </nav>
    </header>
    


    <div class="filters">
    
    <label for="type">Type :</label>
    <select id="type">
        <option value="all">Tous les types</option>
        {foreach key=key item=categorie from=$categories}
            <option value="{$categorie['DesignationCategorie']}">{$categorie['DesignationCategorie']}</option>
        {/foreach}
    </select>

    <input type="text" id="productName" placeholder="Nom du produit">
    <button onclick="filterProducts()">Filtrer</button>
</div>


    <div class="image-with-text">
        <img src="./assets/images/fruit.jpg" alt="Votre Image">
        <div class="text-overlay">
            <p>Une AMAP, ou Association pour le Maintien de l'Agriculture Paysanne, est un partenariat entre des consommateurs et des agriculteurs locaux. Les membres de l'AMAP s'engagent à acheter régulièrement des produits frais directement auprès des agriculteurs, favorisant ainsi une agriculture durable et équitable.</p>
        </div>
    </div>
   

    <div class="products">
    {foreach key=key item=product from=$products}
        <div class="product">
                <img src="./assets/images/fruit.jpg" alt="<?= $product['name'] ?>">
                <div class="product-description">
                    <h3>{$product['DesignationProduit']} </h3>
                    <h4>{$product['DesignationCategorie']}</h4>
                    <p>{$product['NomSaison']}</p>
                </div>
       </div>
    {/foreach}
    </div>

    <script>
    function filterProducts() {
        const type = document.getElementById("type").value;
        const productName = document.getElementById("productName").value;
        const products = document.getElementsByClassName("product");
   
        for (let i = 0; i < products.length; i++) {
            const product = products[i];
            const productNameText = product.getElementsByClassName("product-description")[0].getElementsByTagName("h3")[0].innerText;
            const productCategorie = product.getElementsByClassName("product-description")[0].getElementsByTagName("h4")[0].innerText;
           

            if ((type === 'all' || productCategorie.includes(type)) &&
                (productNameText.toLowerCase().includes(productName.toLowerCase()))) {
                product.style.display = "block";
            } else {
                product.style.display = "none";
            }
        }
    }
</script>

