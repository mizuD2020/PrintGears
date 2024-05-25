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


function fetchcategoryList() {
    const categoryListDiv = document.getElementById('categoryList');
    categoryListDiv.innerHTML = '<p>Loading...</p>'; // Show loading message while fetching data

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                categoryListDiv.innerHTML = xhr.responseText;
            } else {
                categoryListDiv.innerHTML = '<p>Error fetching category list</p>'; // Display error message if AJAX call fails
            }
        }
    };
    xhr.open('GET', 'get_categories.php', true);
    xhr.send();
}

document.querySelector('.nav-btn[data-section="categories"]').addEventListener('click', fetchcategoryList);

var modal = document.getElementById("addCategoryModal");

var btn = document.getElementById("addCategoryButton");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}






