function filterProducts() {
    const type = document.getElementById("type").value;
    const saison = document.getElementById("saison").value;
    const productName = document.getElementById("productName").value;
    const products = document.getElementsByClassName("product");

    for (let i = 0; i < products.length; i++) {
        const product = products[i];
        const productNameText = product.getElementsByClassName("product-description")[0].getElementsByTagName("h3")[0].innerText;
        const productCategorie = product.getElementsByClassName("product-description")[0].getElementsByTagName("h4")[0].innerText;
        const productSaison = product.getElementsByClassName("product-description")[0].getElementsByTagName("p")[0].innerText;

        if ((type === 'all' || productCategorie.includes(type)) &&
            (saison === 'all' || productSaison.toLowerCase().includes(saison.toLowerCase())) &&
            (productNameText.toLowerCase().includes(productName.toLowerCase()))) {
            product.style.display = "block";
        } else {
            product.style.display = "none";
        }
    }
}