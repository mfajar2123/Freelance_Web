// Get the filter elements
var category = document.getElementById("category");
var skill = document.getElementById("skill");
var keyword = document.getElementById("keyword");
var filter = document.getElementById("filter");

// Get the service cards
var services = document.getElementById("services");
var cards = services.getElementsByClassName("service-card");

// Add a click event listener to the filter button
filter.addEventListener("click", function() {
    // Get the filter values
    var categoryValue = category.value;
    var skillValue = skill.value;
    var keywordValue = keyword.value.toLowerCase();

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
});