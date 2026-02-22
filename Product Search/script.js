const searchInput = document.getElementById("search");
const suggestionsBox = document.getElementById("suggestions");

searchInput.addEventListener("keyup", function () {
    let query = this.value;

    if (query.length < 3) {
        suggestionsBox.style.display = "none";
        return;
    }

    suggestionsBox.innerHTML = "<div class='loading'>Loading...</div>";
    suggestionsBox.style.display = "block";

    fetch("search.php?query=" + query)
        .then(response => response.json())
        .then(data => {
            suggestionsBox.innerHTML = "";

            if (data.length === 0) {
                suggestionsBox.innerHTML = "<div>No results found</div>";
                return;
            }

            data.forEach(product => {
                let div = document.createElement("div");
                div.innerHTML = `${product.name} (${product.sku}) - $${product.price}`;
                
                div.onclick = () => {
                    searchInput.value = product.name;
                    suggestionsBox.style.display = "none";
                };

                suggestionsBox.appendChild(div);
            });
        })
        .catch(error => {
            suggestionsBox.innerHTML = "<div class='text-danger'>Error loading results</div>";
            console.error(error);
        });
});