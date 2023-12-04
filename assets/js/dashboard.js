document.addEventListener("DOMContentLoaded", function () {
    // Mendapatkan elemen dengan ID 'services'
    var services = document.getElementById("services");

    // Menggunakan Axios untuk melakukan permintaan GET ke fetch_pekerjaan.php
    axios.get('fetch_pekerjaan.php')
        .then(function (response) {
            var data = response.data;

<<<<<<< HEAD
            data.forEach(function (pekerjaan) {
                var card = document.createElement("div");
                card.classList.add("col-md-3");
                card.innerHTML = `
                    <div class="card service-card" data-category="${pekerjaan.kategori}" data-skill="${pekerjaan.skill}">
                        <img src="./assets/img/${pekerjaan.foto}" class="card-img-top" alt="User Photo">
                        <div class="card-profile d-flex align-items-center m-lg-2">
                            <img src="assets/img/${pekerjaan.foto_profil}" class="card-profile-img rounded-circle" alt="Profile Image" style="width: 35px; height: 35px;">
                            <span class="card-profile-name ms-2" style="font-weight: bold;">${pekerjaan.name}</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">${pekerjaan.jenis_pekerjaan}</h5>
                            <p class="card-text">${pekerjaan.deskripsi_order}</p>
                        </div>
                        <div class="card-footer">
                            <span>Price: $${pekerjaan.harga}</span>
                            <a href="order_detail2.php?pekerjaan_id=${pekerjaan.id_pekerjaan}" class="btn btn-primary" style="background-color: rgba(1, 4, 136, 0.9);">Order</a>
                        </div>
                    </div>
                `;
                services.appendChild(card);
            });
        })
        .catch(function (error) {
            console.log(error);
        });
=======
// ...

// Add a click event listener to the filter button
filter.addEventListener("click", function() {
    // Get the filter values
    var categoryValue = category.value;
    var skillValue = skill.value;
    var keywordValue = keyword.value.toLowerCase();

    // Store the original order of cards
    var originalOrder = Array.from(cards);

    // Loop through the cards and show or hide them based on the filter values
    for (var i = 0; i < cards.length; i++) {
        var card = cards[i];
        var cardCategory = card.getAttribute("data-category");
        var cardSkill = card.getAttribute("data-skill");
        var cardTitle = card.getElementsByClassName("card-title")[0].textContent.toLowerCase();
        var cardText = card.getElementsByClassName("card-text")[0].textContent.toLowerCase();

        // Check if the card matches the filter values
        var matchCategory = (categoryValue == "" || categoryValue == cardCategory);
        var matchSkill = (skillValue == "" || skillValue == cardSkill);
        var matchKeyword = (keywordValue == "" || cardTitle.includes(keywordValue) || cardText.includes(keywordValue));

        // Show or hide the card based on the match results
        if (matchCategory && matchSkill && matchKeyword) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    }

    // Clear the services container before appending rearranged cards
    services.innerHTML = '';

    // Rearrange the cards based on the original order
    for (var i = 0; i < originalOrder.length; i++) {
        services.appendChild(originalOrder[i]);
    }
>>>>>>> 90ca44eedd0b23bdca3b23866e594cee07405be7
});