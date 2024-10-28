
document.addEventListener('DOMContentLoaded', () => {
    const filterForm = document.getElementById('filter-form');
    
    filterForm.addEventListener('submit', (event) => {
        event.preventDefault();
        
        const minPrice = document.getElementById('min-price').value;
        const maxPrice = document.getElementById('max-price').value;
        const categories = Array.from(document.querySelectorAll('input[name="category"]:checked')).map(checkbox => checkbox.value);
        const rating = document.querySelector('input[name="rating"]:checked')?.value;
        
        console.log('Filters applied:');
        console.log('Min Price:', minPrice);
        console.log('Max Price:', maxPrice);
        console.log('Categories:', categories);
        console.log('Rating:', rating);
        
        // Here you would typically send the filter values to the server
        // or filter the products client-side based on these values.
    });
});
;
