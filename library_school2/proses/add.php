<?php  
      require_once("connection.php");

      $query="SELECT id_buku FROM tb_buku ORDER BY id_buku DESC LIMIT 1";
      $select_stmt=$db->prepare($query);
      $select_stmt->execute();
      $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
      $number=substr($row['id_buku'],2);
      $angka=intval($number);
      $angka++;
      $gabung="B".sprintf('%04d',$angka);

      if(isset($_POST['btn_insert'])){

         try {
                  
             
            $judul=$_POST['judul'];
            $pengarang=$_POST['pengarang'];
            $penerbit=$_POST['penerbit'];

            $photo = $_FILES["photo"]["name"];
            $type = $_FILES["photo"]["type"];
            $size = $_FILES["photo"]["size"];
            $temp = $_FILES["photo"]["tmp_name"];

            $harga = $_POST['harga'];
            $jumlah = $_POST['jumlah'];

            $path="upload/".$photo;

            if(empty($judul)){
                  $errorMsg = "Judul belum dimasukan";
            }
            else if (empty($photo)) {
                  $errorMsg="Foto belum dipilih";
            }
            else if ($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') {
                  if (!file_exists($path)) {
                        if ($size < 5000000) {
                              move_uploaded_file($temp, "../upload/" .$photo);
                        }
                        else{
                              $errorMsg = "Your file is too large, please upload a file with 5MB size or smaller";
                        }
                  }
                  else {
                        $errorMsg="File already exists... Check upload folder";
                  }
            }
            else {
                  $errorMsg="Upload with JPG, JPEG, PNG or GIF file format... Check file extension";
            }

            if(!isset($errorMsg)){
                  if(empty($judul)||empty($pengarang)||empty($penerbit)||empty($harga)||empty($jumlah)){

                        if (empty($judul)) {
                              $errorMsg = "Judul belum dimasukan";
                        }
                        if (empty($pengarang)) {
                              $errorMsg = "Nama pengarang belum dimasukan";
                        }
                        if (empty($penerbit)) {
                              $errorMsg = "Penerbit belum dimasukan";
                        }
                        if (empty($harga)) {
                              $errorMsg = "Harga belum dimasukan";
                        }
                        if (empty($jumlah)) {
                              $errorMsg = "Jumlah belum dimasukan";
                        }
                  }

                        $query="insert into tb_buku(id_buku,id_penerbit,judul,pengarang,photo,harga,jumlah) values(:kode,:penerbit,:judul,:pengarang,:photo,:harga,:jumlah)";
                        $query=$db->prepare($query);
                        $query->bindparam(':kode',$gabung);
                        $query->bindparam(':penerbit', $penerbit);
                        $query->bindparam(':judul', $judul);
                        $query->bindparam(':pengarang', $pengarang);
                        $query->bindparam(':photo', $photo);
                        $query->bindparam(':harga', $harga);
                        $query->bindparam(':jumlah', $jumlah);
                        $query->execute();

                        header("Location:../pages/managebuku.php?info=berhasiltambah");

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

      <link rel="stylesheet" type="text/css" href="../style.css">
      <link rel="stylesheet" type="text/css" href="../css/fontawesome/css/all.css">

</head>
<body bgcolor="#1A1A1A">
      <div align="center">
            <form method="post" enctype="multipart/form-data" action="">
                        <table align="center" class="table">
                              <tr>
                                    <td class="label" width="20%">Kode Buku</td>
                                    <td class="forminput"><input type="text" name="kode" disabled="" value="<?php echo $gabung;?>"></td>
                              </tr>
                              <tr>
                                    <td class="label">Penerbit</td>
                                    <td class="custom-select"><select name="penerbit">
                                          <option value="0">Pilih Penerbit</option>
                                          <?php  
                                                $query="SELECT id_penerbit, nama FROM tb_penerbit";
                                                $query=$db->prepare($query);
                                                $query->execute();
                                                while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
                                                      echo "<option value='".$row['id_penerbit']."'>".$row['id_penerbit']." - ".$row['nama']."</option>";
                                                }
                                          ?>
                                    </select></td>
                              </tr>
                              <tr>
                                    <td class="label">Judul</td>
                                    <td class="forminput"><input type="text" name="judul"></td>
                              </tr>
                              <tr>
                                    <td class="label">Pengarang</td>
                                    <td class="forminput"><input type="text" name="pengarang"></td>
                              </tr>
                              <tr>
                                    <td class="label">Photo</td>
                                    <td class="forminput">
                                          <input type="file" name="photo">
                                    </td>
                              </tr>
                              <tr>
                                    <td class="label">Harga</td>
                                    <td class="forminput"><input type="text" name="harga"></td>
                              </tr>
                              <tr>
                                    <td class="label">Jumlah</td>
                                    <td class="forminput"><input type="text" name="jumlah"></td>
                              </tr>
                              <tr>
                                    <td></td>
                                    <td><input class="submitbtn" type="submit" name="btn_insert" value="Add"></td>
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