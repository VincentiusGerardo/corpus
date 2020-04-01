<br><br><br>
<div class="d-flex justify-content-center">
    <h1 style="font-size:56px;">
        Welcome <?= $this->session->userdata('fullname') ?>
        <br>
        <table align="center">
            <tr>
                <td id="Jam"><?= date("h"); ?></td>
                <td>:</td>
                <td id="Menit"><?= date("i") ?></td>
                <td>:</td>
                <td id="Detik"><?= date("s") ?></td>
                <td>&nbsp;</td>
                <td><?= date("A") ?></td>
            </tr>
        </table>
        <p style="text-align: center;"><?= date("l, j F Y") ?></p>
        <p style="font-size: 26px; text-align: center; color: red;">Please use the menu on the side to navigate</p>
    </h1>
</div>
<script>
    $(function(){
    var jam = $("#Jam").text();
    var menit = $("#Menit").text();
    var detik = $("#Detik").text();

    setInterval(function(){ 

        jam = parseInt(jam);
        menit = parseInt(menit);

        detik++;

        if(detik>59){
            detik=0;
            menit++;

            if(menit>59){
                menit=0;
                 jam++;

                if(jam>23){
                    jam=0;
                }
            }
        }


        if(jam<10) jam = '0'+jam;
        if(menit<10) menit = '0'+menit;
        if(detik<10) detik = '0'+detik;

        $("#Jam").text(jam);
        $("#Menit").text(menit);
        $("#Detik").text(detik);
    },1000);
});
</script>