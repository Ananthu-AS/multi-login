        <!-- fondawsome -->
        <script
            src="https://kit.fontawesome.com/046d649ff2.js"
            crossorigin="anonymous"
        ></script>
        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js
        "></script>
        <!-- swal js -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <?php if(isset($_SESSION["message"])&& $_SESSION["message"] != ""): 
                        ?>
                <script>
                        Swal.fire({
                        icon: '<?=$_SESSION["session_code"] ?>',
                        text: '<?=$_SESSION["message"] ?>',
                        title:'<?=$_SESSION["session_code"] ?>',
                        })
                        .then(function(){
                                window.location = "<?=$_SESSION["page"]?>";
                        })
                </script>
                <?php 
                // unset($_SESSION["message"]);
                    session_unset();    
                    session_destroy();
                ?>
                <?php endif ?>
        <!-- swal end -->
        <!-- jqery cdn -->
        <script
            src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
            crossorigin="anonymous"
        ></script>
        <!-- own js -->
        <script src="./js/script.js"></script>
    </body>
</html>