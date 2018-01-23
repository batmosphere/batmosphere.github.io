
        var count = 0;
        function calculate(val)
        {
        document.getElementById("d").value=withDecimal(val) + '  ' + val;
        }

        function append(val)
        {  
        if(count == 0)
            {
                document.getElementById('d').value = '';
                count = 1;
            }   
        document.getElementById("d").value+=val;
        }
        function e() 
        { 
            try 
            { 

              calculate(eval(document.getElementById("d").value));
              count = 0;

            } 
            catch(e) 
            {
              calculate('Please enter only Numbers'); 
            } 
        }

            
        function convertNumberToWords(amount) {
        var words = new Array();
        words[0] = '';
        words[1] = 'One';
        words[2] = 'Two';
        words[3] = 'Three';
        words[4] = 'Four';
        words[5] = 'Five';
        words[6] = 'Six';
        words[7] = 'Seven';
        words[8] = 'Eight';
        words[9] = 'Nine';
        words[10] = 'Ten';
        words[11] = 'Eleven';
        words[12] = 'Twelve';
        words[13] = 'Thirteen';
        words[14] = 'Fourteen';
        words[15] = 'Fifteen';
        words[16] = 'Sixteen';
        words[17] = 'Seventeen';
        words[18] = 'Eighteen';
        words[19] = 'Nineteen';
        words[20] = 'Twenty';
        words[30] = 'Thirty';
        words[40] = 'Forty';
        words[50] = 'Fifty';
        words[60] = 'Sixty';
        words[70] = 'Seventy';
        words[80] = 'Eighty';
        words[90] = 'Ninety';
        var words_string = "";
        
        amount = amount.toString();
        var atemp = amount.split(".");
        var number = atemp[0].split(",").join("");
        var n_length = number.length;
        
        if (n_length <= 9) {
            var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
            var received_n_array = new Array();
            for (var i = 0; i < n_length; i++) {
                received_n_array[i] = number.substr(i, 1);
            }
            for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                n_array[i] = received_n_array[j];
            }
            for (var i = 0, j = 1; i < 9; i++, j++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    if (n_array[i] == 1) {
                        n_array[j] = 10 + parseInt(n_array[j]);
                        n_array[i] = 0;
                    }
                }
            }
            value = "";
            for (var i = 0; i < 9; i++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    value = n_array[i] * 10;
                } else {
                    value = n_array[i];
                }
                if (value != 0) {
                    words_string += words[value] + " ";
                }
                if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Crores ";
                }
                if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Lakhs ";
                }
                if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Thousand ";
                }
                if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                    words_string += "Hundred and ";
                } else if (i == 6 && value != 0) {
                    words_string += "Hundred ";
                }
            }
            words_string = words_string.split("  ").join(" ");
        }
        return words_string;
        }

        function withDecimal(n) {
        
        if(isNaN(parseInt(n)))
        {
            return " ";
        }

        if (n<0) 
        {   
            n = n*-1;    
            var nums = n.toString().split('.')
            var whole = convertNumberToWords(nums[0])
                if (nums.length == 2) 
                {
                var fraction = convertNumberToWords(nums[1])
                return "Minus " + whole + 'point ' + fraction;
                } else 
                {
                    return "Minus " + whole;
                }
        }
        else
        {       
                var nums = n.toString().split('.')
                var whole = convertNumberToWords(nums[0])
                if (nums.length == 2) 
                {
                var fraction = convertNumberToWords(nums[1])
                return whole + 'point ' + fraction;
                } 
                else 
                {
                    return whole;
                }
        }
        
    }


    const randomColor = () => '#' + Math.random().toString(16).substr(-6)
    const changeColor = () => document.body.style.backgroundColor = randomColor()

    setInterval(() => {
      changeColor()
    }, 5000)

    // start color animation as soon as document is ready
    document.onreadystatechange = () => {
      if (document.readyState === 'complete') {
        changeColor()
      }
    }


    
    function hide() {
        var x = document.getElementById("gameon");
        var y = document.getElementById("gameoff");

        if (x.style.display == "none") 
        {
            x.style.display = "block";
            document.getElementById("shift").value="Calculator";
            y.style.display = "none";

        } 
        else 
        {
            x.style.display = "none";
            document.getElementById("shift").value="Quotes";
            y.style.display = "block";
        }
    }


            function startTime() {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            var ampm = "";
            m = checkTime(m);

            if (h > 12) {
                h = h - 12;
                ampm = " PM";
            } else if (h == 12){
                h = 12;
                ampm = " AM";
            } else if (h < 12){
                ampm = " AM";
            } else {
                ampm = "PM";
            };
          
          if(h==0) {
            h=12;
          }
            
            document.getElementById('abc').innerHTML = h+":"+m+ampm;
            var t = setTimeout(function(){startTime()},500);
        }

        function checkTime(i) {
            if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

        function genQuote() {
          var randNum = Math.floor(Math.random() * 8) + 1;
          document.getElementById('quote').innerHTML = quotes[randNum];
          var tweetQuote = quotes[randNum].split(' ').join('%20');
          tweetQuote = tweetQuote.split('<br>').join('');
          tweetQuote = "https://twitter.com/intent/tweet?text=" + tweetQuote.split('"').join('')
          $('.twitter-share-button').attr('href', tweetQuote);
        }

        //quote array
        var quotes = ["Blank", "\"Dude, suckin' at something is the first step at being sorta good at something.\"<br>-  Jake <small><em>(Adventure Time)</em></small>", "\"Either I will find a way, or I will make one.\"<br> - Philip Sidney", "\"Our greatest weakness lies in giving up. The most certain way to succeed is always to try just one more time.\"<br>- Thomas A. Edison", "\"You are never too old to set another goal or to dream a new dream.\"<br>- C.S Lewis", "\"If you can dream it, you can do it.\"<br>- Walt Disney", "\"Never give up, for that is just the place and time that the tide will turn.\"<br>- Harriet Beecher Stowe", "\"I know where I'm going and I know the truth, and I don't have to be what you want me to be. I'm free to be what I want.\"<br>- Muhammad Ali", "\"If you always put limit on everything you do, physical or anything else. It will spread into your work and into your life. There are no limits. There are only plateaus, and you must not stay there, you must go beyond them.\"<br>- Bruce Lee",];

        //date
            function startDate() {
              var d = new Date();
          var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
          document.getElementById("date").innerHTML = days[d.getDay()]+" | "+d.getDate()+"/"+[d.getMonth()+1]+"/"+d.getFullYear();
        }

