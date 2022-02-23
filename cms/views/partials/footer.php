<div class="footer">
  <a href="/cms/views/about.php">Impressum</a>
  <a href="/cms/views/privacy.php">Privacy</a>
</div>
<script>
function menuBar() {
  var menu = document.getElementById("navigation");
  if (menu.className === "menubar") {
    menu.className += " responsive";
  } else {
    menu.className = "menubar";
  }
}
</script>