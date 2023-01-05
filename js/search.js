const form = document.querySelector('.header_search_form');
const input = document.querySelector('.header_search_input');
const dropdown = document.querySelector('.custom_dropdown_list');

// add a submit event listener to the form
form.addEventListener('submit', event => {
  // prevent the form from submitting
  event.preventDefault();

  // get the search term and selected category from the form
  const searchTerm = input.value;
  const category = dropdown.dataset.value;

  // send an AJAX request to the server with the search term and category
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'search.php/search?q=' + searchTerm + '&category=' + category);
  xhr.onload = () => {
    if (xhr.status === 200) {
      // update the page with the search results
      console.log(xhr.responseText)
      const results = JSON.parse(xhr.responseText);
      updateResults(results);
    }
  };
  xhr.send();
});
//----------------------------------------PANA AICI E OK------------------------------------------------\\
// add a change event listener to the dropdown menu
dropdown.addEventListener('click', event => {
  // update the selected category when a dropdown menu item is clicked
  const selected = event.target;
  if (selected.tagName === 'A') {
    dropdown.dataset.value = selected.dataset.value;
    console.log(dropdown.dataset.value);
  }
});

// define a function for updating the page with the search results
function updateResults(results) {
  // clear the current search results
  const container = document.querySelector('.search_results');
  container.innerHTML = '';

  // add the new search results to the page
  results.forEach(result => {
    const item = document.createElement('div');
    item.innerHTML = `<h3>${result.name}</h3><p>${result.description}</p>`;
    container.appendChild(item);
  });
}
