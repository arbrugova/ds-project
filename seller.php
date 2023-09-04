<?php 
session_start();
if(isset($_SESSION['user_id'])){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="sellerLogic.php" method="post" >
            <label for="title">Job title</label>
            <input type="text" id="title" name="title" required >
    
            <label for="education">Education</label>
            <input type="text" id="education" name="education" required>
    
            <label for="degree">Degree</label>
            <select id="degree" name="degree">
                <option value="bachelor">Bachelor</option>
                <option value="master">Master</option>
                <option value="phd">Phd</option>
            </select>
    
            <label for="rate">Rate</label>
            <input type="number" id="rate" name="rate" required >
            <button type="submit">Submit</button>
        </form>
        
    </body>
    </html>
 <?php }else{ ?>
    <p>Please log in</p>

 <?php header("Location: signup.php");}?>