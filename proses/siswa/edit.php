<?php  
      require_once("../connection.php");

      if (isset($_GET['update_id'])) {

        try {

          $id = $_GET['update_id'];
          $query="SELECT * FROM tb_siswa WHERE NIS = :nis";
          $select_stmt=$db->prepare($query);
          $select_stmt->bindParam(':nis',$id);
          $select_stmt->execute();
          $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
          extract($row);

          $oldnama = $row['nama'];
          $oldjurusan = $row['jurusan'];
          $oldtingkat = $row['tingkat'];
          $oldkelas = $row['kelas'];
          $oldemail = $row['email'];
          $oldphoto = base64_encode( $row['photo'] );
          $oldphone = $row['phone'];

        } catch (PDOException $e) {
          echo $e -> getMessage();
        }
          
      }

      if(isset($_POST['btn_update'])){

         try {

            $nama=$_POST['nama'];
            $jurusan=$_POST['jurusan'];
            $tingkat=$_POST['tingkat'];
            $kelas = $_POST['kelas'];
            $email = $_POST['email'];
            $photo = file_get_contents($_FILES["photo"]["tmp_name"]);
            $telp  = $_POST['phone'];

            if(!isset($errorMsg)){
                  if(empty($nama)||empty($jurusan)||empty($tingkat)||empty($kelas)||empty($email)||empty($telp)){

                        if (empty($nama)) {
                              $errorMsg = "Nama belum dimasukan";
                        }
                        if (empty($jurusan)) {
                              $errorMsg = "Jurusan belum dipilih";
                        }
                        if (empty($tingkat)) {
                              $errorMsg = "Tingkat belum dimasukan";
                        }
                        if (empty($kelas)) {
                              $errorMsg = "Kelas belum dimasukan";
                        }
                        if (empty($email)) {
                              $errorMsg = "Email belum dimasukan";
                        }
                        if (empty($telp)) {
                              $errorMsg = "Nomor Telepon belum dimasukan";
                        }
                  }

                        $query="UPDATE tb_siswa SET nama=:nama, jurusan=:jurusan, tingkat=:tingkat, kelas=:kelas, email=:email, photo=:photo, phone=:phone WHERE NIS=:nis";
                        $query=$db->prepare($query);
                        $query->bindparam(':nis',$id);
                        $query->bindparam(':nama', $nama);
                        $query->bindparam(':jurusan', $jurusan);
                        $query->bindparam(':tingkat', $tingkat);
                        $query->bindparam(':kelas', $kelas);
                        $query->bindparam(':email', $email);
                        $query->bindparam(':photo', $photo, PDO::PARAM_LOB);
                        $query->bindparam(':phone', $telp);
                        $query->execute();

                        header("Location:../../pages/managesiswa.php?info=berhasiledit");

            }else{
                  
                  echo "<script>alert('".$errorMsg."')</script>";
            }
            
            
      } catch (Exception $e) {
            echo $e->getMessage();
      }
      }  
?>

<!DOCTYPE html>
<html>
<head>
      <title>Tambah buku</title>

      <link rel="stylesheet" type="text/css" href="../../style.css">
      <link rel="stylesheet" type="text/css" href="../../css/fontawesome/css/all.css">

</head>
<body bgcolor="#1A1A1A">
      <div align="center">
            <form method="post" enctype="multipart/form-data" action="">
                        <table align="center" class="table">
                              <tr>
                                    <td class="label" width="20%">NIS</td>
                                    <td class="forminput"><input type="text" name="nis" disabled="" value="<?php echo $id;?>"></td>
                              </tr>
                              <tr>
                                    <td class="label">Nama</td>
                                    <td class="forminput"><input type="text" name="nama" value="<?php echo $oldnama;?>"></td>
                              </tr>
                              <tr>
                                    <td class="label">Jurusan</td>
                                    <td class="custom-select">
                                      <select name="jurusan">
                                        <option value="0">Pilih Jurusan</option>
                                        <?php  
                                                $query="SELECT nama FROM tb_jurusan";
                                                $query=$db->prepare($query);
                                                $query->execute();
                                                while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
                                                      echo "<option value='".$row['nama']."'"; 
                                                      if ($row['nama'] == $oldjurusan){
                                                        echo "selected='selected'>".$row['nama']."</option>";
                                                      }
                                                      else{
                                                        echo ">".$row['nama']."</option>";
                                                      } 
                                                        
                                                }
                                          ?>
                                          
                                      </select>
                                    </td>
                              </tr>
                              <tr>
                                    <td class="label">Tingkat</td>
                                    <td class="custom-select">
                                      <select name="tingkat">
                                          <option value="0">Pilih Tingkat</option>
                                          <?php  

                                                $value = 1;

                                                while ($value<=3) {
                                                      echo "<option value='".$value."'"; 
                                                      if ($oldtingkat == $value){
                                                        echo "selected='selected'>".$value."</option>";
                                                      }
                                                      else{
                                                        echo ">".$value."</option>";
                                                      } 
                                                      $value++;  
                                                }
                                          ?>
                                      </select>
                                    </td>
                              </tr>
                              <tr>
                                    <td class="label">Kelas</td>
                                    <td class="custom-select">
                                      <select name="kelas">
                                          <option value="0">Pilih Kelas</option>
                                          <?php  

                                                $value = 1;
                                                $alphabet = "A";
                                                while ($value<=2) {

                                                      if ($value == 2) {
                                                        $alphabet = "B";
                                                      }

                                                      echo "<option value='".$value."'"; 
                                                      if ($oldtingkat == $value){
                                                        echo "selected='selected'>".$alphabet."</option>";
                                                      }
                                                      else{
                                                        echo ">".$alphabet."</option>";
                                                      } 
                                                      $value++;  
                                                }
                                          ?>
                                      </select>
                                    </td>
                              </tr>
                              <tr>
                                    <td class="label">Email</td>
                                    <td class="forminput"><input type="text" name="email" value="<?php echo $oldemail;?>"></td>
                              </tr>
                              <tr>
                                    <td class="label">Photo</td>
                                    <td class="forminput">
                                          <input type="file" name="photo">
                                          <br>
                                          
                                    </td>
                              </tr>
                              <tr>
                                    <td class="label">No Telp</td>
                                    <td class="forminput"><input type="text" name="phone" value="<?php echo $oldphone;?>"></td>
                              </tr>
                              <tr>
                                    <td></td>
                                    <td><input class="submitbtn" type="submit" name="btn_update" value="Add"></td>
                              </tr>
                        </table>
            </form>
      </div>

      <script type="text/javascript">
            var x, i, j, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);
      </script>
</body>
</html>