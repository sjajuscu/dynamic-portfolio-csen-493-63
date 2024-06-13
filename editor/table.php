<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="main-table mb-3">
                    <div class="sr">Sr No</div>
                    <div class="asset">Image</div>
                    <div class="edit">Edit</div>
                    <div class="hide">Hide</div>
                    <div class="delete">Delete</div>
                    <div class="content">Item</div>
                </div>
                <hr>
                <?php
                session_start();
                $file = basename($_SERVER['REQUEST_URI']);
                $file = explode('.', $file);
                $file = trim($file[0]);
                $card = $_SESSION['card'];
                $sql = "SELECT * FROM immagini where i_sezione='{$file}' and i_persona='{$card}' and i_schermo = 'true'";
                // echo $sql;
                $result = mysqli_query($conn, $sql);
                $i = 0;
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<div class='main-table'>
                            <div class='sr'>" . ++$i . "</div>
                            <div class='asset'> <a href='.././".$data['i_allegato']."' target='_blank' class='btn btn-light'><i class='fa fa-image'></i></a> </div>
                            <div class='edit'><button class='btn btn-primary' onclick='edit(`".$data['i_id']."`)' data-toggle='modal' data-target='#modal_newentry'><i class='fa fa-edit'></i></button></div>
                            <div class='hide'> <a href='{$file}.php?hide=" . $data['i_id'] . "' class='btn btn-secondary'><i class='fa fa-eye-slash'></i></a> </div>
                            <div class='delete'> <a href='{$file}.php?delete=" . $data['i_id'] . "' class='btn btn-danger'><i class='fa fa-times'></i></a> </div>";
                    echo "<div class='content'>" . $data['i_nome'] . "<br>";
                        if(htmlspecialchars_decode(base64_decode($data['i_descrizione'])) != "[object Object]")
                            echo  htmlspecialchars_decode(base64_decode($data['i_descrizione']));
                    echo "</div>
                          </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>