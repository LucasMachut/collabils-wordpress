document.getElementById("search-form").addEventListener("submit", function(event) {
  event.preventDefault();

  const searchTerm = document.getElementById("search-input").value.toLowerCase();
  const signItems = document.querySelectorAll(".sign-item");

  document.getElementById("search-results").innerHTML = "";

  signItems.forEach(item => {
    const signTitle = item.querySelector("h3").textContent.toLowerCase();

    if (signTitle.includes(searchTerm)) {
      const searchResult = item.cloneNode(true);
      document.getElementById("search-results").appendChild(searchResult);
    }
  });
});
