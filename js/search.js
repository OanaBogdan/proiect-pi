const searchInput = document.querySelector('.header_search_input');
  let searchValue = '';
  searchInput.oninput = function() {
  searchValue = this.value;
  //send data to search.php via post
  //if searchValue is empty or just whitespaces, don't send request 
 if(searchValue.trim() === ''){
  const resultsDiv = document.querySelector('.search_results');
  resultsDiv.innerHTML = '';
  
  
 }else{
  
  const xhr = new XMLHttpRequest();
  xhr.open('POST', './config/handler.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function(){
    if(xhr.readyState === 4 && xhr.status === 200){
      const response = xhr.responseText;
      //display first 5 results without description
      const results = JSON.parse(response);
      const resultsDiv = document.querySelector('.search_results');
      resultsDiv.innerHTML = '';
      //if no results, display message
      //if search is focused, display results
      if(results.length === 0 ){
        const resultDiv = document.createElement('div');
        resultDiv.classList.add('search_result');
        resultDiv.classList.add('text-center');
        resultDiv.classList.add('text-muted');
        resultDiv.style.fontSize = '1.2rem';
        resultDiv.innerHTML = `No results found`;
        resultsDiv.appendChild(resultDiv);
        return;
      }else{
      for(let i = 0; i < 5; i++){
        const result = results[i];
        const resultDiv = document.createElement('div');
        resultDiv.classList.add('search_result');
        resultDiv.style.display = 'flex';
        resultDiv.style.backgroundColor = 'white';
        resultDiv.style.border = '2px solid #e6e6e6';
        resultDiv.style.padding = '10px';
        resultDiv.style.cursor = 'pointer';
        resultDiv.innerHTML = `
        <a href="product.php?id=${result.id}" style="text-decoration: none;color: black; width:100%">
        <div class="search_result_image" style="width: 100px;height: 100px; overflow: hidden;display: inline-block"><img style="width: 100%; height: 100%; object-fit: cover;" src="images/item/${result.image}" alt=""></div>
        <div class="search_result_content" style="margin-left: 10px;">
          <div class="search_result_title" style="font-size: 16px;font-weight: 600;">${result.name}</div>
          
          <div class="search_result_category" style="font-size: 14px; color: gray;">${result.category_name}</div>

          <div class="search_result_price" style="font-size: 14px; color: gray;">RON${result.price}</div>
        </div>
        </a>
        `;
        resultsDiv.appendChild(resultDiv);
      }
    }
    }
  }
  xhr.send('search=' + searchValue);
  }
  }