const navBtns = document.querySelectorAll('.nav-btn');
const sections = document.querySelectorAll('.section');

navBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const targetSection = btn.dataset.section;

        navBtns.forEach(btn => btn.classList.remove('active'));
        btn.classList.add('active');

        sections.forEach(section => section.classList.remove('active'));
        document.getElementById(targetSection).classList.add('active');
    });
});


// List of users
// Function to fetch and display user list
function fetchcategoryList() {
    const categoryListDiv = document.getElementById('categoryList');
    categoryListDiv.innerHTML = '<p>Loading...</p>'; // Show loading message while fetching data

    // Make AJAX call to get_categories.php
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Update categorylist with fetched category list
                categoryListDiv.innerHTML = xhr.responseText;
            } else {
                categoryListDiv.innerHTML = '<p>Error fetching category list</p>'; // Display error message if AJAX call fails
            }
        }
    };
    xhr.open('GET', 'get_categories.php', true);
    xhr.send();
}

// Add event listener to fetch user list when Users button is clicked
document.querySelector('.nav-btn[data-section="categories"]').addEventListener('click', fetchcategoryList);

// Function to fetch and display items list
// Add items form
// Get the modal
var modal = document.getElementById("addCategoryModal");

// Get the button that opens the modal
var btn = document.getElementById("addCategoryButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}






