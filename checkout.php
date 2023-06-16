<?php

require "./php/connect.php";
require "./template/header.php";

?>

<script>
function successpayment()
{
    alert("Payment Successful.");
    
}

</script>

<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="container bg-light" style="margin-top:20px; margin-bottom:10px;">
    <div class="row">
        <div class="col">
            <h1 class="h3 mb-3 font-weight-normal">Make Payment</h1>
            <form method="post" action="saveorder.php">
                <h1 class="h5 mb-3 font-weight-normal">Card Information</h1>
                <label>Cardholder Name</label><br>
                <input type="text" name="ccname" placeholder="Cardholder Name" required autofocus style="margin-bottom:5px; padding:5px;">
                <br><label>Card Number</label><br>
                <input type="text" pattern="\d*" maxlength="16" name="ccnumber" placeholder="Card Number" required autofocus style="margin-bottom:5px;padding:5px;">
                <br><label>CVV</label><br>
                <input type="text" pattern="\d*" maxlength="3" name="cccvv" placeholder="CVV" required autofocus style="margin-bottom:5px;padding:5px;">
                <br><label>Valid Thru</label><br>
                <input type="text" pattern="\d*" maxlength="2" min="1" max="12" name="ccvalidmonth" placeholder="MM" required autofocus style="margin-bottom:5px; margin-right:5px; width:50px;padding:5px;">
                <input type="text" pattern="\d*" maxlength="2" min="20" max="25" name="ccvalidyear" placeholder="YY" required autofocus style=" width:50px;padding:5px;"><br>
                
                <button onclick="successpayment()" class="btn btn-primary" type="submit" style="margin-top:5px;">Make Payment</button>
            </form>
        </div>
    </div>




</div>


<?php

require "./template/footer.php";
?>