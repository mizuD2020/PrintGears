document.addEventListener("DOMContentLoaded", function() {
    const itemsContainer = document.querySelector('.items-container');

    // Make an AJAX request to fetch items from the database
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const items = JSON.parse(xhr.responseText);
                items.forEach(item => {
                    addItemWithImage(item.Images, item.Name, item.Description, item.Price);
                });
            } else {
                console.error('Failed to fetch items');
            }
        }
    };
    xhr.open('GET', 'fetch_items.php', true);
    xhr.send();

    // Function to add item with image
    function addItemWithImage(imageSrc, altText, sampleText, price) {
        const itemDiv = document.createElement('div');
        itemDiv.classList.add('item');

        const img = document.createElement('img');
        img.src = imageSrc;
        img.alt = altText;

        const textDiv = document.createElement('div');
        textDiv.textContent = sampleText;

        const priceDiv = document.createElement('div');
        priceDiv.textContent = `Price: $${price}`;

        const itemButtonsDiv = document.createElement('div');
        itemButtonsDiv.classList.add('item-buttons');

        const buyButton = document.createElement('button');
        buyButton.classList.add('buy-button');
        buyButton.textContent = 'Buy Now';

        const addToCartButton = document.createElement('button');
        addToCartButton.classList.add('add-to-cart-button');
        addToCartButton.textContent = 'Add to Cart';

        itemDiv.appendChild(img);
        itemDiv.appendChild(textDiv);
        itemDiv.appendChild(priceDiv);
        itemDiv.appendChild(itemButtonsDiv);

        itemButtonsDiv.appendChild(buyButton);
        itemButtonsDiv.appendChild(addToCartButton);

        itemsContainer.appendChild(itemDiv);
    }
});


//loginDropdown
function toggleDropdown() {
    var dropdown = document.getElementById('profileDropdown');
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
}

document.addEventListener('click', function (event) {
    var profileMenu = document.querySelector('.profile-menu');
    if (profileMenu && !profileMenu.contains(event.target)) {
        document.getElementById('profileDropdown').style.display = 'none';
    }
});



