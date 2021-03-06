<?php error_reporting(0) ?>
<link href="../css/transaction.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
	label{
		color: rgb(107, 52, 106);
	}

</style>
<section class="content">
	<div class="col-md-12">
		<div class="box">
			<div class="box-body">
				<form id="form_pijat" role="form">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-3">
								<div class="form-group">
									<input type="hidden" id="reserved_id" name="reserved_id" value="<?php echo $reserved_id?>">
									<label for="">Tanggal : </label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" required class="form-control pull-right normal"
										id="date_picker1" name="i_date" value="<?= $date ?>"/>
									</div><!-- /.input group -->
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Jam : </label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</div>
										<input type="text" required class="form-control pull-right normal clockpicker "
										id="clock_picker1" name="i_clock" value="<?php echo date("H:i"); ?>"/>
									</div><!-- /.input group -->
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="">Member :</label>
									<select name="i_member" size="1" class="selectpicker form-control normal select2" id="member" required>
		                      <option value="">- Pilih Member -</option>
		                      <option value="0">Non Member</option>
		                      <?php
		                      while($r_member = mysql_fetch_array($q_member)){
		                      ?>
		                      <option value="<?= $r_member['member_id'] ?>"
														<?php if($r_reserved->member_id == $r_member['member_id']){ ?> selected="selected"<?php } ?>>
														<?= $r_member['member_name']?> - <?= $r_member['member_phone']?>
													</option>
		                      <?php
		                      }
		                      ?>
		              </select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="">Cabang :</label>
									<select class="selectpicker form-control normal select2" id="cabang" name="i_branch" required>
									<option value="">- Pilih Cabang -</option>
										<?php while ($r_branch = mysql_fetch_array($q_branch)) {?>
											<option value="<?= $r_branch['branch_id']?>">
												<?= $r_branch['branch_name']?></option>
										<? } ?>
									</select>
								</div>
							</div>

						</div>
						<div class="col-md-12">
							<div class="col-md-3">
								<div class="form-group">
									<label for="">No Telepon : </label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-phone"></i>
										</div>
										<input type="text" required class="form-control pull-right number"
										id="i_notelp" name="n_notelp" value=""/>
									</div><!-- /.input group -->
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="">Banyak Orang : </label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-users"></i>
										</div>
									<select class="selectpicker form-control normal select2" id="i_qty" name="n_qty" required>
									<option value="">- Input Jumlah-</option>
										<?php for ($i=1; $i < 11; $i++) {?> 
											<option value="<?php echo $i; ?>"><?php echo $i; ?> orang</option>
										<?php } ?>
									</select>
									</div><!-- /.input group -->
								</div>
							</div>

							<div class="col-md-3">
								<div><label><br></label></div>
								<button class="btn btn-success" id="btnLanjut">Lanjut</button>
							</div>
							</div>

							<div class="row">
								<div id="form_cs"></div>
							</div>

								

							</div>

							
							<div class="row">
								<div class="col-md-12">
									
									<div class="form-group">
										<label>Harga :</label>
										<input required type="text" class="form-control normal" readonly name="grand_total_currency" id="grand_total_currency">
										<input type="hidden" name="pijat_price" id="pijat_price" class="form-control normal"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="row">
									<div class="col-md-6">
										<div class="input-group">
											<input type="text" id="search" class="form-control input-sm normal" placeholder="Cari produk">
											<span class="input-group-btn">
												<button class="btn btn-default btn-sm" type="button">
													<i class="fa fa-search"></i>
												</button>
											</span>
										 </div><!-- /input-group -->
									</div>
									<div class="col-md-6">
										<div class="">
													<input type="text" name="" value="" id="total_allcurr" class="price-tag form-control normal" style="text-align: right;" readonly>
													<input type="hidden" name="" value="" id="total_all" class="price-tag form-control normal">
												</div><!-- /input-group -->
									</div>
								</div>
								<div class="col-md-6">
										<div id="" class="panel panel-default panel-item">
											<div class="row">
											<table id="table_item" class="table my-item" style="font-size: 12px;">
		                      <thead>
		                        <tr>
								 								<th width="5%">No.</th>
		                          	<th width="50%">NAMA ITEM</th>
		                          	<th class="text-right">HARGA</th>
		                          	<th class="text-center"><i class="fa fa-th"></i></th>
		                        </tr>
		                      </thead>
		                      <tbody class="" id="data_items" class="scrollable">

		                      </tbody>
		                    </table>
										</div>
									</div>
								</div>
									<div class="col-md-6">
										<div class="panel panel-default panel-item">
										<table class="table my-item">
											<thead>
												<tr>
													<th class="text-center" style="width:10%;">QTY</th>
													<th width="40%">ITEM</th>
													<th style="">HARGA</th>
													<th class="text-center hide" id="sales-column-discount">DISC</th>
													<th class="text-right">TOTAL</th>
													<th width="13%" class="text-center"><i class="fa fa-th"></i></th>
												</tr>
											</thead>
											<tbody id="tbody_sales_cart">

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer" style="background-color: #fff; border-color:#ddd;">
	            <button id="" type="submit" class="btn btn-danger">Save</button>
	            <a href="<?= $close_button?>">
								<button type="button" name="button" class="btn btn-default" >
									Close
								</button>
							</a>
	        </div>
				</form>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">

  jQuery('#btnQ').colorbox({
  	width: "100%",
  	closeButton: false
  });

	$( "#btnLanjut" ).click(function() {

	  var jml = $("#i_qty").val();
	  var cabang = $("#cabang").val();

	  if (cabang) {
	  	$("#form_cs").empty();

	for (var i = 0; i < jml; i++) {
		var no = i+1;
	  var html = '							<!-- untuk Append -->\
							<div class="row">\
								<div class="col-md-12">\
								<h4>Pelanggan '+no+' :</h4>\
								</div>\
							</div>\
							<div class="row">\
								<div class="col-md-3">\
									<div class="form-group">\
										<label for="">Nama : </label>\
										<div class="input-group">\
											<input type="text" required class="form-control pull-right number"\
											id="i_nama_'+i+'" name="n_nama_'+i+'" value=""/>\
										</div><!-- /.input group -->\
									</div>\
								</div>\
								<div class="col-md-3">\
									<div class="form-group">\
										<label for="">Pemijat :</label>\
										<select class="selectpicker form-control normal select2" id="i_pemijat_'+i+'" name="n_pemijat_'+i+'" required>\
										<option value="">- Pilih Pemijat -</option>\
											\
										</select>\
									</div>\
								</div>\
								<div class="col-md-3">\
									<div class="form-group">\
										<label for="">Ruangan :</label>\
										<select class="selectpicker form-control normal select2" id="i_ruangan_'+i+'" name="n_ruangan_'+i+'" required>\
										<option value="">- Pilih Ruangan -</option>\
										</select>\
									</div>\
								</div>\
								<div class="col-md-2">\
									<div class="form-group">\
										<label for="">Pijat :</label>\
										\
										<select name="n_pijat" size="1" class="selectpicker form-control normal select2" id="i_pijat_'+i+'" required>\
										</select>\
									</div>\
								</div>\
								<div class="col-md-1">\
									<div><label><br></label></div>\
									<a href="../controllers/transaction.php?page=statement_cs" type="button" data-toggle="modal" data-target="#questioner_" id="btnQ_'+i+'" class="btn btn-info" value="Q"><i class="fa fa-list" aria-hidden="true"></i>\
</a>\<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>\
								</div>\
							</div>\
							<!-- End Append -->';
					    $("#form_cs").append(html);
 $("select").select2({
            placeholder: "Please Select"
        });
					
		$.ajax({
            type        : "post",
            url         : "transaction.php?page=get_pemijat_by",
            data        : {i:i},
            dataType    : "json",
            success: function(data){
            	console.log(data);
              $('#i_pemijat_'+data[0].idx).empty();
              $('#i_pemijat_'+data[0].idx).append('<option value="0">Pilih Pemijat</option>');

              for (var i = 0; i < data.length; i++) {
                if (data[i].available) {
                $('#i_pemijat_'+data[0].idx).append('<option value="'+data[i].pemijat_id+'">'+data[i].pemijat_name+'</option>');	
            }else{

                $('#i_pemijat_'+data[0].idx).append('<option disabled="disabled" value="'+data[i].pemijat_id+'">'+data[i].pemijat_name+'</option>');
            }
              }

            },
            error: function(data)
            {
              console.log(data);

              alert("error");
            }
          });

		$.ajax({
            type        : "post",
            url         : "transaction.php?page=get_ruangan_by",
            data        : {i:i, branch_id:cabang},
            dataType    : "json",
            success: function(data){
            	console.log(data);
              $('#i_ruangan_'+data[0].idx).empty();
              $('#i_ruangan_'+data[0].idx).append('<option value="0">-Pilih Ruangan-</option>');

              for (var i = 0; i < data.length; i++) {
                if (data[i].available) {
                $('#i_ruangan_'+data[0].idx).append('<option value="'+data[i].ruangan_id+'">'+data[i].ruangan_name+'</option>');	
            }else{

                $('#i_ruangan_'+data[0].idx).append('<option disabled="disabled" value="'+data[i].ruangan_id+'">'+data[i].ruangan_name+'</option>');
            }
              }

            },
            error: function(data)
            {
              console.log(data);

              alert("error");
            }
          });

		$.ajax({
            type        : "post",
            url         : "transaction.php?page=get_pijat",
            data        : {i:i},
            dataType    : "json",
            success: function(data){
            	console.log(data);
              $('#i_pijat_'+data[0].idx).empty();
              $('#i_pijat_'+data[0].idx).append('<option value="0">-Pilih Ruangan-</option>');

              for (var i = 0; i < data.length; i++) {
                
                $('#i_pijat_'+data[0].idx).append('<option value="'+data[i].pijat_id+'">'+data[i].pijat_name+'</option>');	
            
              }

            },
            error: function(data)
            {
              console.log(data);

              alert("error");
            }
          });

		} //for
	}else{
		alert('Pilih Cabang Terlebih Dahulu');
	}
	


    

	});

	

	function set_harga() {
		var i_pijat = $('#i_pijat').val();
		var harga = $('#i_pijat option:selected').data('harga')||0;
		$('#pijat_price').val(harga)||0;
		$('#grand_total_currency').val(toRp(harga))||0;
		console.log(harga);
	}

	$('body').on('click', '.btn-add-cart', function (e) {
      $.fn.addCart($(this));
      e.preventDefault();
  });


$(document).ready(function(){

	set_harga();

	var items = [];
	var html = '';
	var add_item_list = [];
	// var item_detail = [];
	// var search_data = [];

	$.fn.getItems = function(){
		$.get("transaction.php?page=get_items",function(data){
						var no = 1;
						$.each(JSON.parse(data), function (index, value) {
								items.push(value);
								html += '<tr>\
													<td style="text-align:center;">'+no+'</td>\
													<td id="item-name">'+value.item_name+'\
													<td class="text-right">'+Intl.NumberFormat().format(value.item_harga_jual)+'</td><td class="text-center">\
														<button data-disc="" data-price="'+value.item_harga_jual+'" \
														data-qty="1" data-name="'+value.item_name+'" \
														data-id="'+value.item_id+'" data-has-promo=""\
														data-status-aktif="'+value.status_id+'"\
														data-promo-item-name="" data-promo-gratis="" data-promo-qty="" \
														class="btn btn-success btn-xs btn-add-cart">\
															<i class="fa fa-plus"></i>\
														</button>\
													</td>\
												</tr>';
									no++;
								});

						$("#data_items").html(html);
						// $('#table_item').animate({scrollTop: $('#data_items').prop("scrollHeight")}, 500);
				}).fail(function(data){
							alert(data);
					});
					// alert();
					// $('#table_item').animate({scrollTop: $('#data_items').prop("scrollHeight")}, 500);
	}

	$.fn.addCart = function(btn){

		var this_name 			= btn.attr('data-name');
    var this_id 				= parseInt(btn.attr('data-id'));
		var this_harga_jual = btn.attr('data-price');
		var this_status 		= btn.attr('data-status-aktif');

		var this_qty = 1;
		var item_exist = 0;
		var item_exist_index = -1;

			if (add_item_list) {
				$.each(add_item_list, function (index, value) {
								if (value.item_id == this_id) {
										item_exist = 1;
										item_exist_index = index;
										this_qty = this_qty + value.item_qty;
								}
						});
			}

			if (item_exist) add_item_list.splice(item_exist_index, 1);

			var new_item_detail = {
							'item_name'		: this_name,
							'item_id'			: this_id,
							'item_price'	: this_harga_jual,
							'item_qty'		: this_qty,
							'item_status'	: this_status
					};


			add_item_list.push(new_item_detail);
			localStorage.setItem('item_detail', JSON.stringify(add_item_list));
			$.fn.refreshChart();

	}
		$("body").on("click", ".removeCart", function (event) {
				var item_id 		= $(this).attr('data-id');
				var bapak 			= $(this).parent();
				var mbah				= bapak.parent();
				var mbahembah		= mbah.parent();
				var item_index 	= mbahembah.index();

				$.each(add_item_list, function (index, value) {
							if (value.item_id == item_id) {
									add_item_list.splice(index, 1);
									return false;
							}
					});
					localStorage.setItem('item_detail', JSON.stringify(add_item_list));
					$.fn.refreshChart();
		});

	$.fn.refreshChart = function () {
					// $.fn.refreshSales();
					storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));

					var html = '';
					var html_struk = '';
					var input_sales_detail = '';
					var intSubTotal = 0;
					var total_item = 0;
					var total_item_qty = 0;
					//
					// $.each(storage_sales_detail, function (index, value) {
					// // 		var item_disc = value.item_disc;
					// // 		if( item_disc ) has_discount = 1;
					// // });
					//
					$("#tbody_sales_cart").empty();
					$.each(storage_item_detail, function (index, value) {

							var item_name = value.item_name;
							var item_id = value.item_id;
							var item_price = value.item_price;
							var item_qty = value.item_qty;
							var item_status = value.item_status;
							var item_total = item_qty * item_price;

							intSubTotal += item_total;
							var itemPrice = Intl.NumberFormat().format(item_price);
							var itemTotal = Intl.NumberFormat().format(item_total);
							// var itemDiscTotal = Intl.NumberFormat().format(item_disc_total);

							html += '<tr>';
							html += '<td class="text-center">';
							html += '<div class="input-group input-group-sm">';
							html += '<span class="input-group-btn">';
							html += '<button data-id="" class="btn btn-danger btn-sm btn-decrease-cart" type="button"><i class="fa fa-minus"></i></button>';
							html += '</span>';
							html += '<input type="text"  style="text-align:center;width:80px;" class="form-control input-sm qty" value="' + item_qty + '">';
							html += '<span class="input-group-btn">';
							html += '<button data-id="" class="btn btn-success btn-sm btn-increase-cart" type="button"><i class="fa fa-plus"></i></button>';
							html += '</span>';
							html += '</div>';
							html += '</td>';
							html += '<td>' + item_name;
							html += '</td>';
							html += '<td class="text-right">'+itemPrice+'</td>';
							html += '<td class="text-right">'+itemTotal+'</td>';
							html += '<td style="text-align: right;">' +
											'<div class="btn-group">' +
											'<button type="button" data-id="'+item_id+'" class="btn btn-danger removeCart"><i class="fa fa-trash-o"></i></button>'+
											'</div>' +
											'</td>';
							html += '</tr>';
							$("#tbody_sales_cart").html(html);
							// console.log(item_name);
			});
			var intSubTotalcur = Intl.NumberFormat().format(intSubTotal);

			$('#total_allcurr').val(intSubTotalcur);
			$('#total_all').val(intSubTotal);
		};

		$('#search').keyup(function(){
			var word = $(this).val();
			var this_data = '';
			word = word.toLowerCase();

			var search_data = [];

			  $.each(items, function (index, value) {
					var name = value.item_name.toLowerCase();

					if( name.indexOf(word) > -1){
						this_data = {
                        'item_id'		: value.item_id,
                        'item_name' : value.item_name,
												'item_harga_jual' : value.item_harga_jual
												// 'item_status'			: value.item_status
                    }

						search_data.push(this_data);
						// console.log(search_data);
					}
				});
				var no =1;
				var html = '';
				// $("#data_items").empty();
				$("#data_items").html(html);
				$.each(search_data, function (index, value) {
				// 	// var item_name  = value.item_name;
						html += '<tr>\
											<td style="text-align:center;">'+no+'</td>\
											<td id="item-name">'+value.item_name+'\
											<td class="text-right">'+Intl.NumberFormat().format(value.item_harga_jual)+'</td><td class="text-center">\
												<button data-disc="" data-price="'+value.item_harga_jual+'" \
												data-qty="1" data-name="'+value.item_name+'" \
												data-id="'+value.item_id+'" data-has-promo=""\
												data-status-aktif="'+value.status_id+'"\
												data-promo-item-name="" data-promo-gratis="" data-promo-qty="" \
												class="btn btn-success btn-xs btn-add-cart">\
													<i class="fa fa-plus"></i>\
												</button>\
											</td>\
										</tr>';
							no++;
				// 			// console.log(value.item_harga_jual);
						});
						$("#data_items").html(html);

		});

	$("body").on("click", ".btn-decrease-cart", function (event) {
			var qty = $(this).parent().parent().find("input:text");
			var value = qty.val();
			var value = parseInt(value);
      if (value > 1) {
          var item_row = $(this).parent().parent().parent().parent();
          var item_index = item_row.index();
          var this_name = '';
          var this_id = 0;
          var this_price = 0;
          var this_qty = 0;
          var this_total = 0;
          var item_exist = 0;
          var item_exist_index = -1;
          if (add_item_list) {
              $.each(add_item_list, function (index, value) {
                  if (item_index == index) {
                      var qty = value.item_qty - 1;
                      this_name = value.item_name;
                      this_id = value.item_id;
                      this_price = value.item_price;
					  this_qty = qty;
                      this_total = value.item_total * this_qty;
                      item_exist = 1;
                      item_exist_index = index;
                  }
              });
          }
  		}
			var new_data = {
                    'item_name': this_name,
                    'item_id': this_id,
                    'item_price': this_price,
                    'item_qty': this_qty,
                };
			add_item_list[item_exist_index] = new_data;
			localStorage.setItem('item_detail', JSON.stringify(add_item_list));
			// console.log(add_item_list);
			$.fn.refreshChart();
      event.preventDefault();
	});

	$("body").on("click", ".btn-increase-cart", function (event) {
		var qty = $(this).parent().parent().find("input:text");
		var value = qty.val();
		var value = parseInt(value);

				var item_row = $(this).parent().parent().parent().parent();
				var item_index = item_row.index();
				var this_name = '';
				var this_id = 0;
				var this_price = 0;
				var this_qty = 0;
				var this_total = 0;
				var item_exist = 0;
				var item_exist_index = -1;
				if (add_item_list) {
						$.each(add_item_list, function (index, value) {
								if (item_index == index) {
										var qty = value.item_qty + 1;
										this_name = value.item_name;
										this_id = value.item_id;
										this_price = value.item_price;
										this_qty = qty;
										this_total = value.item_total * this_qty;
										item_exist = 1;
										item_exist_index = index;
								}
						});
				}

		var new_data = {
									'item_name': this_name,
									'item_id': this_id,
									'item_price': this_price,
									'item_qty': this_qty,
							};
		add_item_list[item_exist_index] = new_data;
		localStorage.setItem('item_detail', JSON.stringify(add_item_list));
		// console.log(add_item_list);
		$.fn.refreshChart();
		event.preventDefault();
	});


	$.fn.getItems();


	$("#form_pijat").submit(function(e) {

		e.preventDefault(); // avoid to execute the actual submit of the form.

    var url = "transaction.php?page=simpan_transaksi";
		var storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));
		// var item_id 	= [];
		// var item_qty 	= [];
		// var item_price = [];

		var paramArr = $("#form_pijat").serializeArray();
    	var qty = $("#i_qty").val();

		$.each(storage_item_detail, function(index, value){
			  
		  paramArr.push( {name:'item_id[]', value:value.item_id },
		                 {name:'item_qty[]', value:value.item_qty },
		                 {name:'item_price[]', value:value.item_price });

		});
		// paramArr.push({name:'qty', value:qty});
		console.log(paramArr);
		// var paramArr = $("#form_pijat").serializeArray();
		//   paramArr.push( {name:'item_id[]', value:item_id },
		//                  {name:'item_qty[]', value:item_qty },
		//                  {name:'item_price[]', value:item_price });

    $.ajax({
           type: "POST",
	       url: url,
           data: paramArr, // serializes the form's elements.
           dataType:'JSON',
           success: function(data)
           {
           		console.log(data);
               // alert(data); // show response from the php script.
               window.location.href="transaction.php?page=form_statement&transaction_id="+data.transaction_id+"&member_id="+data.member_id;
           }
         });
    
		return false;
});

});


</script>

<script>
	$(document).ready(function () {
		// $(".select2").select2({
		// 	placeholder: "Please Select"
		// });
		// $("#cabang").select2({
		// 	placeholder: "Please Select"
		// });
		// $("#pijat").select2({
		// 	placeholder: "Please Select"
		// });
		// $("#pemijat").select2({
		// 	placeholder: "Please Select"
		// });
	});

</script>

<script type="text/javascript">
	$('.clockpicker').clockpicker({
		placement: 'bottom',
    align: 'left',
    donetext: 'Pilih',
    autoclose: true,
    'default': 'now'
	});

	// $( "#cabang" ).change(function() {
	//   var cabang_id = $('#cabang').val();
 //          // alert(item_id);
 //          $.ajax({
 //            type        : "post",
 //            url         : "transaction.php?page=get_ruangan_by",
 //            data        : {branch_id:cabang_id},
 //            dataType    : "json",
 //            success: function(data){
 //              $('#i_ruangan_').empty();
 //              $('#i_ruangan_').append('<option value="0"></option>');

 //              for (var i = 0; i < data.length; i++) {
 //                if (data[i].available) {
 //                $('#i_ruangan_').append('<option value="'+data[i].ruangan_id+'">'+data[i].ruangan_name+'</option>');	
 //            }else{

 //                $('#i_ruangan_').append('<option disabled="disabled" value="'+data[i].ruangan_id+'">'+data[i].ruangan_name+'</option>');
 //            }
 //              }

 //            },
 //            error: function(data)
 //            {
 //              console.log(data);

 //              alert("error");
 //            }
 //          });
	// });
 	
 	$(document).on('change', 'select', function(e) {
    
	    var id = ($(this).attr('id'));
	    if (id.match(/i_ruangan.*/)) {
		    alert(id);
	    }
    });


$('select').change(function() {


	  // var cabang_id = $('#cabang').val();
   //        // alert(item_id);
   //        $.ajax({
   //          type        : "post",
   //          url         : "transaction.php?page=get_ruangan_by",
   //          data        : {branch_id:cabang_id},
   //          dataType    : "json",
   //          success: function(data){
   //            $('#i_ruangan_').empty();
   //            $('#i_ruangan_').append('<option value="0"></option>');

   //            for (var i = 0; i < data.length; i++) {
   //              if (data[i].available) {
   //              $('#i_ruangan_').append('<option value="'+data[i].ruangan_id+'">'+data[i].ruangan_name+'</option>');	
   //          }else{

   //              $('#i_ruangan_').append('<option disabled="disabled" value="'+data[i].ruangan_id+'">'+data[i].ruangan_name+'</option>');
   //          }
   //            }

   //          },
   //          error: function(data)
   //          {
   //            console.log(data);

   //            alert("error");
   //          }
   //        });
	});
	

</script>

<script>
    $(document).ready(function () {
        $("select").select2({
            placeholder: "Please Select"
        });
    });

    $("select").select2({
            placeholder: "Please Select"
        });

</script>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
      	<!-- Content -->
      		         <div class="col-md-12">
                            <form action="<?= $action_statement?>" method="post" enctype="multipart/form-data" role="form">
                                
                            <!-- tabel -->

                            <table border="1">
                                            <tr>
                                                <td>
                                                    <label>Apakah anda mempunyai atau pernah mempunyai masalah tekanan darah tinggi ?</label>
                                                </td>
                                                <td>
                                                    <div id="tekanan">
                                                        <input type="checkbox" value="1" id="tekanan_on" name="i_tekanan" class="form-check" 
                                                        <?php if ($r_statement->tekanan==1){echo "Checked";}?>
                                                        style="margin-left: 5%" /> <b>Ya
                                                        <input type="checkbox" value="2" id="tekanan_off" name="i_tekanan" 
                                                        <?php if ($r_statement->tekanan==2){echo "Checked";}?>
                                                        class="form-check" style="margin-left: 17%;"> Tidak    
                                                    </div> 
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>
                                                    <label>Apakah anda menderita asma?</label> 
                                                </td>
                                                <td>
                                                    <div id="asma">
                                                        <input type="checkbox" value="1" id="asma_on" name="i_asma" class="form-check"  
                                                        <?php if ($r_statement->asma==1){echo "Checked";}?>
                                                        style="margin-left: 5%" /> <b>Ya
                                                        <input type="checkbox" value="2" id="asma_off" name="i_asma" class="form-check"
                                                        <?php if ($r_statement->asma==2){echo "Checked";}?>
                                                        style="margin-left: 17%;"/> Tidak
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Jika ya, apakah anda perlu menggunakan inhaler saat perawatan berlangsung?</label>
                                                </td>
                                                <td>
                                                    <div id="inhaler">
                                                        <input type="checkbox" value="1" id="inhaler_on" name="i_inhaler" class="form-check" 
                                                        <?php if ($r_statement->inhaler==1){echo "Checked";}?>
                                                         style="margin-left: 5%" /> <b>Ya
                                                        <input type="checkbox" value="2" id="inhaler_off" name="i_inhaler" class="form-check" 
                                                        <?php if ($r_statement->inhaler==2){echo "Checked";}?>
                                                        style="margin-left: 17%;" /> Tidak
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Apakah anda sedang mengalami masalah leher dan punggung?</label>
                                                </td>
                                                <td>
                                                    <div id="leher">
                                                        <input type="checkbox" value="1" id="leher_on" name="i_leher" class="form-check" 
                                                        <?php if ($r_statement->leher==1){echo "Checked";}?>
                                                        style="margin-left: 5%" /> <b>Ya
                                                        <input type="checkbox" value="2" id="leher_off" name="i_leher" class="form-check" 
                                                        <?php if ($r_statement->leher==2){echo "Checked";}?>
                                                        style="margin-left: 17%;" /> Tidak
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Apakah anda sedang memiliki masalah kulit, luka, cedera, atau infeksi?</label>
                                                    <div>
                                                            <input class="untukInput1" type="text" size="100" placeholder="Jika ya, Tolong Jabarkan" name="i_kulit_jabarkan" value="<?=$r_statement->kulit_jabarkan?>" />
                                                        </div>
                                                </td>
                                                <td>
                                                    <div id="kulit" style="margin-bottom: 16%;"> 
                                                        <input type="checkbox" value="1" id="kulit_on" name="i_kulit" class="form-check" 
                                                        <?php if ($r_statement->kulit==1){echo "Checked";}?>
                                                        style="margin-left: 5%" /> <b>Ya
                                                        <input type="checkbox" value="2" id="kulit_off" name="i_kulit" class="form-check" 
                                                        <?php if ($r_statement->kulit==2){echo "Checked";}?>
                                                        style="margin-left: 17%;"/> Tidak
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Apakah anda memiliki masalah kesehatan selain yang telah disebutkan di atas dan perlu terapis anda ketahui?</label>
                                                    <div>
                                                            <input class="untukInput1" type="text" size="100" placeholder="Jika ya, Tolong Jabarkan" name="i_selain_jabarkan" value="<?= $r_statement->selain_jabarkan?>" />
                                                        </div>
                                                </td>
                                                <td>
                                                    <div id="selain" style="margin-bottom: 16%;">
                                                        <input type="checkbox" value="1" id="selain_on" name="i_selain" class="form-check"  
                                                        <?php if ($r_statement->selain_diatas==1){echo "Checked";}?>
                                                        style="margin-left: 5%; margin-top: 4%;" /> <b>Ya
                                                        <input type="checkbox" value="2" id="selain_off" name="i_selain" class="form-check" 
                                                        <?php if ($r_statement->selain_diatas==2){echo "Checked";}?>
                                                        style="margin-left: 17%;" /> Tidak
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Apakah anda memiliki alergi atau bahan-bahan tertentu yang dapat bereaksi terhadap kulit anda?</label>
                                                    <div>
                                                            <input class="untukInput1" type="text" size="100" placeholder="Jika ya, Tolong Jabarkan" name="i_alergi_jabarkan" value="<?= $r_statement->alergi_jabarkan?>" />
                                                        </div>
                                                </td>
                                                <td>
                                                    <div id="alergi" style="margin-bottom: 5%;">
                                                        <input type="checkbox" value="1" id="alergi_on" name="i_alergi" class="form-check" 
                                                         <?php if ($r_statement->alergi==1){echo "Checked";}?>
                                                        style="margin-left: 5%; margin-top: 15%"; /> <b>Ya
                                                        <input type="checkbox" value="2" id="alergi_off" name="i_alergi" class="form-check" 
                                                        <?php if ($r_statement->alergi==2){echo "Checked";}?>
                                                        style="margin-left: 17%;" /> Tidak
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div>
                                                            <label>Apakah anda sedang hamil atau sedang merencanakan kehamilan?</label>
                                                        </div>
                                                        <div>
                                                            <input class="untukInput1" type="text" size="100" placeholder="Jika ya, Berapa usia kandungan anda ?" name="i_usia_kandungan" value="<?= $r_statement->usia_kandungan?>" />
                                                        </div>
                                                </td>
                                                <td>
                                                    <div id="hamil" style="margin-bottom: 14%;">
                                                        <input type="checkbox" value="1" id="hamil_on" name="i_hamil" class="form-check" 
                                                        <?php if ($r_statement->hamil==1){echo "Checked";}?>
                                                        style="margin-left: 5%; margin-top: 15%"; /> <b>Ya
                                                        <input type="checkbox" value="2" id="hamil_off" name="i_hamil" class="form-check" 
                                                        <?php if ($r_statement->hamil==2){echo "Checked";}?>
                                                        style="margin-left: 17%;"/> Tidak
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Apakah anda menggunakan kontak lens?</label>
                                                </td>
                                                <td>
                                                    <div  id="lens">
                                                        <input type="checkbox" value="1" id="lens_on" name="i_lens" class="form-check" 
                                                        <?php if ($r_statement->kontak_lens==1){echo "Checked";}?>
                                                        style="margin-left: 5%; margin-top: 8%;" /> <b>Ya
                                                        <input type="checkbox" value="2" id="lens_off" name="i_lens" class="form-check" 
                                                        <?php if ($r_statement->kontak_lens==2){echo "Checked";}?>
                                                        style="margin-left: 17%;"/> Tidak
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Jika ya, apakah anda perlu melepasnya sebelum perawatan wajah atau perawatan lainnya?</label>
                                                    
                                                </td>
                                                <td>
                                                    <div id="melepasnya">
                                                        <input type="checkbox" value="1" id="melepasnya_on" name="i_melepasnya" class="form-check" 
                                                        <?php if ($r_statement->melepas_lens==1){echo "Checked";}?>
                                                        style="margin-left: 5%" /> <b>Ya
                                                        <input type="checkbox" value="2" id="melepasnya_off" name="i_melepasnya" class="form-check" 
                                                        <?php if ($r_statement->melepas_lens==2){echo "Checked";}?>
                                                        style="margin-left: 17%;" /> Tidak
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Bagaimana level tekanan pijatan yang anda inginkan saat perawatan?</label>
                                                    
                                                </td>
                                                <td width="23%">
                                                    <div>
                                                        <input type="checkbox" value="1" id="pijatan_1" name="i_level" class="form-check check_2" 
                                                        <?php if ($r_statement->level==1){echo "Checked";}?>
                                                         style="margin-left: 5%;" /> <label>Lembut</label> 
                                                        <input type="checkbox" value="2" id="pijatan_2" name="i_level" class="form-check check_2" 
                                                        <?php if ($r_statement->level==2){echo "Checked";}?>
                                                        style="margin-left: 1%;" /> <label>Sedang</label>
                                                        <input type="checkbox" value="3" id="pijatan_3" name="i_level" class="form-check check_2" 
                                                        <?php if ($r_statement->level==3){echo "Checked";}?>
                                                        style="margin-left: 1%" /> <label>Kuat</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Apakah anda ingin mendapatkan penawaran spesial kami melalui email atau pesan SMS/WA?</label>
                                                </td>
                                                <td>
                                                    <div  id="spesial">
                                                        <input type="checkbox" value="1" id="spesial_on" name="i_spesial" class="form-check" 
                                                        <?php if ($r_statement->spesial==1){echo "Checked";}?>
                                                        style="margin-left: 5%;" /> <b>Ya
                                                        <input type="checkbox" value="2" id="spesial_off" name="i_spesial" class="form-check" 
                                                        <?php if ($r_statement->spesial==2){echo "Checked";}?>
                                                        style="margin-left: 17%;"/> Tidak
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <label>Saya menyatakan bahwa jawaban yang berikan adalah benar</label>
                                                </td>
                                                <td>
                                                    <div id="jawaban">
                                                        <input type="checkbox" value="1" id="jawaban_on" name="i_jawaban" class="form-check" 
                                                        <?php if ($r_statement->jawaban==1){echo "Checked";}?>
                                                        style="margin-left: 5%" /> <b>Ya
                                                        <input type="checkbox" value="2" id="jawaban_off" name="i_jawaban" class="form-check" 
                                                        <?php if ($r_statement->jawaban==2){echo "Checked";}?>
                                                        style="margin-left: 17%;"/> Tidak
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div id="menyembunyikan">
                                                            <label>Saya tidak menyembunyikan informasi apapun yang mungkin relevan untuk menentukan bagaimana perawatan saya dilakukan</label>
                                                        </div>
                                                </td>
                                                <td> 
                                                    <div id="menyembunyikan" style="margin-bottom: 5%;">
                                                        <input type="checkbox" value="1" id="menyembunyikan_on" name="i_menyembunyikan" class="form-check" 
                                                        <?php if ($r_statement->tidak_menyembunyikan==1){echo "Checked";}?>
                                                        style="margin-left: 5%" /> <b>Ya
                                                        <input type="checkbox" value="2" id="menyembunyikan_off" name="i_menyembunyikan" class="form-check" 
                                                        <?php if ($r_statement->tidak_menyembunyikan==2){echo "Checked";}?>
                                                        style="margin-left: 17%;"/> Tidak
                                                    </div>
                                                    
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div id="menyembunyikan">
                                                            <label>Saya mengetahui bahwa Zee Holistic Living tidak bertanggung jawab atas cedera atau keruskan setelah perawatan dilakukan</label>
                                                        </div>
                                                </td>
                                                <td>
                                                    <div id="bertanggung">
                                                        <input type="checkbox" value="1" id="bertanggung_on" name="i_bertanggung_jawab" class="form-check" 
                                                        <?php if ($r_statement->tanggung_jawab==1){echo "Checked";}?>
                                                        style="margin-left: 5%; margin-top: 3%;" /> <b>Ya
                                                        <input type="checkbox" value="2" id="bertanggung_off" name="i_bertanggung_jawab" class="form-check" 
                                                        <?php if ($r_statement->tanggung_jawab==2){echo "Checked";}?>
                                                        style="margin-left: 17%;"/> Tidak
                                                    </div>
                                                </td>
                                            </tr>

                                        </table>

                                        <div class="box-footer"  style="background-color: #fff;">
                                                <input class="btn btn-danger" type="submit" value="Save"/>
                                                <button onclick="<script>$.colorbox.close()</script>" class="btn btn-default" value="Close">Close</button>
                                                <a href="member.php?page=print&statement=<?php echo $id?>" target="_blank" class="btn btn-danger1" >Print</a>

                            <!-- tabel -->

                            </form>
                            </div>
                        

      	<!-- Content -->
     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>