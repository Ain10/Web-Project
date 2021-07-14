<!DOCTYPE html>
<?php 
    session_start();
    ob_start();
		if(empty($_SESSION['logged'])){
		header('location: index.php');
	}
    require_once('movieSort.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<script src="jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="application/javascript" src="scripts.js"></script>
</script>
<!--- Profile Picture with username --->
<div class="profile-container">
            <div id="profile-pic-container">
                <img id="profile-pic" src="profile_pics/<?php echo $_SESSION['profilePic'] ;?>" onclick="editProfilePic()">
            </div>
            <div id="username-text">
                Hello, 
                <?php echo $_SESSION['firstN']." ".$_SESSION['lastN'];?>
                <span id="at-uname"><br><?php echo $_SESSION['username'];?></span>
            </div>
            <input onkeyup="searchShit(event)" id="searchShit" placeholder="Type Something...">
            <button id="searchShitButton" onclick="searchShitB()">Search</button>
            <div id='autoC'></div>
            <button onclick="displayHistory()" id="historyButton">History</button>
            <button onclick="logout()" id="LogoutButton">Logout</button>
        </div>

<div id="displayCart">
    <h2>Cart</h2>
    <div id="Cartlist">
    
    </div>
    <div id="checkOut">
        <h3>Price</h3>
        <input id='allCartPrice' value='0' disabled>
        <button id="checkOutButton" onclick="checkout()">Check out</button>
    </div>
</div>
<div id="displayWishlist">
    <h2>Wishlist</h2>
    <div id="wishList">
<
    </div>
</div>
<div id="filters"> 
<select id="viewOption" onchange="displayProducts()">
        <option value="gallery" selected>Gallery View</option>
        <option value="list">List View</option>
  </select>
  <select id="gameFindGenre" onchange="displayProducts()">
        <option value="" disabled selected>Genre</option>
        <option value="Action">Action</option>
        <option value="Adventure">Adventure</option>
        <option value="Fighting">Fighting</option>
        <option value="Indie">Indie</option>
        <option value="Thriller">Thriller</option>
        <option value="Simulation">Simulation</option>
        <option value="Survival">Survival</option>
        <option value="Casual">Casual</option>
  </select>
  <select id="year" onchange="displayProducts()">
        <option value="" disabled selected>Year</option>
        <option value="2011">2011</option>
        <option value="2015">2015</option>
        <option value="2020">2020</option>
  </select>
  <button id="resetFilter" onclick='resetFilters()'>Reset Filters</button>
 
</div>
<div id="mainDisplay" >

</div>

    <div id="modal" style="display: none;" onclick="hideModal()">
        <input id='gameCodeHolder' type='hidden' value="">
        <img src="" id="modalImage"><br>
        <p><strong>Game Code</strong></p>
        <p id="gameCode"></p>
        <p><strong>Game Title</strong></p>
        <p id="gameTitle"></p>
        <p><strong>Game Director</strong></p>
        <p id="gameDeveloper"></p>
        <p><strong>Game Publisher</strong></p>
        <p id="gamePublisher"></p>
        <p><strong>Genre</strong></p>
        <p id="gameGenre"></p>
        <p><strong>Price</strong></p>
        <p id="gamePrice"></p>
        <p><strong>Date of Release</strong>
        <p id="DateOfRelease"></p>
        <p><strong>Description</strong>
        <p id="gameDescription"></p>
        <button id='addtoCartButton' onclick="addToCart()">Add to Cart</button>
        <button id='addToWishList' onclick="addtoWishList()">Add to Wishlist</button>
    </div>
    
    <!-- Activity 5   -->
    <div id="divAllUser">
    <h3 id="activeU">Active Users(<span id="activeUsers">0</span>)</h3>
    <ul id="userList"></ul>
    </div>
    <div class="box">
	<div id="pop-over">	</div>
</div>

<div id="chatbox">
    <button id="close-btn" onclick="hideChatBox()">x</button>
    <div class="UserChatBox chat-top">
        <p class='chat-name'></p>
        <p class='chat-uname'></p>
    </div>
    <div class="MainChat chat-mid">
<!---- Them  ---->
        <div class="chat-row sender-row">
            <div class="sender">
                <p class="chat-time"></p>
                <p class="chat-text"></p>
            </div>
        </div>
<!---- Us  ---->
        <div class="chat-row receiver-row">
            <div class="receiver">
                <p class="chat-time"></p>
                <p class="chat-text"></p>
            </div>
        </div>
    </div>
    <div class="ChatArea chat-bot">
        <textarea name="textarea" id="textarea" cols="35" rows="5"></textarea>
        <button id="send-btn" onclick="sendChat()">Send</button>
    </div>
</div>
<!--- Change profile picture modal --->

<div id="edit-img-container">
    <div id="edit-box">
        <div id="img-box">
            <img id="current-profile-pic">
        </div>
        <input type="file" id="pic" onchange="displayChosenImage()">
        <button id="change-img-btn" onclick="saveImage()">Save Changes</button>
        <button id="exit-change-btn" onclick="exitModal()">x</button>

    </div>
</div>

<!--- Purchase History --->
<div id="purchaseHistoryModal" style="display: none;">
        <h2>Purchase History</h2>
    <select id="option" onchange="displayHistory()">
        <option value="" disabled selected>Order</option>
        <option value="date">Date</option>
        <option value="price">Price</option>

  </select>
        <div id="populateHistory">
            
        </div>
        <button onclick="hideHistory()">Close</button>
</div>


</body>

</html>