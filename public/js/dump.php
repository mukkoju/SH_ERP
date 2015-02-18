
<html>
    <body>
        <div class="slt">
            <h1 style="color: black !important">From</h1>
            <form id="video_galry_fm">
                Constituency:<br> 
                <select id="cnstncy">
                    <option>Select Constituency</option>
                </select>


                <label>Candidate:<select id="cnstncy">
                </select></label>

                <label>Party:<select id="candidate">
                </select></label>
                Votes: <br><input type="text">
                <select id="candidate">
                    <option>Leading</option>
                    <option>Trial</option>
                    <option>Win</option>
                </select>
                <button id="gt">Update</button>
            </form>
        </div>
        <style>

            input{
                width: 150px;
                height: 30px;
                margin-bottom: 20px;
            }
            textarea{
                width: 350px;
                height: 100px;
                margin-bottom: 20px;
            }      
            .slt{
                margin: 10px;
                color: black !important;
                float: left;
            }
            select{
                width: 250px;
                padding: 4px;
                margin-bottom: 16px;
                display: block;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                var states = ['ADARSH NAGAR', 'DWARKA', 'HARI NAGAR', 'JANGPURA', 'KALKAJI', 'MADIPUR', 'AMBEDKAR NAGAR', 'BABARPUR', 'BADARPUR', 'BADLI', 'BALLIMARAN', 'BAWANA', 'BIJWASAN', 'BURARI', 'CHANDNI CHOWK', 'CHHATARPUR', 'DELHI CANTT', 'DEOLI', 'GANDHI NAGAR', 'GHONDA', 'GOKALPUR', 'GREATER KAILASH', 'JANAKPURI', 'KARAWAL NAGAR', 'KAROL BAGH', 'KASTURBA NAGAR', 'KIRARI', 'KONDLI', 'KRISHNA NAGAR', 'LAXMI NAGAR', 'MALVIYA NAGAR', 'MANGOL PURI', 'MATIA MAHAL', 'MATIALA', 'MEHRAULI', 'MODEL TOWN', 'MOTI NAGAR', 'MUNDKA', 'MUSTAFABAD', 'NAJAFGARH', 'NANGLOI JAT', 'NERELA', 'NEW DELHI', 'OKHLA', 'PALAM', 'PATEL NAGAR', 'PATPARGANJ', 'R K PURAM', 'RAJINDER NAGAR', 'RAJOURI GARDEN', 'RITHALA', 'ROHINI', 'ROHTAS NAGAR', 'SADAR BAZAR', 'SANGAM VIHAR', 'SEELAMPUR', 'SEEMA PURI', 'SHAHDARA', 'SHAKUR BASTI', 'SHALIMAR BAGH', 'SULTANPUR MAJRA', 'TILAK NAGAR', 'TIMARPUR', 'TRI NAGAR', 'TRILOKPURI', 'TUGHLAKABAD', 'UTTAM NAGAR', 'VIKASPURI', 'VISHWAS NAGAR', 'WAZIRPUR'];

                var i;
                var l = states.length

                for (i = 0; i < l; i++) {
                    $('#cnstncy').append('<option>' + states[i] + '</option>');
                }

                $('#state').change(function (e) {
                    e.preventDefault();
                    var constancy = $('#cnstncy option:selected').text().toLowerCase();
                    var c;
                    $.ajax({
                       url: 'index/data',
                       type: 'post',
                       data: {
                           'constituency': constancy,
                       },
                       success: function(d){
                           alert(d);
                       }
                    });
                    
//                    $('#candidate').html('');
//                    $('#cnstncy').html('');
//                    for (c = 0; c < 3; c++) {
//                        $('#cnstncy').append('<option>' + constituency[stat][c] + '</option>');
                    //}
                });

                $('#cnstncy').change(function (e) {
                    e.preventDefault();
                    var ctncy = $('#cnstncy option:selected').text().toLowerCase();
                    var c;
                    $('#candidate').html('');
                    for (c = 0; c < 3; c++) {
                        $('#candidate').append('<option>' + cndate[ctncy][c] + '</option>');
                    }
                });
            });
        </script>
    </body>
</html
