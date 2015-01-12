   <div id="footer">
   	<p>Copyright <?php echo date("Y", time()); ?>, olx.com</p>
   </div>
   <!-- javascript -->
	<script src="../javascripts/jquery-2.1.1.min.js"></script>
    <script src="../javascripts/bootstrap.min.js"></script>
  </body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>