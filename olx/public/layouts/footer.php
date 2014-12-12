   <div id="footer">
   	<p>Copyright <?php echo date("Y", time()); ?>, olx.com</p>
   </div>
  </body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>