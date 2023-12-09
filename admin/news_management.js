let insertBtn = document.getElementById('insertBtn');
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


function updateForm(articleData) {
    let updateForm = document.getElementById('updateForm');
    updateForm.classList.toggle("hidden")
    document.getElementById('updateForm').elements['title'].value = articleData.title;
    document.getElementById('updateForm').elements['text'].value = articleData.text;
    document.getElementById('updateForm').elements['image_url'].value = articleData.image_url;
    document.getElementById('updateForm').elements['id'].value = articleData.id;
    // Môžete pridať ďalšie aktualizácie podľa potreby
}


