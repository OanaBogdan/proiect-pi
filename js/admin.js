$(document).on('click', '#edit_btn', function() {

    var id = this.dataset.id;
    var name = this.dataset.name;
    var description = this.dataset.description;
    var price = this.dataset.price;
    var category = this.dataset.category;

    $('#edit_id').val(id);
    $('#edit_name').val(name);
    $('#edit_description').val(description);
    $('#edit_price').val(price);
    $('#edit_category').val(category);
});

$(document).on('click', '#delete_btn', function() {
    var id = this.dataset.id;
    $('#delete_id').val(id);
});


