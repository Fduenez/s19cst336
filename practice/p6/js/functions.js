// JavaScript File

$("document").ready(function() {
    allProducts = [];
    var currentProduct = null;
    $("#promocode").on("change", checkPromoCode);
    $("#displayProductInfo").on("click", displayInfo);
    $("#product-total").on("change", displayTotal);
    
    
    $.ajax({
        type: "GET",
        url: "api/getAllProducts.php",
        dataType : "json",

        success: function(data, status) {
            console.log("success");  
            data.forEach(function(key) {
                $("[name=products]").append("<option value=" + key["productId"] + ">" + key["productName"] + "</option>");
                allProducts[key["productId"]] = {
                                            name: key["productName"],
                                            description: key["productDescription"], 
                                            image: key["productImage"],
                                            price: key["productPrice"]
                }
              
            })
            currentProduct = getRandomProduct(allProducts);
            $("#product-name").html("<button type='button' id='displayProductInfo'>" + currentProduct["name"] + "</button>");
            $("#product-price").html("$" + currentProduct["price"]);
        },
        complete: function(data, status) {
            //console.log(data);
        }
    })
    function displayInfo() {
        console.log("displaying")
        $("#productInfo").append("<img href = " + currentProduct["image"] + ">")
    }
    function getRandomProduct(productList) {
        length = productList.length;
        // sometimes this doesn't work for the 0 index, productList starts at 1
        randomNum = Math.floor(Math.random() * length) -1;
        return productList[randomNum];
    }
    
    function checkPromoCode() {
        promocode = $("#promocode").val();
        
        $.ajax({
            type: "GET",
            url: "api/applyPromoCode.php",
            dataType : "json",
            data: {
                "promocode": promocode
            },
            success: function(data, status) {
                console.log("success");
                console.log(data);
                
                price = $("#total").html();
                price = parseInt(price);
                
                discount = data["promocode"]
                discount = parseFloat(discount);
                
                $("#discount").html(price * discount);
                
            },
            complete: function(data, status) {
                console.log(data);
            }
        })
    }
});