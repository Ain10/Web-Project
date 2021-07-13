d = document;
xhr = new XMLHttpRequest();
error=0

var interv;
function createCaptcha(){
	document.getElementById('captcha').innerHTML = "";
  	 chars =   "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
  	 captchaLength = 7;
  	captcha = [];

	for ( i = 0; i < captchaLength; i++) {
		index = Math.floor(Math.random()*chars.length + 1);
		if (captcha.indexOf(chars[index])==-1) captcha.push(chars[index]);
		else i--;
	}

	captchaCont = document.createElement("canvas");
	captchaCont.id = "captcha";
	captchaCont.width = 120;
	captchaCont.height = 50;
	ctx = captchaCont.getContext("2d");
	ctx.font = "25px Georgia";
	ctx.strokeText(captcha.join(""), 0, 30);

	code = captcha.join("");
	document.getElementById("captcha").appendChild(captchaCont);
}

function validateCaptcha(){
    if (d.getElementById("captchaInput") == code) {
        //success captcha
    } else {		
        Swal.fire({
            icon:'error',
            title:'Captcha Invalid',
            text: 'Please try again.'
        });
        createCaptcha();
        document.getElementById("captchaInput").value="";
    }
}

function login(){
    
    username = d.getElementById('username').value;
    password = d.getElementById('password').value;
    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status ==200){
            d.getElementById("display").innerHTML = xhr.responseText;
            if(d.getElementById("display").innerHTML==1){

                window.location.href = "viewMovies.php";
            }
        }
    };

    xhr.open("GET","searchUser.php?user="+username+"&password="+password,true);
    xhr.send();
}

//REGISTER
function checkUsername(username){
    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status ==200){
            d.getElementById("userNameError").innerHTML = xhr.responseText;
        }
    };
    xhr.open("GET","register.php?user="+username,true);
    xhr.send();
}

function checkName(){
    firstN = d.getElementById("registerFirstName").value;
    lastN = d.getElementById("registerLastName").value;

    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status ==200){
            d.getElementById("accountName").innerHTML = xhr.responseText;
        }
    };
    xhr.open("GET","register.php?firstName="+firstN+"&lastName="+lastN,true);
    xhr.send();
}

function checkCPassword(){
    password = d.getElementById("registerPassword").value;
    passwordC = d.getElementById("registerConfirmPassword").value;
    if(password != passwordC && password!=""){
        d.getElementById("confirmError").innerHTML="Password does not Match";
    }else{
        d.getElementById("confirmError").innerHTML="";
    }
}

function checkPassword(){
    password = d.getElementById("registerPassword").value;
    passwordC = d.getElementById("registerConfirmPassword").value;
    if(password != passwordC && passwordC != ""){
        d.getElementById("confirmError").innerHTML="Password does not Match";
    }else{
        d.getElementById("confirmError").innerHTML="";
    }
}

function register(){
    rUser = d.getElementById("registerUsername").value;
    rFirst = d.getElementById("registerFirstName").value;
    rLast = d.getElementById("registerLastName").value;
    password = d.getElementById("registerPassword").value;
//captcha
    captchaInput =d.getElementById("captchaInput").value;
    if(rUser==""||rFirst=="" || rLast==""||password==""){
        d.getElementById("userNameError").innerHTML=="Please fill up all fields";
        d.getElementById("hideRegister").style.display = "block";
    }
    if(d.getElementById("userNameError").textContent=="" && d.getElementById("accountName").textContent=="" && d.getElementById("confirmError").textContent==""&& d.getElementById("registerUsername").value!="" &&d.getElementById("registerFirstName").value!="" && d.getElementById("registerLastName").value!=""&& d.getElementById("registerPassword").value!=""&& d.getElementById("registerConfirmPassword").value!=""){
        xhr.onreadystatechange = () =>{
            if(xhr.readyState == 4 && xhr.status ==200){
                d.getElementById("register").style.display = xhr.responseText;
                d.getElementById("hideRegister").style.display = "none";
            }
        };
        console.log("First Name: "+rFirst+"Last Name: "+rLast);
    
        xhr.open("GET","register.php?registerUser="+rUser+"&firstN="+rFirst+
        "&lastN="+rLast+"&pass="+password,true);
        xhr.send();

    }else{
        d.getElementById("display").innerHTML=="Register failed";
    }
    
}

function showRegister(){
    d.getElementById("register").style.display = "block";
    d.getElementById("hideRegister").style.display = "block";
    d.getElementById("registerUsername").value = "";
    d.getElementById("registerFirstName").value = "";
    d.getElementById("registerLastName").value = "";
    d.getElementById("registerPassword").value = "";
    d.getElementById("registerConfirmPassword").value = "";
        //added captcha dito
        d.getElementById("captchaInput").value = "";
}
function hide(){
    d.getElementById("register").style.display = "none";
    d.getElementById("hideRegister").style.display = "none";
    d.getElementById("registerUsername").value = "";
    d.getElementById("registerFirstName").value = "";
    d.getElementById("registerLastName").value = "";
    d.getElementById("registerPassword").value = "";
    d.getElementById("registerConfirmPassword").value = "";
    d.getElementById("captchaInput").value = "";
}


function displayModal(gameCode){
    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status ==200){
            data = xhr.responseText.split("|");
            if(data != null){
                d.getElementById("gameCode").innerHTML = data[0];
                d.getElementById("gameCodeHolder").value = data[0];
                d.getElementById("gameTitle").innerHTML = data[1];
                d.getElementById("gameDeveloper").innerHTML = data[2];
                d.getElementById("gamePublisher").innerHTML = data[3];
                d.getElementById("gameGenre").innerHTML = data[4];
                d.getElementById("gamePrice").innerHTML = data[5];
                d.getElementById("DateOfRelease").innerHTML = data[6];
                d.getElementById("gameDescription").innerHTML = data[7];
                d.getElementById("modalImage").src = data[8];
                d.getElementById("modal").style.display = "block";
            }
        }
    };

    xhr.open("GET","modalView.php?gameCode="+ gameCode,true);

    xhr.send();
}

function hideModal(){
    d.getElementById('modal').style.display = "none";
}

function logout(){
    Swal.fire({
        title: 'Are you sure you want to logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Logout',
            'Click ok to proceed',
            'success',
            
          ).then(function() {
            window.location = "register.php?logout=true";

          });
        }
      })

}
/////////GET ACTIVE USERS
function fetchActiveUsers(){
    user_list = document.getElementById("userList");
    count = document.getElementById("activeUsers");
    
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){
            data = xhr.responseText.split("|");
           user_list.innerHTML = data[1];
           count.innerHTML = data[0];
           
        }
    }

    xhr.open("GET", "getActiveUser.php?getUsers=getUsers", true);
    xhr.send();
}
////CHATBOX
function showChatBox(yeet){
    chatbox = document.getElementById("chatbox");
    chatname = document.getElementsByClassName("chat-name")[0];
    chatuname = document.getElementsByClassName("chat-uname")[0];
    chatmid = document.getElementsByClassName("chat-mid")[0];

    chatname.innerText = yeet.innerText;
    chatuname.innerText = "(" + yeet.getAttribute("data-uname") + ")";
    chatmid.innerHTML = "";
    chatbox.style.display = "flex";
    getMessages(yeet, "show");
    setInterval(function(){
        getMessages(yeet, "interval");
    }, 500);
}

function hideChatBox(){
    chatbox = document.getElementById("chatbox");
    chatbox.style.display = "none";
    clearInterval(interv);
}

function getMessages(t, showChatBox){

    uname = t.getAttribute("data-uname");
    chatmid = document.getElementsByClassName("chat-mid")[0];
    
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){
            data = xhr.responseText;
            if(data != ""){
                chatmid.innerHTML += data;
                chatmid.lastChild.scrollIntoView();
            }
            
        }
    }

    xhr.open("GET", "getMessages.php?uname=" + uname + "&showChatBox=" + showChatBox, true);
    xhr.send();
}

function sendChat(){
    text = document.getElementById("textarea");
    chatmid = document.getElementsByClassName("chat-mid")[0];
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){
            data = xhr.responseText;
            if(data == "empty"){
            }else{
                chatmid.lastChild.scrollIntoView();
                text.value = "";
            }
        }
    }

    xhr.open("POST", "send.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("message=" + text.value);
}


window.onload = function(){
    fetchActiveUsers();
    
    setInterval(function(){
        fetchActiveUsers();
        
    }, 6000);

    setTimeout(function(){
        displayProducts();
      }, 100);
    
}



//change profile pic
function editProfilePic(){
     profileModal = document.getElementById('edit-img-container');
     profileModal.style.display = "flex";
    fetchProfilePic();
}

function fetchProfilePic(){
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){
            img = xhr.responseText;
            profile_pic = document.getElementById("current-profile-pic");
            profile_pic.src = "profile_pics/"+img;
            
        }
    }
    xhr.open("GET", "profileGet.php?getPicture=", true);
    xhr.send();
}

function saveImage(){
    sendForm = new FormData();
    getElementPicture = document.getElementById("pic").files[0];
    sendForm.append("pic", getElementPicture);
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){
      
                picttttttuuurree = xhr.responseText;
                if(picttttttuuurree=="default.png"){
                    alert("Please upload the proper file");
                    exit(0);
                }
                document.getElementById("current-profile-pic").src = "profile_pics/" + picttttttuuurree;
                document.getElementById("profile-pic").src = "profile_pics/" + picttttttuuurree;
                
        }
    }

    xhr.open("POST", "ImageSave.php", true);
    xhr.send(sendForm);
}

function exitModal(){
    modal = document.getElementById("edit-img-container");
    modal.style.display = 'none';
}

function displayChosenImage(){
    pic = document.getElementById("pic").files[0];
}


/////////////////////////ADDING FROM WISHLIST AND CART

function addToCart(){
    let cart = document.getElementById("gameCodeHolder").value;

    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200)
        cartIdent = xhr.responseText;
        if(cartIdent=="already added"){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Item Already Added'
              })
        }else{
            Swal.fire({
                icon: 'success',
                title: 'Item Added!',
                text: 'Item has been successfully added to cart.'
            })
        }

        }
       
    xhr.open("GET", "addGameToCart.php?addG="+cart, true);
    xhr.send();
}

//ADD TO CART FROM WISHLIST
function addToCartFromWishList(item){
    let cart = document.getElementById("gameCodeHolder").value;

    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200)
        cartIdent = xhr.responseText;
        if(cartIdent=="already added"){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Item Already Added'
              })
        }else{
            Swal.fire({
                icon: 'success',
                title: 'Item Added!',
                text: 'Item has been successfully added to cart.'
            })
        }

        }
       
    xhr.open("GET", "addGameToCart.php?addFromWishlist="+item, true);
    xhr.send();
}

function addtoWishList(){
    let cart = document.getElementById("gameCodeHolder").value;

    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200)
        wishIdent = xhr.responseText;
        if(wishIdent=="already added"){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Item Already Added'
              })
        }else{
            Swal.fire({
                icon: 'success',
                title: 'Item Added!',
                text: 'Item has been successfully added to wishlist.'
            })
        }

        }
       
    xhr.open("GET", "addGameToCart.php?addW="+cart, true);
    xhr.send();
}
//interval collection
setInterval(function(){
    
    fetchWishlistItems();
}, 4050);

setInterval(function(){
    fetchCartItems();
}, 4000);

setInterval(function(){
    fetchCartItemsPrice();
}, 4025);
function fetchCartItems(){
    cartList = document.getElementById("Cartlist");

    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){

            cartList.innerHTML = xhr.responseText;
        }
    }

    xhr.open("GET", "fetchCartAndWish.php?getGames=get", true);
    xhr.send();
}
//fetchCartItemPrice
function fetchCartItemsPrice(){
    allprice = document.getElementById('allCartPrice');
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){
            allprice.value = xhr.responseText;
            
        }
    }

    xhr.open("GET", "fetchCartAndWish.php?getGamesPrice=get", true);
    xhr.send();
}
function fetchWishlistItems(){
    wishList = document.getElementById("wishList");
    
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){
            wishList.innerHTML = xhr.responseText;
        }
    }

    xhr.open("GET", "fetchWishlistItems.php?getGames=get", true);
    xhr.send();
}


//REMOVE FROM WISHLIST AND CART
function cartItemRemove(item, identify){
    let cart = document.getElementById("gameCodeHolder").value;
    let variable ="";
    identify==1? variable="removeFromCart=":variable="removeFromWishlist=";
    Swal.fire({
        title: 'Are you sure?',
        text: "Remove Item",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Product will be removed shortly.',
            'success',
            
          ).then(function() {
            xhr.open("GET", "RemoveFromCartAndWishlist.php?"+variable+item, true);
            xhr.send();
          });
        }
      })

    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200)
        //ADD SWEET ALERT FOR NOTIFICATION
        hello ="";

    }

    
}

//CHECKOUT
function checkout(){
    allprice = document.getElementById('allCartPrice').value;
    Swal.fire({
        title: 'Purchase Product',
        text: "Do you want to proceed with your purchase/s?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Items !',
            'You can view your purchases in you purchase history',
            'success',
            
          ).then(function() {
            xhr.open("GET","checkout.php?checkout="+allprice,true);
        xhr.send();
          });
        }
      })
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){
           
        }
    }

}
//history
function displayHistory(){
    document.getElementById('purchaseHistoryModal').style.display  = "block";
    historyPop = document.getElementById('populateHistory');
    order = document.getElementById('option').value;
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200)
        historyPop.innerHTML = xhr.responseText;
        }
    xhr.open("GET", "displayHistory.php?display="+order, true);
    xhr.send();
}

function hideHistory(){
    history = document.getElementById('populateHistory');
    document.getElementById('purchaseHistoryModal').style.display  = "none";
}


function displayProducts(){
    viewOption = document.getElementById('viewOption').value;
    gameGenre = document.getElementById('gameFindGenre').value;
    year = document.getElementById('year').value;
    showProducts = document.getElementById('mainDisplay');
    
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200)
        showProducts.innerHTML = xhr.responseText;
        }
    xhr.open("GET", "DisplayProducts.php?display="+ viewOption + "&genre=" + gameGenre + "&year=" + year+"&searchgg=", true);
    xhr.send();



}

function scrollRight(){
    document.getElementById('sectionChief').scrollLeft = 1000;
    console.log("Scrolled");
}
function nice(){
    console.log("Scrolled");
    document.getElementById('sectionChief').scrollLeft = -1000;
}
function resetFilters(){
    $('#gameFindGenre').prop('selectedIndex', 0);
    $('#year').prop('selectedIndex', 0);
    displayProducts();
}
function searchShit(){
    var search = document.getElementById('searchShit').value;
    var autoG = document.getElementById('autoC');
    if(search==""){
        document.getElementById('autoC').innerHTML ="";
    }

    if(search != ""){
        xhr.open("GET", "DisplayProducts.php?search="+search, true);
        xhr.send();
    }
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200)
        autoG.innerHTML = xhr.responseText;
        }
}

function searchDivShit(gameID){
    document.getElementById('autoC').innerHTML ="";
    document.getElementById('searchShit').value ="";
    displayModal(gameID);
}

function searchShitB(){
    viewOption = document.getElementById('viewOption').value;
    gameGenre = document.getElementById('gameFindGenre').value;
    year = document.getElementById('year').value;
    showProducts = document.getElementById('mainDisplay');
    searchSS = document.getElementById('searchShit').value;
    document.getElementById('autoC').innerHTML ="";
    document.getElementById('searchShit').value ="";
    if(searchSS == ""){
        //sweet alert empty
    }
    
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200)
        showProducts.innerHTML = xhr.responseText;
        }
    xhr.open("GET", "DisplayProducts.php?display="+ viewOption + "&genre=" + gameGenre + "&year=" + year + "&searchgg=" + searchSS, true);
    xhr.send();
}
