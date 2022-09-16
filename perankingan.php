<?php 
    include("config.php")
?>



<?php

                                function jml_kriteria(){    
                                    global $conn;
                                        $sql = "SELECT * FROM kriteria";
                                        $query =  $conn->query($sql);
                                        $count = mysqli_num_rows($query);
                                    return $count;  
                                }

                                function get_kriteria(){
                                    global $conn;
                                        $kriteria = "SELECT * FROM kriteria";
                                        $result = $conn->query($kriteria);
                                        $i=1;
                                        while ($dataakriteria = $result->fetch_assoc())
                                        {
                                            $kri[$i] = $dataakriteria['nama_kriteria'];
                                            $i++;
                                        }        
                                    return $kri;
                                }

                                function jml_alternatif(){  
                                    global $conn;
                                        $sql = "SELECT * FROM alternatif GROUP BY id_kk";
                                        $query = $conn->query($sql);
                                        $alternatif = mysqli_num_rows($query);
                                    return $alternatif;
                                }

                                function get_alt_name(){
                                    global $conn;        
                                        $alternatif = "SELECT * FROM alternatif";
                                        $result = $conn->query($alternatif);
                                        $i=0;
                                        while ($dataalternatif = $result->fetch_array())
                                        {
                                            $alt[$i] = $dataalternatif['kepala_keluarga'];
                                            $i++;
                                        }
                                    return $alt;
                                }

                                function get_alternatif(){
                                    global $conn;
                                        $alternatifkriteria = array();
                                        $queryalternatif = "SELECT * FROM alternatif ORDER BY id_kk";
                                        $result = $conn->query($queryalternatif);
                                        $i=0;
                                        while ($dataalternatif = $result->fetch_array())
                                        {

                                            $querykriteria = "SELECT * FROM kriteria ORDER BY id_kriteria";
                                            $query = $conn->query($querykriteria);
                                            $j=0;
                                            while ($datakriteria = $query->fetch_array())
                                            {
                                                $queryalternatifkriteria = "SELECT * FROM analisa WHERE id_kk = '$dataalternatif[id_kk]' AND id_kriteria = '$datakriteria[id_kriteria]'";
                                                $hasil = $conn->query($queryalternatifkriteria);
                                                $dataalternatifkriteria = $hasil->fetch_array();
                                                $alternatifkriteria[$i][$j] = $dataalternatifkriteria['nilai'];
                                                $j++;
                                            }
                                            $i++;
                                        }
                                    return $alternatifkriteria;
                                }

                                function pembagi(){
                                    global $conn;
                                        $pembagi = array();
                                        for ($i=0;$i<count($kriteria);$i++)
                                        {
                                            $pembagi[$i] = 0;
                                            for ($j=0;$j<count($alternatif);$j++)
                                            {
                                                $pembagi[$i] = $pembagi[$i] + ($alternatifkriteria[$j][$i] * $alternatifkriteria[$j][$i]);
                                            }
                                            $pembagi[$i] = sqrt($pembagi[$i]);
                                        }
                                    return $pembagi;
                                }

                                function get_kepentingan(){
                                    global $conn;
                                        $kepentingan = "SELECT * FROM kriteria";
                                        $query = $conn->query($kepentingan);
                                        $i=0;
                                        while ($datakepentingan = $query->fetch_array())
                                        {
                                            $kep[$i] = $datakepentingan['bobot_kriteria'];
                                            $i++;
                                        }
                                    return $kep;
                                }
                                function get_costbenefit(){
                                    global $conn;
                                        $costbenefit = "SELECT * FROM kriteria";
                                        $query = $conn->query($costbenefit);
                                        $i=0;
                                        while ($datacostbenefit = $query->fetch_array())
                                        {
                                            $cb[$i] = $datacostbenefit['atribut'];
                                            $i++;
                                        }
                                    return $cb;
                                }

                                function cmp($a, $b){
                                        if ($a == $b) {
                                            return 0;
                                        }
                                    return ($a > $b) ? -1 : 1;
                                }

                                function print_ar(array $x){    //just for print array
                                        echo "<pre>";
                                        print_r($x);
                                        echo "</pre></br>";
                                }

                                        $k = jml_kriteria();

                                        $kri = get_kriteria();

                                        $a = jml_alternatif();

                                        $alt = get_alternatif();

                                        $alt_name = get_alt_name();

                                        $kep = get_kepentingan();

                                        $cb = get_costbenefit();
?>
<section id="main" class="d-flex ">
    <div class="container">
        <div class="section-title">
            <h2 class="fw-bolder mb-4">PROSES PERHITUNGAN TOPSIS</h2>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="panel panel-default">
                        <div class="panel-body">



                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane container active">

                                    <h3 class="">Data Alternatif</h3>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-striped  table-hover">

                                            <thead>
                                                <tr>
                                                    <th>Alternatif / Kriteria</th>
                                                    <?php
                                        for($i=1;$i<=$k;$i++){
                                            echo "<th>".ucwords($kri[$i])."</th>"; 
                                        }
                                        ?>
                                                </tr>
                                            </thead>

                                            <tr>
                                                <?php
                                        for($i=0;$i<$a;$i++){

                                            echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";

                                            for($j=0;$j<$k;$j++){
                                                echo "<td>".$alt[$i][$j]."</td>";
                                            }

                                            echo "</tr>";
                                        }
                                        ?>

                                            </tr>


                                        </table>
                                    </div>

                                    <h3 class="">Pembagi</h3>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <?php
                                        for($i=1;$i<=$k;$i++){
                                            echo "<th>".ucwords($kri[$i])."</th>";   
                                        }
                                        ?>
                                                </tr>
                                            </thead>

                                            <tr>
                                                <td><b>Pembagi</b></td>

                                                <?php
                                    
                                        for($i=0;$i<$k;$i++){
                                            $pembagi[$i] = 0;
                                            for($j=0;$j<$a;$j++){
                                                $pembagi[$i] = $pembagi[$i] + pow($alt[$j][$i],2);
                                            }
                                            $pembagi[$i] = round(sqrt($pembagi[$i]),4);
                                            echo "<td>".$pembagi[$i]."</td>";
                                        }
                                                                        
                                    ?>

                                            </tr>
                                        </table>
                                    </div>


                                    <h3 class="page-head-line">Matrix Ternormalisasi</h3>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Alternatif / Kriteria</th>
                                                    <?php
                                        for($i=1;$i<=$k;$i++){
                                            echo "<th>".ucwords($kri[$i])."</th>";    
                                        }
                                        ?>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <?php
                                        for($i=0;$i<$a;$i++){
                                            echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
                                            for($j=0;$j<$k;$j++){
                                                $nor[$i][$j] = round(($alt[$i][$j] / $pembagi[$j]),4);
                                                echo "<td>".$nor[$i][$j]."</td>";
                                            }
                                            echo "</tr>";
                                        }
                                        ?>
                                            </tr>


                                        </table>
                                    </div>
                                </div>



                                <h3 class="page-head-line">Matrix ternormalisasi terbobot</h3>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped  table-hover">
                                        <thead>
                                            <tr>
                                                <th>Alternatif / Kriteria</th>
                                                <?php
                                        for($i=1;$i<=$k;$i++){
                                            echo "<th>".ucwords($kri[$i])."</th>";  
                                        }
                                        ?>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <?php
                                        for($i=0;$i<$a;$i++){
                                            echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
                                            for($j=0;$j<$k;$j++){
                                                $bob[$i][$j] = round(($nor[$i][$j] * $kep[$j]),4);
                                                echo "<td>".$bob[$i][$j]."</td>";
                                            }
                                            echo "</tr>";
                                        }
                                        ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>



                            <h3 class="page-head-line">Min Max Berdasarkan Cost Benefit Kriteria</h3>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped  table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <?php
                                        for($i=1;$i<=$k;$i++){
                                            echo "<th>".ucwords($kri[$i])."</th>";
                                        }
                                        ?>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td><b>A+</b></td>
                                        <?php
                                        for($i=0;$i<$k;$i++){
                                            for($j=0;$j<$a;$j++){
                                                $temp[$j] = $bob[$j][$i];
                                            }
                                            if($cb[$i]=='benefit')
                                                $aplus[$i] = max($temp);
                                            if($cb[$i]=='cost')
                                                $aplus[$i] = min($temp);
                                            echo "<td>".$aplus[$i]."</td>";
                                        }                               
                                    ?>
                                    </tr>
                                    <tr>
                                        <td><b>A-</b></td>
                                        <?php
                                        for($i=0;$i<$k;$i++){
                                            for($j=0;$j<$a;$j++){
                                                $temp[$j] = $bob[$j][$i];
                                            }
                                            if($cb[$i]=='benefit')
                                                $amin[$i] = min($temp);
                                            if($cb[$i]=='cost')
                                                $amin[$i] = max($temp);
                                            echo "<td>".$amin[$i]."</td>";
                                        }                               
                                    ?>
                                    </tr>
                                </table>


                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>D+</th>
                                            <th>D-</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        for($i=0;$i<$a;$i++){
                                            echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
                                            $dplus[$i] = 0;
                                            for($j=0;$j<$k;$j++){
                                                $dplus[$i] = $dplus[$i] + pow(($aplus[$j] - $bob[$i][$j]),2);
                                            }
                                            $dplus[$i] = round(sqrt($dplus[$i]),4);
                                            echo "<td>".$dplus[$i]."</td>";
                                            $dmin[$i] = 0;
                                            for($j=0;$j<$k;$j++){
                                                $dmin[$i] = $dmin[$i] + pow(($amin[$j] - $bob[$i][$j]),2);
                                            }
                                            $dmin[$i] = round(sqrt($dmin[$i]),4);
                                            echo "<td>".$dmin[$i]."</td>";echo "</tr>";
                                        }                         
                                    ?>
                                    </tr>
                                </table>
                            </div>

                        </div>


                        <h3 class="page-head-line">Preferensi</h3>
                        <hr>
                        <?php
                                    echo "<table class='table table-striped table-hover'>";
                                    echo "<thead><tr><th>#</th><th>V</th></tr></thead>";
                                    for($i=0;$i<$a;$i++){
                                        echo "<tr><td><b>".ucwords($alt_name[$i])."</b></td>";
                                        $v[$i][0] = round(($dmin[$i] / ($dplus[$i]+$dmin[$i])),4);
                                        $v[$i][1] = $alt_name[$i];
                                        echo "<td>".$v[$i][0]."</td>";
                                    }
                                    // echo "</table><hr>";
                                    // usort($v, "cmp");
                                    // $i = 0;
                                    // while (list($key, $value) = each($v)) {
                                    //     $hsl[$i] = array($value[1],$value[0]); 
                                    //     $i++;
                                    // }
                                    // test
                                    echo "</table>";
                                    usort($v, "cmp");
                                    for ($i=0; $i<$a; $i++){
                                        $key = key($v);
                                        $value = current($v);
                                        $hsl[$i] = array($value[1],$value[0]); 
                                        next($v);
                                    }

                                    // ======================================================================== //
                                    echo "<h3>Hasil Akhir Analisa</h3><hr></br>";
                                    echo "<p>Berikut ini hasil analisa diurutkan berdasarkan hasil nilai tertinggi. Jadi dapat disimpulkan bahwa keluarga yang layak menerima bantuan adalah keluarga <b>".ucwords(($hsl[0][0]))."</b> dengan nilai <b>".$hsl[0][1]."</b>.</p>";
                                    echo "<table class='table table-striped table-bordered table-hover'>";
                                    echo "<thead><tr><th>Rank</th><th>Alternatif</th><th>Hasil Akhir</th></tr></thead>";
                                    echo "<tbody>";
                                    for($i=0;$i<$a;$i++){
                                        echo "<tr><td>".($i+1).".</td><td>".ucwords(($hsl[$i][0]))."</td><td>".$hsl[$i][1]."</td></tr>";
                                    }
                                    echo "</tbody></table>";
                                    ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    </div>
</section>