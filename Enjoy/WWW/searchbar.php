<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="personnel.php"><?php echo $_SESSION['email_u']?></a>
    <a href="logout.php">Log out</a>
</div>

<span style="padding:10px;font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

<script>
function openNav() {
document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
document.getElementById("mySidenav").style.width = "0";
}
</script>