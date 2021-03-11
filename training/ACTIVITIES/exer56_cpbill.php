<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cell Phone Bill</title>
</head>
<body>
    <script>
        var plan = 15;
        var atc = .25;
        var addat = 0;
        var tmc = .15;
        var adtm = 0;
        var tat = parseInt(prompt("Enter total min. of air time: "));
        var ttm = parseInt(prompt("Enter total no. of text messages: "));
        var support = .44;
        var taddat = 0;
        var tadtm = 0;
        var tbill = 0;
        var tax = 0;
        var $tbill = 0;
        document.write("Monthly Plan: $" + plan.toFixed(2));
        if( tat > 50){
            var additionalat = tat - 50;
            taddat = additionalat * atc;
            document.write("<br>" + "Additional Airtime: $" + taddat.toFixed(2));
        }
        if( ttm > 50){
            var additionaltm = ttm - 50;
            tadtm = additionaltm * tmc;
            //alert(tadtm)
            document.write("<br>" + "Additional Text Messages: $" + tadtm.toFixed(2));
        }
        document.write("<br>" + "Support Fee: $" + support.toFixed(2));
        tbill = plan + taddat + tadtm + support;
        tax = tbill * .05;
        //alert(tax);
        document.write("<br>" + "Tax: $" + tax.toFixed(2));
        $tbill = tax + tbill;
        document.write("<br>" + "Total Bill: $" + $tbill.toFixed(2));
    </script>
</body>
</html>