document.addEventListener("DOMContentLoaded", function() {
  var stars = document.querySelectorAll('.fa-star');
  var ratingInput = document.querySelector('#rating');

  stars.forEach(function(star) {
    star.addEventListener('click', function() {
      var rating = this.getAttribute('data-rating');
      ratingInput.value = rating;
      // remove the class "clicked" from all the stars
      stars.forEach(function(star) {
        star.classList.remove("checked");
      });
      // loop through all the stars up to the clicked star and add the "clicked" class to them
      for(var i = 0; i < rating; i++) {
        stars[i].classList.add("checked");
      }
    });
  });
});