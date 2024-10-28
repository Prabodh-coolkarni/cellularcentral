
document.getElementById('filter-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    const selectedBrand = document.getElementById('brand').value;
    const selectedPrice = parseInt(document.getElementById('price-range').value);

    const products = document.querySelectorAll('#products .product');

    products.forEach(product => {
        const productBrand = product.getAttribute('data-brand');
        const productPrice = parseInt(product.getAttribute('data-price'));

        // Filter by brand (if a brand is selected)
        const brandMatch = selectedBrand === '' || productBrand === selectedBrand;

        // Filter by price
        const priceMatch = productPrice <= selectedPrice;

        // Show or hide product based on match
        if (brandMatch && priceMatch)
        {
            product.style.display = 'block'; // Show product
        } else
        {
            product.style.display = 'none'; // Hide product
        }
    });
});

