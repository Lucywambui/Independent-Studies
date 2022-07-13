if(document.readyState == 'loading'){
    document.addEventListener('DOMContentLoaded',ready)
}else{
    ready()
}

function ready(){
    var removeItems=document.getElementsByClassName('remove-button')
    for(var i=0; i< removeItems.length; i++){
	var removed=removeItems[i]
	removed.addEventListener('click', removeCartItem)
    }
    
    var quantityItems=document.getElementsByClassName('item-quantity')
    for(var i=0;i<quantityItems.length; i++){
	var currentQuantity=quantityItems[i]
	currentQuantity.addEventListener('change', quantityChanged)
    }
/*
    var addToCart=document.getElementsByClassName('btn')
    for(var i=0; i<= addToCart.length; i++){
	var addedItem=addToCart[i]
	addedItem.addEventListener('click', addItemToCart)
    }*/
}

function removeCartItem(event){
    var itemRemoved=event.target
    itemRemoved.parentElement.parentElement.remove()
    updateTotal()
}

function quantityChanged(event){
    var entry=event.target
    updateTotal()
}
    
/*
function addItemToCart(event){
    var button=event.target
    var addItem=button.parentElement.parentElement
    var name=addItem.getElementsByClassName('name')[0].innerText
    var image=addItem.getElementsByClassName('img')[0].src
    var addedPrice=addItem.getElementsByClassName('price')[0].innerText
    completeAddItem(name, image, addedPrice);
    updateTotal()
    
}

function completeAddItem(name, image, addedPrice){
    var itemsInCart=document.getElementsByClassName('col-sm-6 cart-items')[0]
    var itemNames= document.getElementsByClassName('title')
    for(var i=0; i< itemNames.length; i++){
	if(itemNames[i].innerText == name){
	    alert('This has already been added to your cart')
	    return
	}
    }
    var contentsInRow=`
<div class="row cart" style="padding: 5%; border-right: 1px solid black;" id="cart-row">
	<div class="col-5">
	  <img src=${image} alt="Image Name" style="width: 100px;height: 100px;">
	</div>
	<div class="col-7">
	  <strong class="title"> ${name} </strong>
	  <input type=number min="1" id="quantity" placeholder="1" style="width:10%; margin-left:10%" class="item-quantity">
	  <p class="item-price" style="margin-top: 30px;">££ ${addedPrice} </p><input type="image" class="remove-button" src="../media/delete.png" style="width: 30px; height: 30px; margin-left:40%;">
	</div>
</div>`
    var cartRow
    cartRow.innerHTML=contentsInRow
    itemsInCart.append(cartRow)
    cartRow.getElementsByClassName('remove-button')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('item-quantity')[0].addEventListener('change', quantityChanged)
    
}
    */

function updateTotal(){
    var itemContainer= document.getElementsByClassName('col-sm-6 cart-items')[0]
    var cartRows=itemContainer.getElementsByClassName('row cart')
    var totalPrice=0
    for(var i=0; i<cartRows.length; i++){
	var cartRow=cartRows[i]
	var priceElement=cartRow.getElementsByClassName('item-price')[0]
	var quantityElement=cartRow.getElementsByClassName('item-quantity')[0]
	var price=parseFloat(priceElement.innerText.replace('£', ''))
	var quantity=quantityElement.value
	totalPrice= totalPrice + (price * quantity)
	
    }
    document.getElementsByClassName('total-price')[0].innerText= '£ ' + totalPrice
}
