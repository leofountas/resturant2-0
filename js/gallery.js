
document.addEventListener("DOMContentLoaded", function () {
    const photos = [
        '../images/margherita.png',
        '../images/margherita2.0.png',
        '../images/pizzalul.png',
        '../images/cookingpizza.png',
        '../images/pizzarucola1.png',
        '../images/pineapplepizza.png',
        'https://via.placeholder.com/600x400?text=Photo+7',
        'https://via.placeholder.com/600x400?text=Photo+8',
        'https://via.placeholder.com/600x400?text=Photo+9',
        'https://via.placeholder.com/600x400?text=Photo+10'
    ];

    function displayPhotos(page) {
        const itemsPerPage = 3;
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const currentPhotos = photos.slice(startIndex, endIndex);

        const gallery = document.getElementById('gallery');
        gallery.innerHTML = '';
        currentPhotos.forEach(photo => {
            const col = document.createElement('div');
            col.className = 'col-md-4 mb-3';
            col.innerHTML = `<img src="${photo}" class="gallery-img img-fluid">`;
            gallery.appendChild(col);
        });
    }

    document.querySelectorAll('.page-link').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const page = parseInt(this.getAttribute('data-page'));
            displayPhotos(page);
        });
    });

    // Initial display
    displayPhotos(1);
});
