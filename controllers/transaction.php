<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/order_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list1";
$title = ucfirst("Order");
$judul = 'Zee Holistic';
$_SESSION['menu_active'] = 2;

switch ($page) {

    case 'list1':
             get_header();
        $close_button = "home.php";

        $reserved_id = isset($_GET['reserved_id']) ? $_GET['reserved_id'] : null;

        if($reserved_id!=null)
        {
            $where_reserved_id = "WHERE reserved_id = '$reserved_id'";
            $r_reserved = select_object_config('reserved', $where_reserved_id);
        } else {
            $r_reserved = new stdClass;

            $r_reserved->reserved_id = false;
            $r_reserved->member_id   = false;
            $r_reserved->phone       = false;
            $r_reserved->address     = false;
            $r_reserved->date        = false;
            $r_reserved->hour        = false;
            $r_reserved->pijat       = false;
            $r_reserved->status      = false;
        }

        $date = format_date(date("Y-m-d"));
        if(isset($_GET['date'])){
          $date = format_date($_GET['date']);
        }

        $branch_id = $_SESSION['branch_id'];
        if(isset($_GET['branch_id_'])){
          $branch_id = format_date($_GET['branch_id_']);
        }

        $q_member = select_config('members', '');
        $q_pemijat = select_config('pemijat', '');
        $q_branch = select_config('branches','');

        $q_pijat = select_config('pijat', '');

         $q_item = select_config('item', '');

        $ruangan_infrastruktur_id = isset($_GET['ruangan_infrastruktur_id']) ? $_GET['ruangan_infrastruktur_id'] : null;
        // get_isset($_GET['ruangan_infrastruktur_id']);
        $paket_pijat_id = isset($_GET['paket_pijat_id']) ? $_GET['paket_pijat_id'] : null;

        $where_ruangan_infrastruktur_id = "where ruangan_infrastruktur_id = '$ruangan_infrastruktur_id'";
        $infrastruktur_name = select_config_by('ruangan_infrastruktur', 'infrastruktur_name', $where_ruangan_infrastruktur_id);
        $infrastruktur_id = select_config_by('ruangan_infrastruktur', 'infrastruktur', $where_ruangan_infrastruktur_id);

        $keterangan = "";

        if ($ruangan_infrastruktur_id!=null) {
          $keterangan = '<center>
                            <span class="span_title">'.$infrastruktur_name.'</span>
                         </center>';
        }

        if ($paket_pijat_id!=null) {
          $keterangan=1;
        }

            // $query = select($where);

            //inisialisasi

        // $pijat

        // $where_infrastruktur_id = "WHERE infrastruktur_id = '$infrastruktur_id'";
        // $infrastruktur_name = select_config_by('infrastruktur', 'infrastruktur_name', $where_infrastruktur_id);
            $action_statement = "transaction.php?page=save";
        include '../views/transaction/list1.php';
        get_footer();
    break;
     
     case 'list':
        get_header();
        $close_button = "home.php";

        $reserved_id = isset($_GET['reserved_id']) ? $_GET['reserved_id'] : null;

        if($reserved_id!=null)
        {
            $where_reserved_id = "WHERE reserved_id = '$reserved_id'";
            $r_reserved = select_object_config('reserved', $where_reserved_id);
        } else {
            $r_reserved = new stdClass;

            $r_reserved->reserved_id = false;
            $r_reserved->member_id   = false;
            $r_reserved->phone       = false;
            $r_reserved->address     = false;
            $r_reserved->date        = false;
            $r_reserved->hour        = false;
            $r_reserved->pijat       = false;
            $r_reserved->status      = false;
        }

        $date = format_date(date("Y-m-d"));
    		if(isset($_GET['date'])){
    			$date = format_date($_GET['date']);
    		}

        $branch_id = $_SESSION['branch_id'];
        if(isset($_GET['branch_id_'])){
    			$branch_id = format_date($_GET['branch_id_']);
    		}

        $q_member = select_config('members', '');
        $where = "available = '1'";
        $q_pemijat = select_config('pemijat', '');

    		$q_branch = select_config('branches','');

        $q_pijat = select_config('pijat', '');

         $q_item = select_config('item', '');

        $ruangan_infrastruktur_id = isset($_GET['ruangan_infrastruktur_id']) ? $_GET['ruangan_infrastruktur_id'] : null;
        // get_isset($_GET['ruangan_infrastruktur_id']);
        $paket_pijat_id = isset($_GET['paket_pijat_id']) ? $_GET['paket_pijat_id'] : null;

        $where_ruangan_infrastruktur_id = "where ruangan_infrastruktur_id = '$ruangan_infrastruktur_id'";
        $infrastruktur_name = select_config_by('ruangan_infrastruktur', 'infrastruktur_name', $where_ruangan_infrastruktur_id);
        $infrastruktur_id = select_config_by('ruangan_infrastruktur', 'infrastruktur', $where_ruangan_infrastruktur_id);

        $keterangan = "";

        if ($ruangan_infrastruktur_id!=null) {
          $keterangan = '<center>
                            <span class="span_title">'.$infrastruktur_name.'</span>
                         </center>';
        }

        if ($paket_pijat_id!=null) {
          $keterangan=1;
        }

            // $query = select($where);

            //inisialisasi

        // $pijat

        // $where_infrastruktur_id = "WHERE infrastruktur_id = '$infrastruktur_id'";
        // $infrastruktur_name = select_config_by('infrastruktur', 'infrastruktur_name', $where_infrastruktur_id);
            $action_statement = "transaction.php?page=save";
        include '../views/transaction/list.php';
        get_footer();
        break;

        // for Menu Drop Down Ruangan
        case 'get_ruangan_by':
          $branch_id = $_POST['branch_id'];
          $i = $_POST['i'];

          $q_ruangan = select_ruangan_by($branch_id);
          while ($ruangan = mysql_fetch_array($q_ruangan)) {
            $data[] = array(
                    'ruangan_id' => $ruangan['ruangan_id'], 
                    'ruangan_name' => $ruangan['ruangan_name'], 
                    'available' => $ruangan['available'], 
                    'idx'                => $i,

                    );
          }
          
          echo json_encode($data);
          break;

          case 'get_pemijat_by':
          
          $q_pemijat = select_config('pemijat', '');
          $i = $_POST['i'];


            while ($r_pemijat = mysql_fetch_array($q_pemijat)) {
              $data[] = array(
                'pemijat_id'          => $r_pemijat['pemijat_id'],
                'pemijat_name'          => $r_pemijat['pemijat_name'],
                'available'          => $r_pemijat['available'],
                'idx'                => $i,
             );
            }
            // var_dump($data);
          echo json_encode($data);
          break;

          case 'get_pijat':
          
          $q_pijat = select_config('pijat', '');
          $i = $_POST['i'];


            while ($r_pijat = mysql_fetch_array($q_pijat)) {
              $data[] = array(
                'pijat_id'          => $r_pijat['pijat_id'],
                'pijat_name'          => $r_pijat['pijat_name'],
                'pijat_harga'          => $r_pijat['pijat_harga'],
                'pijat_waktu'          => $r_pijat['pijat_waktu'],
                'infrastruktur'          => $r_pijat['infrastruktur'],
                'idx'                => $i,
             );
            }
            // var_dump($data);
          echo json_encode($data);
          break;

        default:

    break;

    case 'save':
        extract($_POST);
        $i_member = get_isset($i_member);
        $i_branch = get_isset($i_branch);
        $i_pijat = get_isset($i_pijat);
        $i_item = [];
        $i_date = get_isset($i_date);
        $i_date = format_back_date($i_date);
        $grand_total_currency = get_isset($grand_total_currency);
        // $i_hour = get_isset($i_hour);

        // $i_h = explode(" ", $i_hour);

        // $hour = explode(":", $i_h[0]);



        // if($i_h[1] == "PM"){
        //     if($hour[0] == 12){
        //         $new_hour = $hour[0];
        //     }else{
        //         $new_hour = $hour[0] + 12;
        //     }
        //     $new_hour = $new_hour.":".$hour[1];
        // }else{
        //     if($hour[0] == 12){
        //         $new_hour = $hour[0] - 12;
        //     }else{
        //         $new_hour = $hour[0];
        //     }

        //     if(strlen($new_hour)==1){
        //         $new_hour = "0".$new_hour;
        //     }

        //     $new_hour = $new_hour.":".$hour[1];
        // }
            if ($i_pijat) {
                  $data = "'',
                        '$i_member',
                        '$i_branch',
                        '$i_pijat',
                        '$grand_total_currency',
                        '$i_date',
                        '0'
                        ";

                $transaction_id = create_config('transactions_tmp', $data);

                        foreach ($i_item as $key => $value) {
                            $data_detail = "''
                                            '$transaction_id',
                                            '$i_pijat',
                                            '$i_item[$key]',
                                            '',
                                            '',
                                            '',
                                            '',
                                            '',
                                            '',
                                            '',
                                            ''";

                    create_config('transaction_tmp_details', $data);
                }
                header("location: statement.php?page=list&id=$transaction_id&member=$i_member");
            } else {
                header("location: transaction.php");
            }


        break;

        case 'get_items':
          $where = '';
          $q_items = select_config("item", $where);
          while ($r_items = mysql_fetch_array($q_items)) {
            $data[] = array(
              'item_id'          => $r_items['item_id'],
              'item_name'        => $r_items['item_name'],
              'item_harga_jual'  => $r_items['item_harga_jual'],
              'status_id'        => '',
              'status_name'        => ''
           );
          }
          echo json_encode($data);
          break;

        case 'simpan_transaksi':
          $item_id      = $_POST['item_id'];
          $item_qty     = $_POST['item_qty'];
          $member_id    = $_POST['i_member'];
          $tanggal      = $_POST['i_date'];
          $jam      = $_POST['i_clock'];
          $tanggal      = format_back_date($tanggal);
          $tanggal = $tanggal." ".$jam;
          $branch_id    = $_POST['i_branch'];
          // $pijat_id     = $_POST['i_pijat'];
          $reserved_id  = $_POST['reserved_id'];
          $item_price   = $_POST['item_price'];
          $pijat_price  = $_POST['pijat_price'];
          $rombongan    = $_POST['n_qty'];
          // var_dump($_POST);
                               // '$pijat_id',
          $data_transaction = "'',
                               '$member_id',
                               '$branch_id',
                               '',
                               '$pijat_price',
                               '$tanggal',
                               ''";
          $transaction_id = create_config('transactions_tmp', $data_transaction);


          // echo $item_qty;
                          
          $i = 0;
          $total = 0;
          foreach ($item_id as $value) {
            $total = 0;
            $total = $item_price[$i]*$item_qty[$i];
            $data_transaction_detail = "'',
                                        '$transaction_id',
                                        '',
                                        '".$item_id[$i]."',
                                        '".$item_qty[$i]."',
                                        '".$item_price[$i]."',
                                        '',
                                        '',
                                        '',
                                        '',                                    
                                        '".$total."',
                                        ''";
            create_config('transaction_tmp_details', $data_transaction_detail);
            $i++;
          }

          for ($i=0; $i < $rombongan; $i++) { 
            $data_transaction_detail = "'',
                                        '$transaction_id',
                                        '',
                                        '".$item_id[$i]."',
                                        '".$item_qty[$i]."',
                                        '".$item_price[$i]."',
                                        '',
                                        '',
                                        '',
                                        '',                                    
                                        '".$total."',
                                        ''";
            create_config('transaction_tmp_details_cs', $data_transaction_detail);
          }

          $data = array(
              'transaction_id'  => $transaction_id, 
              'member_id'       => $member_id
              );

          echo json_encode($data);

          break;

          case 'form_statement':
                echo "string";
                $status = 1;
                $i_member = $_GET['member_id'];
                $transaction_id = $_GET['transaction_id'];
                print_r($_GET);
                header("location: statement.php?page=list&id=$transaction_id&member=$i_member&status=$status");
            break;

      case 'statement_cs':

      $close_button = "member.php?page=list";
      // $print ="print.php?page=statement";

      $id = (isset($_GET['id'])) ? $_GET['id'] : null;
      $query_statement = select_statement($id);

      if($id){
        $row = read_id($id);
        $where_member_id = "where member_id = '$id'";
        $r_statement = select_object_config('statement', $where_member_id);

        $action = "member.php?page=edit&id=$id"; 

        $check_statement = select_config_by('statement', 'count(*)', $where_member_id);

        if (!$check_statement) {

          $r_statement = new stdClass();

          $r_statement->tekanan = false;
          $r_statement->asma = false;
          $r_statement->inhaler = false;
          $r_statement->leher = false;
          $r_statement->kulit = false;
          $r_statement->kulit_jabarkan = false;
          $r_statement->selain_diatas = false;
          $r_statement->selain_jabarkan = false;
          $r_statement->alergi  = false;
          $r_statement->alergi_jabarkan = false;
          $r_statement->hamil = false;
          $r_statement->usia_kandungan = false;
          $r_statement->kontak_lens = false;
          $r_statement->melepas_lens = false;
          $r_statement->level = false;
          $r_statement->spesial = false;
          $r_statement->jawaban = false;
          $r_statement->tidak_menyembunyikan = false;
          $r_statement->tanggung_jawab = false;
          $action_statement = "member.php?page=save_statement&id=$id";
        } else {
          $action_statement = "member.php?page=edit_statement&id=$id";
        }

      } else {

        //inisialisasi
        $row = new stdClass();

        $row->member_name = false;
        $row->member_phone = false;
        $row->member_dateofbirth = false;
        $row->member_alamat = false;
        $row->member_email = false;
        $action = "member.php?page=save";
      }
      include '../views/transaction/form_statement_order.php';
      get_footer();
    break;
    case 'get_ruangan':
      # code...
      break;

    }
