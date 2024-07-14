/**
 * Backend Js
 */

//Check for form changes
$("#post-form :input").change(function() {
    $("#post-form").data("changed", true)
})

// Delete product function
function delProduct(productName, productId) {
    if (confirm("Are you sure you wan to delete product " + productName + "?")) {
         // Pass validated data to ajax in order to write in product table
        $.ajax({
            url: "../backend/core/delete.php",
            method: "post",
            data: {
                id: productId
            },
            dataType: "text",
            success: function(response) {
                $("#products").html(response)
            }
        })
   }
}

// Create product
if (document.querySelector("#submit")) {
    const button = document.querySelector("#submit")
    button.addEventListener("click", addProduct)
}

function addProduct(e) {
    e.preventDefault()
    // Set all the input fields to variables
    let productName = $("#product-name").val()
    let price = $("#price").val()
    let stock = $("#stock").val()

    // validate the above data
    if (!validateForm(productName, price, stock)) {
        return false
    }
    
    // Pass validated data to ajax in order to write in product table
    $.ajax({
        url: "../backend/core/create.php",
        method: "post",
        data: {
            product_name: productName,
            price: price,
            stock: stock
        },
        dataType: "text",
        success: function(response) {
            // if (response.status == true) {
                
            // }
            $("#products").html(response)
        }
    })
}

// Update Product
if (document.querySelector("#update")) {
    const update = document.querySelector("#update") 
    update.addEventListener("click", updateProduct)
}

function updateProduct(e) {
    e.preventDefault()
    // Set all the input fields to variables
    let product_id = $("#product_id").val()
    let productName = $("#product-name").val()
    let price = $("#price").val()
    let stock = $("#stock").val()

    // validate the above data
    if (!validateForm(productName, price, stock)) {
        return false
    }

    // Pass validated data to ajax in order to write in product table
    if ($("#post-form").data("changed", true)) {
        $.ajax({
            url: "../backend/core/update.php",
            method: "post",
            data: {
                id: product_id,
                product_name: productName,
                price: price,
                stock: stock
            },
            dataType: "text",
            success: function(response) {
                $("#products").html(response)
            }
        })
    } else {
        alert("No changes to save")
        return false
    }
    
}

function validateForm(productName, price, stock) {
    //Set the flag
    let valid = true

    // Set default values for all the variables
    let productErr = $("#productErr").html("")
    let priceErr = $("#priceErr").html("")
    let stockErr = $("#stockErr").html("")

    //Product field
    if (productName == "") {
        productErr.html("* product name is required")
        valid = false
    }

    // price field
    if (price == "" || price <= 0) {
        priceErr.html("* price should be positive")
        valid = false
    }

    // stock field 
    if (stock == "" || stock < 0) {
        stockErr.html("* product amount in stock should be zero or positive")
        valid = false
    }
    return valid
}

