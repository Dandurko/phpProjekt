let insertBtn = document.getElementById('insertBtn');
let categoryId;
let content;
let title;
let image_url;
let text;
let globalContentId;
let globalArticleId;
insertBtn.addEventListener('click', function () {
    let insertForm = document.getElementById('insertForm');
    insertForm.classList.toggle("hidden");
});


document.addEventListener('DOMContentLoaded', function () {
    let elements = document.querySelectorAll('.updateBtn');

    elements.forEach(function (element) {
        element.addEventListener('click', function () {
            let articleId = element.getAttribute('id');
            loadArticleData(articleId);
        });
    });
});
function loadArticleData(articleId) {
    // Implementujte AJAX volanie na server, aby ste získali informácie o článku
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_article_data.php?id=' + articleId, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Spracovanie vrátených údajov a aktualizácia formulára
            let articleData = JSON.parse(xhr.responseText);
            updateForm(articleData[0]);
        }
    };

    xhr.send();
}


function updateContent(content, contentId) {
    // Implement AJAX call to the server to update the category
    let xhr = new XMLHttpRequest();
    let url = 'update_logic.php?content=true';  // Note: You might need to adjust this URL based on your application structure
    let data = '&content=' + encodeURIComponent(content) +
        '&contentId=' + encodeURIComponent(contentId);

    xhr.open('GET', url + data, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response from the server
            console.log(xhr.responseText);
            location.reload();

        }
    };

    xhr.send();
}

function updateCategory(articleId, category) {
    // Implement AJAX call to the server to update the category
    let xhr = new XMLHttpRequest();
    let url = 'update_logic.php?category=true';  // Note: You might need to adjust this URL based on your application structure
    let data = '&category=' + encodeURIComponent(category) +
        '&articleId=' + encodeURIComponent(articleId);

    xhr.open('GET', url + data, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            //dorobit assynchrony update
            console.log(xhr.responseText);
            location.reload();

        }
    };

    xhr.send();
}


function updateArticle(articleId, title, image_url) {
    // Implementujte AJAX volanie na server, aby ste získali informácie o článku
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'update_logic.php?article=true', true);
    let data = '&title=' + encodeURIComponent(title) +
        '&image_url=' + encodeURIComponent(image_url) +
        '&articleId=' + encodeURIComponent(articleId);
    xhr.send(data);
}
function updateForm(articleData) {
    let updateForm = document.getElementById('updateForm');
    updateForm.classList.toggle("hidden")
    document.getElementById('updateForm').elements['title'].value = articleData.title;
    document.getElementById('updateForm').elements['text'].value = articleData.content;
    document.getElementById('updateForm').elements['image_url'].value = articleData.image_url;
    document.getElementById('updateForm').elements['id'].value = articleData.id;
    var categoryDropdown = document.getElementById('updateForm').elements['category'];
    for (var i = 0; i < categoryDropdown.options.length; i++) {
        if (categoryDropdown.options[i].value == articleData.categories_id) {
            categoryDropdown.options[i].selected = true;
            break;
        }
    }
    text = articleData.content;
    title = articleData.title;
    categoryId = articleData.categories_id;
    image_url = articleData.image_url;
    globalContentId = articleData.articles_content_id;
    globalArticleId = articleData.id;
}

function checkChanges(event) {
    event.preventDefault();
    let newTitle = document.getElementById('title').value;
    let newText = document.getElementById('text').value;
    let newImage_url = document.getElementById('image_url').value;
    let newCategory = document.getElementById('category').value;
    if (newText != text) {
        updateContent(newText, globalContentId);
    }
    if (newCategory != categoryId) {
        updateCategory(globalArticleId, newCategory);
    }

    if (newTitle != title || newImage_url != image_url) {
        updateArticle(globalArticleId, newTitle, newImage_url);
    }
}

function sendEmail() {

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "script.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Poslanie údajov na backend
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Spracovanie odpovede z backendu (ak je potrebné)
        }
    };

    var data = "email=" + encodeURIComponent("denoscicoo@gmail.com") + "&message=" + encodeURIComponent("message");
    xhr.send(data);
}