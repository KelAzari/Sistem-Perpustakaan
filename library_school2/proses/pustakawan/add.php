<?php  
      require_once("../connection.php");

      $query="SELECT id_penerbit FROM tb_penerbit ORDER BY id_penerbit DESC LIMIT 1";
      $select_stmt=$db->prepare($query);
      $select_stmt->execute();
      $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
      $number=substr($row['id_penerbit'],2);
      $angka=intval($number);
      $angka++;
      $gabung="PT".sprintf('%04d',$angka);

      if(isset($_POST['btn_insert'])){

         try {

            $nama  = $_POST['nama'];
            $kota  = $_POST['kota'];
            $email = $_POST['email'];
            $telp  = $_POST['phone'];

            if(!isset($errorMsg)){
                  if(empty($nama)||empty($kota)||empty($email)||empty($telp)){

                        if (empty($nama)) {
                              $errorMsg = "Nama belum dimasukan";
                        }
                        if (empty($kota)) {
                              $errorMsg = "Kota belum dimasukan";
                        }
                        if (empty($email)) {
                              $errorMsg = "Email belum dimasukan";
                        }
                        if (empty($telp)) {
                              $errorMsg = "Nomor Telepon belum dimasukan";
                        }
                  }

                        $query="insert into tb_penerbit values(:id,:nama,:kota,:phone,:email)";
                        $query=$db->prepare($query);
                        $query->bindparam(':id',$gabung);
                        $query->bindparam(':nama', $nama);
                        $query->bindparam(':kota', $kota);
                        $query->bindparam(':email', $email);
                        $query->bindparam(':phone', $telp);
                        $query->execute();

                        header("Location:../../pages/managepenerbit.php?info=berhasiltambah");

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
                                    <td class="forminput"><input type="text" name="nis" disabled="" value="<?php echo $gabung;?>"></td>
                              </tr>
                              <tr>
                                    <td class="label">Nama</td>
                                    <td class="forminput"><input type="text" name="nama"></td>
                              </tr>
                              <tr>
                                    <td class="label">Kota</td>
                                    <td class="forminput"><input type="text" name="kota"></td>
                              </tr>
                              <tr>
                                    <td class="label">No Telp</td>
                                    <td class="forminput"><input type="text" name="phone"></td>
                              </tr>
                              <tr>
                                    <td class="label">Email</td>
                                    <td class="forminput"><input type="text" name="email"></td>
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