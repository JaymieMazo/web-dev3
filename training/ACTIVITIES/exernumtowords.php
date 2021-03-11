<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        var pos = ["hundred","thousand","million"]
        var single = ["one","two","three","four","five","six","seven","eight","nine"];
        var double = ["ten","eleven","twelve","thirteen","fourteen","fifteen","sixteen","seventeen","eighteen","nineteen"];
        var doublety = ["twenty","thirty","fourty","fifty","sixty","seventy","eigty","ninety"];
        var inp = prompt("Enter Amount: ");
        var input = parseInt(inp);
        var strinput = String(input);
        var _input = strinput.length;
        var $words;
        var ty;
        var dred ="";
        var sanths="";
        //alert(_input);
        if (_input < 9){
            //alert("Convert to number!")
            if (_input == 1){
                //alert("single");
                for (var i = 1;i <= single.length;i++){
                    if (i == input){
                        alert(inp + ": " + single[i - 1]);
                    }
                }
            }
            else if (_input == 2){
                //alert("tenths")
                for (var i = 0;i <= _input - 1; i++){
                    //alert(inp[i]);
                    if (inp[i] == "1"){
                        for (var j = 0; j <= 9;j++){
                            if (inp[1] == j){
                                 alert(inp + ": " + double[j]);
                            }
                        }
                    }
                    else{
                        for (var i = 2; i <= 9; i++){
                            if (inp[0] == i){
                                 ty = doublety[i - 2];
                                for (var j = 1; j <= single.length;j++){
                                    if (inp[1] == j){
                                        ty += "-" + single[j - 1];
                                        alert(inp + ": " + ty);
                                    }
                                }
                            }
                        }
                    }
                }
                if (inp[1] == 0){
                    //alert("heree");
                    for (var i = 2; i <= 9; i++){
                        if (inp[0] == i){
                            //ty += doublety[i - 2]
                            alert(inp + ": " + ty);
                        }
                    }
                }
            }
            else if (_input == 3){
                //alert("hundredths");
                for (i = 1; i <= single.length; i++){
                    if (inp[0] == i){
                        dred += single[i - 1] + " " + pos[0];
                        //alert(inp + ": " + dred);

                    }
                }
                    if (inp[1] == "1"){
                        for (var j = 0; j <= 9;j++){
                            if (inp[2] == j){
                                 //alert(double[j]);
                                 dred += " " + double[j];
                                 alert(inp + ": " + dred);
                            }
                        }
                    }
                    else if(inp[1] == "0"){
                        for (var x = 1; x <= single.length; x++){
                            if (inp[2] == x){
                                dred +=" " + single[x - 1];
                                alert(inp + ": " + dred);
                            }
                        }
                    }
                    else if (inp[2] == "0"){
                                        for (var y = 2; y <= 9; y++){
                                            if (inp[1] == y){
                                                //alert("paired!");
                                                dred += " " + doublety[y - 2];
                                                alert(inp + ": " + dred);
                                            }
                                            
                                        }
                                    }
                    else{
                        for (var i = 2; i <= 9; i++){
                            if (inp[1] == i){
                                 ty = doublety[i - 2];
                                for (var j = 1; j <= single.length;j++){
                                    if (inp[2] == j){
                                        ty += "-" + single[j - 1];
                                        //alert(ty);
                                        dred += " " + ty;
                                        alert(inp + ": " + dred);
                                    }
                                    
                                }
                            }
                        }
                    }
                
            }
            else if (_input == 4){
                //alert("thousanths");
                for (var i = 1; i <= 9; i++){
                    if (inp[0] == i){
                        sanths += single[i - 1] + " " + pos[1];
                        //alert(inp + ": " + sanths);
                    }
                }
                for (var i = 1; i <= single.length; i++){
                    if (inp[1] == i){
                        dred += single[i - 1] + " " + pos[0];
                        //alert(dred);
                        sanths += " " + dred;
                        //alert(inp + ": " + sanths);

                        if (inp[3] == "0"){
                                        for (var y = 2; y <= 9; y++){
                                            if (inp[2] == y){
                                                //alert("paired!");
                                                dred += " " + doublety[y - 2];
                                                //alert(inp + ": " + dred);
                                                sanths += " " + dred;
                                                alert(inp + ": " + sanths);
                                            }
                                            
                                        }
                                    }
                    }

                }


                //copied
                if (inp[2] == "1"){
                        for (var j = 0; j <= 9;j++){
                            if (inp[3] == j){
                                 //alert(double[j]);
                                 dred += " " + double[j];
                                 //alert(inp + ": " + dred);
                                 sanths += " " + dred;
                                 alert(inp + ": " + sanths);
                            }
                        }
                    }
                    else if(inp[2] == "0"){
                        for (var x = 1; x <= single.length; x++){
                            if (inp[3] == x){
                                sanths +=" " + single[x - 1];
                                //alert(inp + ": " + dred);
                                
                                alert(inp + ": " + sanths);
                            }
                        }
                    }
                    else if (inp[3] == "0"){
                                        for (var y = 2; y <= 9; y++){
                                            if (inp[2] == y){
                                                //alert("paired!");
                                                dred += " " + doublety[y - 2];
                                                //alert(inp + ": " + dred);
                                                sanths += " " + dred;
                                                alert(inp + ": " + sanths);
                                            }
                                            
                                        }
                                    }
                    else{
                        for (var i = 2; i <= 9; i++){
                            if (inp[2] == i){
                                 ty = doublety[i - 2];
                                for (var j = 1; j <= single.length;j++){
                                    if (inp[3] == j){
                                        ty += "-" + single[j - 1];
                                        //alert(ty);
                                        dred += " " + ty;

                                        //alert(inp + ": " + dred);
                                        sanths += " " + ty;
                                        alert(inp + ": " + sanths);
                                    }
                                    
                                }
                            }
                        }
                    }
                    //upcopied




                
            }
            if (_input == 5){



                
                
            }
        }
    
    
        else{
           alert("Value too big!");
        }
    </script>
</body>
</html>