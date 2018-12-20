
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Simple Invoice Template | PrepBootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="main.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jsPDF/dist/jspdf.min.js"></script>	
    <script src="js/html2canvas.min.js"></script>	
	<!-- addImage is part of .min.js 
	<script src="js/jsPDF/jspdf.plugin.addimage.js"></script>
	-->
</head>
<body>

<div class="container">


    <button id="gen-invoice" >generate PDF</button>
    <form type="GET" action="">
        <input name="items" placeholder="items" value="<?=$_GET['items']?>">
        <button type="submit">Items</button>
    </form>
<!-- Simple Invoice - START -->
<div id="invoice-wrapper" class="container">
<div class="page-header invoice-header ">
    <img src="img/logo-negativo-we.png">
</div>
    <div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <h2>Invoice for purchase</h2><input id="invID" class="invoice-text invoice-number" type="text" placeholder="Invoice #">
                <input id="invDate" class="invoice-text invoice-date" type="text" placeholder="Date of Invoice">
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-6 pull-left">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Billing Details</div>
                        <div class="panel-body">
                            <input id="billName" class="invoice-text" type="text" placeholder="Name of Recipient">
                            <input id="billStreet" class="invoice-text" type="text" placeholder="1111 (Street Name) (DR/RD/ST/CR)">
                            <input id="billCity" class="invoice-text" type="text" placeholder="City Name">
                            <input id="billState" class="invoice-text" type="text" placeholder="State Name">
                            <input id="billZip" class="invoice-text" type="text" placeholder="Zip Number">
                            
                        </div>
                    </div>
                </div>
                
                
                <div class="col-xs-12 col-md-6 col-lg-6 pull-right">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Shipping Address</div>
                        <div class="panel-body">
                            <input id="parcelName" class="invoice-text" type="text" placeholder="Name of Recipient">
                            <input id="parcelAddress" class="invoice-text" type="text" placeholder="1111 (Street Name) (DR/RD/ST/CR)">
                            <input id="parcelCity" class="invoice-text" type="text" placeholder="City Name">
                            <input id="parcelState" class="invoice-text" type="text" placeholder="State Name">
                            <input id="parcelZip" class="invoice-text" type="text" placeholder="Zip Number">

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Item Name</strong></td>
                                    <td class="text-center"><strong>Item Price</strong></td>
                                    <td class="text-center"><strong>Item Quantity</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $items = $_GET['items'];
                                for($i=0;$i<$items;$i++):?>
                                <tr>
                                    <td style="width:50%"><input  id="item-name-<?=$i?>" class="invoice-text" type="text" placeholder="Name"></td>
                                    <td style="width:12.5%"><input  id="item-price-<?=$i?>" class="invoice-text" type="text" placeholder="Price"></td>
                                    <td style="width:12.5%"><input  id="item-quantity-<?=$i?>" class="invoice-text" type="text" placeholder="Amount"></td>
                                    <td style="width:25%"><input  id="item-total-<?=$i?>" class="invoice-text" type="text" placeholder="Total (Price*Amount)"></td>
                                    
                                </tr><?php endfor;?>
                                
                                <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Subtotal</strong></td>
                                    <td class="highrow text-right"><input id="items-subtotal" class="invoice-text" type="text" placeholder="Subtotal"></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Shipping</strong></td>
                                    <td class="emptyrow text-right"><input id="items-shipping" class="invoice-text" type="text" placeholder="Shipping Total"></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Taxes</strong></td>
                                    <td class="emptyrow text-right"><input id="items-taxes" class="invoice-text" type="text" placeholder="Taxes Total"></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Total</strong></td>
                                    <td class="emptyrow text-right"><input id="items-taxes" class="invoice-text" type="text" placeholder="Final Cost"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.height {
    min-height: 200px;
}

.icon {
    font-size: 47px;
    color: #5CB85C;
}

.iconbig {
    font-size: 77px;
    color: #5CB85C;
}

.table > tbody > tr > .emptyrow {
    border-top: none;
}

.table > thead > tr > .emptyrow {
    border-bottom: none;
}

.table > tbody > tr > .highrow {
    border-top: 3px solid;
}
</style>

<!-- Simple Invoice - END -->

</div>
<script>

    

    $('#gen-invoice').click(()=>{
        html2canvas(document.querySelector("#invoice-wrapper"), { allowTaint : true, useCORS: false }).then(canvas => {
            document.body.appendChild(canvas);
            console.log(canvas);
            var img=canvas.toDataURL("image/png");
            var doc= new jsPDF();
            var width = doc.internal.pageSize.width;    
            var height = doc.internal.pageSize.height;
            doc.addImage(img,'JPEG',0,0,width,height);
            invID = $('#invID').val();
            doc.save('invoice-'+invID+'.pdf');
            sessionStorage.invoiceDoc = doc.output();
        });
        console.log(sessionStorage.invoiceDoc);
    });

</script>
</body>
</html>